<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanKerusakan;
use App\Models\PerawatanInventaris;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TeknisiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Antrean terbuka yang belum diklaim teknisi
        $antrean_tersedia = LaporanKerusakan::with(['barang', 'user'])
            ->where('status', 'disetujui')
            ->whereNull('teknisi_id')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Tugas yang sudah diklaim teknisi yang login
        $tugas_saya = LaporanKerusakan::with(['barang', 'user'])
            ->where('status', 'disetujui')
            ->where('teknisi_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view(
            'user.teknisi.index',
            compact('antrean_tersedia', 'tugas_saya')
        );
    }

    public function klaim($uuid)
    {
        $updated = LaporanKerusakan::where('uuid', $uuid)
            ->where('status', 'disetujui')
            ->whereNull('teknisi_id')
            ->update([
                'teknisi_id' => Auth::id(),
                'updated_at' => now(),
            ]);

        if ($updated) {
            return redirect()->back()
                ->with('success', 'Tugas berhasil diambil alih!');
        }

        return redirect()->back()
            ->with('error', 'Maaf, tugas ini sudah diklaim oleh teknisi lain.');
    }

    public function batalKlaim($uuid)
    {
        LaporanKerusakan::where('uuid', $uuid)
            ->where('teknisi_id', Auth::id())
            ->update([
                'teknisi_id' => null,
                'updated_at' => now(),
            ]);

        return redirect()->back()
            ->with('info', 'Tugas berhasil dikembalikan ke antrean.');
    }

    /**
     * Detail laporan kerusakan awal.
     */
    public function detail($uuid)
    {
        $laporan = LaporanKerusakan::with(['barang', 'user'])
            ->where('uuid', $uuid)
            ->where('teknisi_id', Auth::id())
            ->firstOrFail();

        return view('user.teknisi.detail', compact('laporan'));
    }

    public function perbaikan($uuid)
    {
        $laporan = LaporanKerusakan::with(['barang'])
            ->where('uuid', $uuid)
            ->where('teknisi_id', Auth::id())
            ->firstOrFail();

        return view('user.teknisi.perbaikan', compact('laporan'));
    }

    public function perbaikanSubmit(Request $request, $uuid)
    {
        // Validasi input dan unggahan bukti perbaikan
        $request->validate([
            'deskripsi' => [
                'required',
                'string',
            ],

            'biaya' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status_perbaikan' => [
                'required',
                'in:diperbaiki,tidak_dapat_diperbaiki',
            ],

            // Foto opsional, maksimal 10 MB, hanya JPG/JPEG/PNG
           'foto_bukti.file' =>
    'File bukti yang diunggah tidak valid.',

'foto_bukti.mimetypes' =>
    'File bukti harus berupa gambar JPG, JPEG, atau PNG.',

'foto_bukti.mimes' =>
    'Format foto bukti harus JPG, JPEG, atau PNG.',

'foto_bukti.max' =>
    'Ukuran foto bukti maksimal 10 MB.',

            // Dokumen opsional, maksimal 10 MB
            'dokumen_bukti' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240',
            ],
        ], [
            'deskripsi.required' =>
                'Deskripsi tindakan perbaikan wajib diisi.',

            'biaya.required' =>
                'Biaya perbaikan wajib diisi.',

            'biaya.numeric' =>
                'Biaya perbaikan harus berupa angka.',

            'biaya.min' =>
                'Biaya perbaikan tidak boleh kurang dari 0.',

            'status_perbaikan.required' =>
                'Status perbaikan wajib dipilih.',

            'status_perbaikan.in' =>
                'Status perbaikan yang dipilih tidak valid.',

            'foto_bukti.image' =>
                'File foto bukti harus berupa gambar.',

            'foto_bukti.mimes' =>
                'Format foto bukti harus JPG, JPEG, atau PNG.',

            'foto_bukti.max' =>
                'Ukuran foto bukti maksimal 10 MB.',

            'dokumen_bukti.file' =>
                'Dokumen bukti yang diunggah tidak valid.',

            'dokumen_bukti.mimes' =>
                'Format dokumen bukti harus PDF, DOC, atau DOCX.',

            'dokumen_bukti.max' =>
                'Ukuran dokumen bukti maksimal 10 MB.',
        ]);

        $laporan = LaporanKerusakan::where('uuid', $uuid)
            ->where('teknisi_id', Auth::id())
            ->firstOrFail();

        $fotoPath = null;

        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')
                ->store('perawatan/bukti', 'public');
        }

        $dokumenPath = null;

        if ($request->hasFile('dokumen_bukti')) {
            $dokumenPath = $request->file('dokumen_bukti')
                ->store('perawatan/dokumen', 'public');
        }

        PerawatanInventaris::create([
            'uuid' => (string) Str::uuid(),
            'barang_id' => $laporan->barang_id,
            'user_id' => Auth::id(),
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => "Keluhan: " . $laporan->deskripsi
                . "\nTindakan Perbaikan: " . $request->deskripsi,
            'biaya' => $request->biaya,
            'foto_bukti' => $fotoPath,
            'dokumen_bukti' => $dokumenPath,
            'foto_kerusakan' => $laporan->foto,
            'status' => $request->status_perbaikan,
        ]);

        $laporan->delete();

        return redirect()
            ->route('user.teknisi.logbook')
            ->with(
                'success',
                'Perbaikan berhasil! Data telah diserahkan ke Admin Perawatan Inventaris untuk verifikasi.'
            );
    }

    /**
     * Menampilkan riwayat pengerjaan teknisi.
     */
    public function logbook(Request $request)
    {
        $query = PerawatanInventaris::with(['barang'])
            ->where('user_id', Auth::id())
            ->where('jenis_perawatan', 'perbaikan')
            ->whereIn('status', [
                'proses',
                'diperbaiki',
                'tidak_dapat_diperbaiki',
                'selesai',
            ]);

        $periodeText = 'Semua Waktu';

        if ($request->filled('filter_month')) {
            $date = Carbon::parse($request->filter_month);

            $query->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month);

            $periodeText = 'Bulan ' . $date->translatedFormat('F Y');
        } elseif ($request->filled('filter_week')) {
            $year = substr($request->filter_week, 0, 4);
            $week = substr($request->filter_week, 6);

            $start = Carbon::now()
                ->setISODate($year, $week)
                ->startOfWeek();

            $end = Carbon::now()
                ->setISODate($year, $week)
                ->endOfWeek();

            $query->whereBetween('updated_at', [$start, $end]);

            $periodeText = 'Minggu ke-' . $week
                . ' Tahun ' . $year
                . ' (' . $start->format('d/m/Y')
                . ' - ' . $end->format('d/m/Y') . ')';
        }

        $logbook = $query
            ->orderBy('updated_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view(
            'user.teknisi.logbook',
            compact('logbook', 'periodeText')
        );
    }

    /**
     * Detail hasil pengerjaan dari logbook.
     */
    public function logbookDetail($uuid)
    {
        $perawatan = PerawatanInventaris::with(['barang'])
            ->where('uuid', $uuid)
            ->where('user_id', Auth::id())
            ->where('jenis_perawatan', 'perbaikan')
            ->firstOrFail();

        return view('user.teknisi.logbook-detail', compact('perawatan'));
    }

    /**
     * Mengunduh laporan logbook dalam format PDF.
     */
    public function downloadPdf(Request $request)
    {
        $query = PerawatanInventaris::with(['barang'])
            ->where('user_id', Auth::id())
            ->where('jenis_perawatan', 'perbaikan')
            ->whereIn('status', [
                'proses',
                'diperbaiki',
                'tidak_dapat_diperbaiki',
                'selesai',
            ]);

        $periodeText = 'Semua Waktu';

        if ($request->filled('filter_month')) {
            $date = Carbon::parse($request->filter_month);

            $query->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month);

            $periodeText = 'Bulan ' . $date->translatedFormat('F Y');
        } elseif ($request->filled('filter_week')) {
            $year = substr($request->filter_week, 0, 4);
            $week = substr($request->filter_week, 6);

            $start = Carbon::now()
                ->setISODate($year, $week)
                ->startOfWeek();

            $end = Carbon::now()
                ->setISODate($year, $week)
                ->endOfWeek();

            $query->whereBetween('updated_at', [$start, $end]);

            $periodeText = 'Minggu ke-' . $week
                . ' Tahun ' . $year
                . ' (' . $start->format('d/m/Y')
                . ' - ' . $end->format('d/m/Y') . ')';
        }

        $logbook = $query
            ->orderBy('updated_at', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'user.teknisi.pdf_logbook',
            compact('logbook', 'periodeText')
        )->setPaper('a4', 'landscape');

        $namaTeknisi = Auth::user()->nama_lengkap ?? 'Teknisi';

        $namaFile = 'Laporan_Kinerja_Teknisi_'
            . str_replace(' ', '_', $namaTeknisi)
            . '_' . date('d-m-Y') . '.pdf';

        return $pdf->download($namaFile);
    }
}