<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use App\Models\BmnRuangan;
use App\Models\BmnKategori;
use App\Models\Pengguna;
use App\Models\UnitKerja;
use App\Models\BmnJenisKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Validation\Rule;
use App\Models\PerawatanInventaris;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\WorkSheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class BmnController extends Controller
{
    private function tentukanKondisi($persentase)
    {
        if ($persentase >= 90) return 'Sangat Baik';
        if ($persentase >= 70) return 'Baik';
        if ($persentase >= 50) return 'Kurang Baik';
        return 'Rusak / Cacat';
    }

    private function generateUniqueKode()
    {
        $prefix = 'BRG';
        $year = Carbon::now()->format('Y');

        $last = BmnBarang::where('kode_barang', 'like', "{$prefix}-{$year}-%")
            ->orderBy('kode_barang', 'desc')
            ->first();

        $next = $last ? intval(substr($last->kode_barang, -4)) + 1 : 1;

        return sprintf("%s-%s-%04d", $prefix, $year, $next);
    }

    public function ruanganIndex()
    {
        $ruangan = BmnRuangan::orderBy('nama_ruangan', 'asc')->paginate(10);
        $title = 'Ruangan BMN';
        return view('admin.bmn.ruangan.index', compact('ruangan', 'title'));
    }

    public function ruanganStore(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|unique:bmn_ruangans,nama_ruangan',
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.unique'   => 'Nama ruangan sudah terdaftar, gunakan nama lain.',
        ]);

        $validated['uuid'] = Str::uuid();
        BmnRuangan::create($validated);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function ruanganEdit($uuid)
    {
        $ruangan = BmnRuangan::where('uuid', $uuid)->firstOrFail();
        return response()->json($ruangan);
    }

    public function ruanganUpdate(Request $request, $uuid)
    {
        $ruangan = BmnRuangan::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nama_ruangan' => 'required|unique:bmn_ruangans,nama_ruangan,' . $ruangan->id,
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.unique'   => 'Nama ruangan sudah terdaftar, gunakan nama lain.',
        ]);

        $ruangan->update(['nama_ruangan' => $request->nama_ruangan]);

        return response()->json(['success' => true]);
    }

    public function ruanganDestroy($uuid)
    {
        BmnRuangan::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
    }

    public function ruanganSearch(Request $request)
    {
        $keyword = $request->search;
        $ruangan = BmnRuangan::where('nama_ruangan', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Ruangan';
        return view('admin.bmn.ruangan.index', compact('ruangan', 'title'));
    }

    public function kategoriIndex()
    {
        $kategori = BmnKategori::orderBy('nama_kategori', 'asc')->paginate(10);
        $title = 'Kategori BMN';
        return view('admin.bmn.kategori.index', compact('kategori', 'title'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|unique:bmn_kategoris,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah terdaftar, gunakan nama lain.',
        ]);

        $validated['uuid'] = Str::uuid();
        BmnKategori::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriEdit($uuid)
    {
        $kategori = BmnKategori::where('uuid', $uuid)->firstOrFail();
        return response()->json($kategori);
    }

    public function kategoriUpdate(Request $request, $uuid)
    {
        $kategori = BmnKategori::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nama_kategori' => 'required|unique:bmn_kategoris,nama_kategori,' . $kategori->id,
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah terdaftar, gunakan nama lain.',
        ]);

        $kategori->update(['nama_kategori' => $request->nama_kategori]);

        return response()->json(['success' => true]);
    }

    public function kategoriDestroy($uuid)
    {
        BmnKategori::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function kategoriSearch(Request $request)
    {
        $keyword = $request->search;
        $kategori = BmnKategori::where('nama_kategori', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Kategori';
        return view('admin.bmn.kategori.index', compact('kategori', 'title'));
    }

    public function jenisKerusakanIndex()
    {
        $jenis_kerusakan = BmnJenisKerusakan::orderBy('nama_jenis_kerusakan', 'asc')->paginate(10);
        $title = 'Jenis Kerusakan BMN';
        return view('admin.bmn.jenis_kerusakan.index', compact('jenis_kerusakan', 'title'));
    }

    public function jenisKerusakanStore(Request $request)
    {
        $request->validate([
            'nama_jenis_kerusakan' => 'required|unique:bmn_jenis_kerusakans,nama_jenis_kerusakan',
        ], [
            'nama_jenis_kerusakan.required' => 'Nama jenis kerusakan wajib diisi.',
            'nama_jenis_kerusakan.unique'   => 'Nama jenis kerusakan sudah terdaftar, gunakan nama lain.',
        ]);

        BmnJenisKerusakan::create([
            'nama_jenis_kerusakan' => $request->nama_jenis_kerusakan
        ]);

        return redirect()->back()->with('success', 'Jenis kerusakan berhasil ditambahkan.');
    }

    public function jenisKerusakanEdit($uuid)
    {
        $data = BmnJenisKerusakan::where('uuid', $uuid)->firstOrFail();
        return response()->json($data);
    }

    public function jenisKerusakanUpdate(Request $request, $uuid)
    {
        $data = BmnJenisKerusakan::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'nama_jenis_kerusakan' => 'required|unique:bmn_jenis_kerusakans,nama_jenis_kerusakan,' . $data->id,
        ], [
            'nama_jenis_kerusakan.required' => 'Nama jenis kerusakan wajib diisi.',
            'nama_jenis_kerusakan.unique'   => 'Nama jenis kerusakan sudah terdaftar, gunakan nama lain.',
        ]);

        $data->update(['nama_jenis_kerusakan' => $request->nama_jenis_kerusakan]);
        return response()->json(['success' => true]);
    }

    public function jenisKerusakanDestroy($uuid)
    {
        BmnJenisKerusakan::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function jenisKerusakanSearch(Request $request)
    {
        $keyword = $request->search;
        $jenis_kerusakan = BmnJenisKerusakan::where('nama_jenis_kerusakan', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Jenis Kerusakan';
        return view('admin.bmn.jenis_kerusakan.index', compact('jenis_kerusakan', 'title'));
    }

    public function penggunaIndex()
    {
        $pengguna = Pengguna::orderBy('nama', 'asc')->paginate(10);
        $title = 'Daftar Pengguna BMN';
        return view('admin.bmn.pengguna.index', compact('pengguna', 'title'));
    }

    public function penggunaStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip'  => 'required|string|unique:penggunas,nip|max:50',
        ]);

        $validated['uuid'] = Str::uuid();
        Pengguna::create($validated);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function penggunaEdit($uuid)
    {
        $pengguna = Pengguna::where('uuid', $uuid)->firstOrFail();
        return response()->json($pengguna);
    }

    public function penggunaUpdate(Request $request, $uuid)
    {
        $pengguna = Pengguna::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip'  => 'required|string|max:50|unique:penggunas,nip,' . $pengguna->id,
        ]);

        $pengguna->update($validated);

        return response()->json(['success' => true]);
    }

    public function penggunaDestroy($uuid)
    {
        Pengguna::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus.');
    }

    public function penggunaSearch(Request $request)
    {
        $keyword = $request->search;
        $pengguna = Pengguna::where('nama', 'like', "%{$keyword}%")
            ->orWhere('nip', 'like', "%{$keyword}%")
            ->paginate(10);

        $title = 'Hasil Pencarian Pengguna';
        return view('admin.bmn.pengguna.index', compact('pengguna', 'title'));
    }

    public function unitKerjaIndex()
    {
        $unit_kerja = UnitKerja::orderBy('nama_unit_kerja', 'asc')->paginate(10);
        $title = 'Daftar Unit Kerja BMN';
        return view('admin.bmn.unit_kerja.index', compact('unit_kerja', 'title'));
    }

    public function unitKerjaStore(Request $request)
    {
        $validated = $request->validate([
            'nama_unit_kerja' => 'required|unique:unit_kerjas,nama_unit_kerja|max:255',
        ], [
            'nama_unit_kerja.required' => 'Nama unit kerja wajib diisi.',
            'nama_unit_kerja.unique'   => 'Nama unit kerja sudah terdaftar, gunakan nama lain.',
        ]);

        $validated['uuid'] = Str::uuid();
        UnitKerja::create($validated);

        return redirect()->back()->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    public function unitKerjaEdit($uuid)
    {
        $unit_kerja = UnitKerja::where('uuid', $uuid)->firstOrFail();
        return response()->json($unit_kerja);
    }

    public function unitKerjaUpdate(Request $request, $uuid)
    {
        $unit_kerja = UnitKerja::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nama_unit_kerja' => 'required|max:255|unique:unit_kerjas,nama_unit_kerja,' . $unit_kerja->id,
        ], [
            'nama_unit_kerja.required' => 'Nama unit kerja wajib diisi.',
            'nama_unit_kerja.unique'   => 'Nama unit kerja sudah terdaftar, gunakan nama lain.',
        ]);

        $unit_kerja->update(['nama_unit_kerja' => $request->nama_unit_kerja]);

        return response()->json(['success' => true]);
    }

    public function unitKerjaDestroy($uuid)
    {
        UnitKerja::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Unit kerja berhasil dihapus.');
    }

    public function unitKerjaSearch(Request $request)
    {
        $keyword = $request->search;
        $unit_kerja = UnitKerja::where('nama_unit_kerja', 'like', "%{$keyword}%")
            ->paginate(10);

        $title = 'Hasil Pencarian Unit Kerja';
        return view('admin.bmn.unit_kerja.index', compact('unit_kerja', 'title'));
    }

    public function index(Request $request, $ruangan)
    {
        $keyword = $request->input('q') ?? $request->input('search');
        $list_ruangan = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();

        $data = BmnBarang::with([
            'perawatan' => function ($q) {
                $q->orderBy('tanggal_perawatan', 'desc');
            }
        ])
            // Sembunyikan barang di data penghapusan
            ->whereDoesntHave('perawatan', function ($q) {
                $q->where('jenis_perawatan', 'penghapusan');
            })
            ->where('ruangan', 'LIKE', ucfirst($ruangan) . '%')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', "%{$keyword}%")
                        ->orWhere('kode_barang', 'like', "%{$keyword}%")
                        ->orWhere('nup', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama_barang')
            ->paginate(20);

        $title = 'Data BMN - ' . ucfirst($ruangan);

        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword', 'list_ruangan'));
    }

    public function create($ruangan)
    {
        $ruangans = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();
        $kategoris = BmnKategori::orderBy('nama_kategori', 'asc')->get();
        $penggunas = Pengguna::orderBy('nama', 'asc')->get();

        // TAMBAHKAN INI: Ambil data Unit Kerja
        $unit_kerjas = UnitKerja::orderBy('nama_unit_kerja', 'asc')->get();

        $title = ($ruangan == 'general') ? 'Tambah Barang BMN' : 'Tambah Barang - ' . ucfirst($ruangan);

        return view('admin.bmn.create', compact('ruangan', 'title', 'ruangans', 'kategoris', 'penggunas', 'unit_kerjas'));
    }

    public function store(Request $request, $ruangan)
    {
        $rules = [
            'nama_barang'        => 'required',
            'nup'                => ['required','string','max:255',
                Rule::unique('bmn_barangs')->where(function ($query) use ($request) {
                    return $query->where('nama_barang', $request->nama_barang);
                }),],
            'kode_barang'        => 'nullable|string|max:255|unique:bmn_barangs',
            'kategori'           => 'required',
            'tipe_penempatan'    => 'required|in:lokasi,pengguna', // Disesuaikan dengan value di Blade
            'unit_kerja_pilihan' => 'required|exists:unit_kerjas,nama_unit_kerja', // Unit kerja wajib diisi
            'merk'               => 'nullable',
            'nomor_seri'         => 'nullable',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tanggal_perolehan'  => 'nullable|date',
            'nilai_perolehan'    => 'nullable|numeric|min:0',
            'asal_pengadaan'     => 'nullable',
            'catatan'            => 'nullable',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $validated = $request->validate($rules, [
            'kode_barang.unique' =>
                'Kode barang sudah terdaftar. Gunakan kode yang berbeda.',
        ]);

        // LOGIKA PENENTUAN LOKASI & UNIT KERJA
        if ($ruangan == 'general') {
            $finalRuangan = ($request->tipe_penempatan == 'lokasi')
                ? $request->ruangan_pilihan
                : $request->user_id;

            // Simpan Unit Kerja secara terpisah
            $validated['unit_kerja'] = $request->unit_kerja_pilihan;
        } else {
            $finalRuangan = ucfirst($ruangan);
            $validated['unit_kerja'] = $request->unit_kerja_pilihan ?? null;
        }

        $validated['ruangan'] = $finalRuangan;
        $validated['kode_barang'] = $validated['kode_barang'] ?? $this->generateUniqueKode();
        $validated['uuid']        = Str::uuid();
        $validated['kondisi']     = $this->tentukanKondisi($validated['persentase_kondisi']);

        // Hapus key yang tidak ada di kolom database sebelum create
        unset($validated['tipe_penempatan'], $validated['ruangan_pilihan'], $validated['user_id'], $validated['unit_kerja_pilihan']);

        $manager = new ImageManager(new Driver());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time() . "_barang." . $file->getClientOriginalExtension();

            // Hanya resize maksimal 800px tanpa menambah background putih
            $img = $manager->read($file)->scaleDown(800, 800);

            $path = 'bmn/foto/' . $name;
            Storage::disk('public')->put($path, $img->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['foto'] = $path;
        }

        if ($request->hasFile('posisi')) {
            $file   = $request->file('posisi');
            $name   = time() . "_posisi." . $file->getClientOriginalExtension();

            // Hanya resize maksimal 800px tanpa menambah background putih
            $img    = $manager->read($file)->scaleDown(800, 800);

            $path = 'bmn/posisi/' . $name;
            Storage::disk('public')->put($path, $img->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['posisi'] = $path;
        }

        $qrName = 'qr_' . $validated['kode_barang'] . '.png';
        $qrPath = 'bmn/qrcode/' . $qrName;
        $scanUrl = route('user.inventaris.scan', $validated['kode_barang']);
        QrCode::format('png')->size(300)->margin(2)
            ->generate($scanUrl, Storage::disk('public')->path($qrPath));
        $validated['qr_code'] = $qrPath;

        BmnBarang::create($validated);

        return redirect()->route('barang.bmn_index')
            ->with('success', 'Barang berhasil ditambahkan ke ' . $finalRuangan);
    }

    public function show($ruangan, $id)
{
    // Load semua perawatan terkait untuk pengecekan status
    $barang = BmnBarang::with('perawatan')->findOrFail($id);

    $title = 'Detail Barang - ' . ucfirst($ruangan);

    // Cek apakah ada rencana penghapusan
    $isRencanaPenghapusan = $barang->perawatan
        ->where('jenis_perawatan', 'rencana_penghapusan')
        ->isNotEmpty();

    // Cek maintenance (perbaikan biasa)
    $cek_perawatan = $barang->perawatan()
    ->where('status', '!=', 'selesai')
    ->where('jenis_perawatan', '!=', 'rencana_penghapusan')
    ->exists();

    $cek_laporan = \App\Models\LaporanKerusakan::where('barang_id', $id)
        ->whereIn('status', ['disetujui', 'proses'])
        ->exists();

    $sedang_maintenance = $cek_perawatan || $cek_laporan;

    return view('admin.bmn.show', compact('barang', 'ruangan', 'title', 'sedang_maintenance', 'isRencanaPenghapusan'));
}

    public function edit($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $ruangans = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();
        $kategoris = BmnKategori::orderBy('nama_kategori', 'asc')->get();
        $penggunas = Pengguna::orderBy('nama', 'asc')->get();

        // TAMBAHKAN INI
        $unit_kerjas = UnitKerja::orderBy('nama_unit_kerja', 'asc')->get();

        $title = 'Edit Barang - ' . ucfirst($ruangan);

        return view('admin.bmn.edit', compact('barang', 'ruangan', 'title', 'ruangans', 'kategoris', 'penggunas', 'unit_kerjas'));
    }

    public function update(Request $request, $ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        $rules = [
            'nama_barang'        => 'required',
            'nup'                => [
                'required', 'string', 'max:255',
                Rule::unique('bmn_barangs')->where(function ($query) use ($request) {
                    return $query->where('nama_barang', $request->nama_barang);
                })->ignore($barang->id),
            ],
            'kode_barang'        => 'required|string|max:255|unique:bmn_barangs,kode_barang,' . $barang->id,
            'kategori'           => 'required',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tanggal_perolehan'  => 'nullable|date',
            'nilai_perolehan'    => 'nullable|numeric|min:0',
            'tipe_penempatan'    => 'required|in:lokasi,pengguna',
            'unit_kerja_pilihan' => 'required|exists:unit_kerjas,nama_unit_kerja',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'merk'               => 'nullable|string',
            'nomor_seri'         => 'nullable|string',
            'asal_pengadaan'     => 'nullable|string',
            'catatan'            => 'nullable|string',
        ];

        if ($request->tipe_penempatan == 'lokasi') {
            $rules['ruangan_pilihan'] = 'required|exists:bmn_ruangans,nama_ruangan';
        } else {
            $rules['user_id'] = 'required';
        }

        $validated = $request->validate($rules, [
            'kode_barang.unique' =>
                'Kode barang sudah terdaftar. Gunakan kode yang berbeda.',
        ]);

        // Update Lokasi & Unit Kerja
        $validated['ruangan'] = ($request->tipe_penempatan == 'lokasi')
            ? $request->ruangan_pilihan
            : $request->user_id;
        $validated['unit_kerja'] = $request->unit_kerja_pilihan;

        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        $manager = new ImageManager(new Driver());

        if ($request->hasFile('foto')) {
            if ($barang->foto) Storage::disk('public')->delete($barang->foto);
            $file = $request->file('foto');
            $name = time() . "_barang." . $file->getClientOriginalExtension();

            $img = $manager->read($file)->scaleDown(800, 800);

            $path = 'bmn/foto/' . $name;
            Storage::disk('public')->put($path, $img->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['foto'] = $path;
        }

        if ($request->hasFile('posisi')) {
            if ($barang->posisi) Storage::disk('public')->delete($barang->posisi);
            $file = $request->file('posisi');
            $name = time() . "_posisi." . $file->getClientOriginalExtension();

            $img = $manager->read($file)->scaleDown(800, 800);

            $path = 'bmn/posisi/' . $name;
            Storage::disk('public')->put($path, $img->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['posisi'] = $path;
        }

        if ($request->hasFile('foto') || $request->hasFile('posisi') || $request->kode_barang !== $barang->kode_barang) {
            if ($barang->qr_code) Storage::disk('public')->delete($barang->qr_code);
            $qrName = 'qr_' . $validated['kode_barang'] . '.png';
            $qrPath = 'bmn/qrcode/' . $qrName;
            $scanUrl = route('user.inventaris.scan', $validated['kode_barang']);
            QrCode::format('png')->size(300)->margin(2)->generate($scanUrl, Storage::disk('public')->path($qrPath));
            $validated['qr_code'] = $qrPath;
        }

        unset($validated['ruangan_pilihan'], $validated['user_id'], $validated['tipe_penempatan'], $validated['unit_kerja_pilihan']);

        $barang->update($validated);

        return redirect()->route('barang.bmn_index')
            ->with('success', 'Data barang BMN berhasil diperbarui.');
    }

    public function destroy($ruangan, $id)
    {
    $barang = BmnBarang::findOrFail($id);


    if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
    Storage::disk('public')->delete($barang->foto);
    }
    if ($barang->posisi && Storage::disk('public')->exists($barang->posisi)) {
    Storage::disk('public')->delete($barang->posisi);
    }
    if ($barang->qr_code && Storage::disk('public')->exists($barang->qr_code)) {
    Storage::disk('public')->delete($barang->qr_code);
    }

    $barang->delete();

    return redirect()->route('barang.bmn_index', $ruangan)
    ->with('success', 'Barang berhasil dihapus.');
    }

    public function print($ruangan)
    {
        $data = BmnBarang::where('ruangan', 'like', ucfirst($ruangan) . '%')
            // Sembunyikan barang di data penghapusan
            ->whereDoesntHave('perawatan', function ($q) {
                $q->where('jenis_perawatan', 'penghapusan');
            })
            ->orderBy('nama_barang')
            ->get();

        $title = 'Cetak Data BMN - ' . ucfirst($ruangan);
        return view('admin.bmn.print', compact('data', 'ruangan', 'title'));
    }

    public function search(Request $request, $ruangan)
    {
        $keyword = $request->input('search');

        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
            // Sembunyikan barang di data penghapusan
            ->whereDoesntHave('perawatan', function ($q) {
                $q->where('jenis_perawatan', 'penghapusan');
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', "%{$keyword}%")
                        ->orWhere('kode_barang', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(10)
            ->appends($request->all());

        $title = 'Hasil Pencarian BMN - ' . ucfirst($ruangan);

        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
    }

    public function showFilterForm($ruangan)
    {
        $kategoriList = BmnBarang::select('kategori')->distinct()->pluck('kategori');
        $asalList = BmnBarang::select('asal_pengadaan')->distinct()->pluck('asal_pengadaan');
        $posisiList = BmnBarang::select('posisi')->distinct()->pluck('posisi');
        $tahunList = BmnBarang::select('tahun_pengadaan')->distinct()->orderBy('tahun_pengadaan', 'desc')->pluck('tahun_pengadaan');

        return view('admin.bmn.filter_form', compact('ruangan', 'kategoriList', 'asalList', 'posisiList', 'tahunList'));
    }

    public function printFiltered(Request $request, $ruangan)
    {
        $query = BmnBarang::where('ruangan', ucfirst($ruangan))
            // Sembunyikan barang di data penghapusan
            ->whereDoesntHave('perawatan', function ($q) {
                $q->where('jenis_perawatan', 'penghapusan');
            });

        if ($request->filled('tahun_pengadaan')) $query->where('tahun_pengadaan', $request->tahun_pengadaan);
        if ($request->filled('kondisi')) $query->where('kondisi', $request->kondisi);
        if ($request->filled('kategori')) $query->where('kategori', $request->kategori);
        if ($request->filled('asal_pengadaan')) $query->where('asal_pengadaan', $request->asal_pengadaan);

        $data = $query->orderBy('nama_barang', 'asc')->get();
        $title = 'Laporan BMN (Filtered) - ' . ucfirst($ruangan);

        $pdf = Pdf::loadView('admin.bmn.print_filtered', compact('data', 'ruangan', 'title'))
            ->setPaper('a4', 'landscape')
            ->setOption(['isPhpEnabled' => true]);

        return $pdf->stream('Laporan_BMN_Filtered_' . ucfirst($ruangan) . '.pdf');
    }

    /** 🔥 Download QR ALL Barang */
    public function downloadQRAll()
    {
        $url = route('user.inventaris.index');

        // Buat QR PNG
        $qr = QrCode::format('png')
            ->size(400)
            ->errorCorrection('H')
            ->generate($url);

        $filename = 'QR-ALL-INVENTARIS.png';

        return response($qr)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    // download template csv buat impor barang bmn (baris yang harus diisi dan contoh)
    public function downloadTemplateCsv ()
    {
      $filename = 'template_impor_barang_bmn.csv';

      $headers = [
        'nama_barang',
        'nup',
        'kode_barang',
        'kategori',
        'tipe_penempatan',
        'ruangan_pilihan',
        'user_id',
        'unit_kerja_pilihan',
        'merk',
        'nomor_seri',
        'jumlah',
        'persentase_kondisi',
        'tanggal_perolehan',
        'nilai_perolehan',
        'asal_pengadaan',
        'catatan',
      ];

      $example = [
          'Laptop Lenovo',
          '001',
          '',
          'Elektronik',
          'lokasi',
          'Ruang TU',
          '',
          'Administrasi',
          'Lenovo',
          'ABC123',
          '1',
          '90',
          '2026-01-15',
          '8500000',
          'Pembelian',
          'Laptop operasional',
      ];

      return response()->streamDownload(function () use ($headers, $example) {
          $output = fopen('php://output', 'w');

          // BOM agar karakter UTF-8 terbaca dengan baik di Excel
          fwrite($output, "\xEF\xBB\xBF");

          fputcsv($output, $headers, ';');
          fputcsv($output, $example, ';');

          fclose($output);
      }, $filename, [
          'Content-Type' => 'text/csv; charset=UTF-8',
      ]);
    }

    // download template excel
    public function downloadTemplateExcel()
    {
        $spreadsheet = new Spreadsheet();

        // Sheet utama untuk input barang
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Barang');

        $headers = [
            'nama_barang',
            'nup',
            'kode_barang',
            'kategori',
            'tipe_penempatan',
            'ruangan_pilihan',
            'user_id',
            'unit_kerja_pilihan',
            'merk',
            'nomor_seri',
            'jumlah',
            'persentase_kondisi',
            'tanggal_perolehan',
            'nilai_perolehan',
            'asal_pengadaan',
            'catatan',
        ];

        $sheet->fromArray($headers, null, 'A1');

        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        $sheet->getStyle('A1:P1')->getAlignment()
            ->setHorizontal('center');

        $sheet->freezePane('A2');
        $sheet->setAutoFilter('A1:P501');

        // Atur lebar kolom
        $widths = [
            'A' => 28, 'B' => 15, 'C' => 22, 'D' => 22,
            'E' => 20, 'F' => 25, 'G' => 25, 'H' => 25,
            'I' => 18, 'J' => 22, 'K' => 12, 'L' => 22,
            'M' => 20, 'N' => 20, 'O' => 22, 'P' => 30,
        ];

        foreach ($widths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        // Kolom teks: cegah NUP/kode/nomor seri menjadi notasi ilmiah.
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'O', 'P'] as $column) {
            $sheet->getStyle("{$column}2:{$column}501")
                ->getNumberFormat()->setFormatCode('@');
        }

        // Format tanggal ISO: yyyy-mm-dd.
        $sheet->getStyle('M2:M501')
            ->getNumberFormat()->setFormatCode('yyyy-mm-dd');

        $sheet->getStyle('K2:K501')
            ->getNumberFormat()->setFormatCode('0');

        $sheet->getStyle('L2:L501')
            ->getNumberFormat()->setFormatCode('0');

        $sheet->getStyle('N2:N501')
            ->getNumberFormat()->setFormatCode('#,##0');

        // Sheet referensi dropdown, diambil dari database.
        $refSheet = $spreadsheet->createSheet();
        $refSheet->setTitle('Referensi');

        $lists = [
            'DaftarKategori' => [
                'column' => 'A',
                'values' => BmnKategori::orderBy('nama_kategori')
                    ->pluck('nama_kategori')->all(),
            ],
            'DaftarRuangan' => [
                'column' => 'B',
                'values' => BmnRuangan::orderBy('nama_ruangan')
                    ->pluck('nama_ruangan')->all(),
            ],
            'DaftarPengguna' => [
                'column' => 'C',
                'values' => Pengguna::orderBy('nama')
                    ->pluck('nama')->all(),
            ],
            'DaftarUnitKerja' => [
                'column' => 'D',
                'values' => UnitKerja::orderBy('nama_unit_kerja')
                    ->pluck('nama_unit_kerja')->all(),
            ],
        ];

        foreach ($lists as $name => $list) {
            $column = $list['column'];
            $values = $list['values'];

            // Named range tidak boleh mengarah ke rentang kosong.
            if (empty($values)) {
                $values = [''];
            }

            foreach ($values as $index => $value) {
                $refSheet->setCellValue(
                    $column . ($index + 1),
                    $value
                );
            }

            $lastRow = count($values);

            $spreadsheet->addNamedRange(
                new NamedRange(
                    $name,
                    $refSheet,
                    '$' . $column . '$1:$' . $column . '$' . $lastRow
                )
            );
        }

        // Pasang dropdown pada baris 2 sampai 501.
        $dropdowns = [
            'D' => '=DaftarKategori',
            'F' => '=DaftarRuangan',
            'G' => '=DaftarPengguna',
            'H' => '=DaftarUnitKerja',
        ];

        for ($row = 2; $row <= 501; $row++) {
            foreach ($dropdowns as $column => $formula) {
                $validation = $sheet->getCell("{$column}{$row}")
                    ->getDataValidation();

                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_STOP);
                $validation->setAllowBlank(true);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setPromptTitle('Pilih data');
                $validation->setPrompt(
                    'Pilih nilai dari daftar yang tersedia.'
                );
                $validation->setErrorTitle('Pilihan tidak valid');
                $validation->setError(
                    'Gunakan salah satu pilihan dari dropdown.'
                );
                $validation->setFormula1($formula);
            }

            // Tipe penempatan hanya boleh lokasi atau pengguna.
            $validation = $sheet->getCell("E{$row}")
                ->getDataValidation();

            $validation->setType(DataValidation::TYPE_LIST);
            $validation->setErrorStyle(DataValidation::STYLE_STOP);
            $validation->setAllowBlank(false);
            $validation->setShowErrorMessage(true);
            $validation->setErrorTitle('Tipe penempatan tidak valid');
            $validation->setError(
                'Pilih lokasi atau pengguna.'
            );
            $validation->setFormula1('"lokasi,pengguna"');
        }

        // Tambahkan sheet petunjuk.
        $guide = $spreadsheet->createSheet();
        $guide->setTitle('Petunjuk');

        $instructions = [
            ['PETUNJUK PENGISIAN TEMPLATE BMN'],
            ['1. Isi data barang mulai dari baris 2 pada sheet Template Barang.'],
            ['2. Jangan mengubah atau menghapus nama header pada baris 1.'],
            ['3. Kolom tipe_penempatan hanya berisi lokasi atau pengguna.'],
            ['4. Isi ruangan_pilihan untuk penempatan lokasi.'],
            ['5. Isi user_id dengan nama pengguna jika tipe_penempatan adalah pengguna.'],
            ['6. Kategori, ruangan, pengguna, dan unit kerja dipilih dari dropdown.'],
            ['7. Isi tanggal dengan format yyyy-mm-dd, misalnya 2026-10-19.'],
            ['8. Kolom kode_barang boleh dikosongkan jika sistem membuat kode otomatis.'],
            ['9. Saat akan mengimpor, simpan atau ekspor sheet Template Barang sebagai CSV.'],
            ['10. Pastikan baris contoh tidak ditambahkan; template ini dimulai dengan baris data kosong.'],
        ];

        $guide->fromArray($instructions, null, 'A1');
        $guide->getStyle('A1')->getFont()->setBold(true);
        $guide->getColumnDimension('A')->setWidth(100);
        $guide->getStyle('A1:A11')->getAlignment()->setWrapText(true);

        // Sheet referensi disembunyikan dari pengguna.
        $refSheet->setSheetState(Worksheet::SHEETSTATE_HIDDEN);

        // Mulai dengan sheet template saat file dibuka.
        $spreadsheet->setActiveSheetIndex(0);

        $tempFile = tempnam(sys_get_temp_dir(), 'bmn_template_');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return response()->download(
            $tempFile,
            'template_impor_barang_bmn.xlsx',
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        )->deleteFileAfterSend(true);
    }

    // import csv barang bmn
    public function importCsv (Request $request)
    {
      $request->validate([
          'file_csv' => 'required|file|mimes:csv,txt|max:5120',
      ], [
          'file_csv.required' => 'Silakan pilih file CSV terlebih dahulu.',
          'file_csv.mimes' => 'File harus berformat CSV.',
          'file_csv.max' => 'Ukuran file maksimal 5 MB.',
      ]);

      $file = $request->file('file_csv');
      $handle = fopen($file->getRealPath(), 'r');

      if (!$handle) {
          return back()->withErrors([
              'file_csv' => 'File CSV tidak dapat dibaca.',
          ]);
      }

      try {
          $headerLine = fgets($handle);

          if ($headerLine === false) {
              throw new \RuntimeException('File CSV kosong.');
          }

          // Deteksi pemisah koma atau titik koma.
          $delimiter = substr_count($headerLine, ';') >
              substr_count($headerLine, ',') ? ';' : ',';

          rewind($handle);

          $headers = fgetcsv($handle, 0, $delimiter);

          if (!$headers) {
              throw new \RuntimeException('Header CSV tidak ditemukan.');
          }

          // Hilangkan BOM UTF-8 dan spasi pada header.
          $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);
          $headers = array_map(
              fn ($header) => trim((string) $header),
              $headers
          );

          $requiredHeaders = [
              'nama_barang',
              'nup',
              'kode_barang',
              'kategori',
              'tipe_penempatan',
              'ruangan_pilihan',
              'user_id',
              'unit_kerja_pilihan',
              'merk',
              'nomor_seri',
              'jumlah',
              'persentase_kondisi',
              'tanggal_perolehan',
              'nilai_perolehan',
              'asal_pengadaan',
              'catatan',
          ];

          $missingHeaders = array_diff($requiredHeaders, $headers);

          if (!empty($missingHeaders)) {
              throw new \RuntimeException(
                  'Header CSV tidak sesuai template. Kolom yang tidak ditemukan: ' .
                  implode(', ', $missingHeaders)
              );
          }

          $rows = [];
          $errors = [];
          $seenNup = [];
          $seenCodes = [];
          $line = 1;

          while (($values = fgetcsv($handle, 0, $delimiter)) !== false) {
              $line++;

              if ($values === [null] || $values === []) {
                  continue;
              }

              if (count($values) !== count($headers)) {
                  $errors[] = "Baris {$line}: jumlah kolom tidak sesuai header.";
                  continue;
              }

              $row = array_combine($headers, $values);

              foreach ($row as $key => $value) {
                  $row[$key] = trim((string) ($value ?? ''));
              }

              // Abaikan baris yang benar-benar kosong.
              if (count(array_filter($row, fn ($v) => $v !== '')) === 0) {
                  continue;
              }

              if (count($rows) >= 500) {
                  $errors[] = 'Maksimal 500 baris data per impor.';
                  break;
              }

              $validator = Validator::make($row, [
                  'nama_barang' => 'required|string|max:255',
                  'nup' => 'required|string|max:255',
                  'kode_barang' => 'nullable|string|max:255',
                  'kategori' => 'required|string|max:255',
                  'tipe_penempatan' => 'required|in:lokasi,pengguna',
                  'ruangan_pilihan' => 'nullable|string|max:255',
                  'user_id' => 'nullable|string|max:255',
                  'unit_kerja_pilihan' => 'required|exists:unit_kerjas,nama_unit_kerja',
                  'merk' => 'nullable|string|max:255',
                  'nomor_seri' => 'nullable|string|max:255',
                  'jumlah' => 'required|integer|min:1',
                  'persentase_kondisi' => 'required|numeric|min:0|max:100',
                  'tanggal_perolehan' => 'nullable|date',
                  'nilai_perolehan' => 'nullable|numeric|min:0',
                  'asal_pengadaan' => 'nullable|string|max:255',
                  'catatan' => 'nullable|string',
              ]);

              if ($validator->fails()) {
                  foreach ($validator->errors()->all() as $message) {
                      $errors[] = "Baris {$line}: {$message}";
                  }
                  continue;
              }

              if (!BmnKategori::where('nama_kategori', $row['kategori'])->exists()) {
                  $errors[] = "Baris {$line}: kategori '{$row['kategori']}' tidak ditemukan.";
              }

              if ($row['tipe_penempatan'] === 'lokasi') {
                  if (
                      $row['ruangan_pilihan'] === '' ||
                      !BmnRuangan::where('nama_ruangan', $row['ruangan_pilihan'])->exists()
                  ) {
                      $errors[] = "Baris {$line}: ruangan tidak ditemukan.";
                  }
              } else {
                  if (
                      $row['user_id'] === '' ||
                      !Pengguna::where('nama', $row['user_id'])->exists()
                  ) {
                      $errors[] = "Baris {$line}: pengguna tidak ditemukan.";
                  }
              }

              // NUP harus unik untuk nama barang yang sama.
              $nupKey = mb_strtolower($row['nama_barang'] . '|' . $row['nup']);

              if (isset($seenNup[$nupKey])) {
                  $errors[] = "Baris {$line}: kombinasi nama barang dan NUP duplikat di CSV.";
              } elseif (
                  BmnBarang::where('nama_barang', $row['nama_barang'])
                      ->where('nup', $row['nup'])
                      ->exists()
              ) {
                  $errors[] = "Baris {$line}: kombinasi nama barang dan NUP sudah terdaftar.";
              }

              $seenNup[$nupKey] = true;

              // Kode barang boleh kosong agar dibuat otomatis.
              if ($row['kode_barang'] !== '') {
                  if (
                      isset($seenCodes[$row['kode_barang']]) ||
                      BmnBarang::where('kode_barang', $row['kode_barang'])->exists()
                  ) {
                      $errors[] = "Baris {$line}: kode barang '{$row['kode_barang']}' sudah digunakan.";
                  }

                  $seenCodes[$row['kode_barang']] = true;
              }

              $row['_line'] = $line;
              $rows[] = $row;
          }

          if (count($rows) === 0 && empty($errors)) {
              $errors[] = 'Tidak ada baris data untuk diimpor.';
          }

          if (!empty($errors)) {
              return back()->withErrors($errors);
          }

          $createdQrFiles = [];

          try {
              DB::transaction(function () use ($rows, &$createdQrFiles) {
                  Storage::disk('public')->makeDirectory('bmn/qrcode');

                  foreach ($rows as $row) {
                      $kode = $row['kode_barang'] !== ''
                          ? $row['kode_barang']
                          : $this->generateUniqueKode();

                      // Pengaman tambahan untuk nama file QR.
                      $safeKode = preg_replace('/[^A-Za-z0-9_-]/', '_', $kode);

                      if ($safeKode === '') {
                          throw new \RuntimeException(
                              "Kode barang tidak valid pada baris {$row['_line']}."
                          );
                      }

                      $qrPath = 'bmn/qrcode/qr_' . $safeKode . '.png';

                      if (Storage::disk('public')->exists($qrPath)) {
                          throw new \RuntimeException(
                              "File QR untuk kode {$kode} sudah ada."
                          );
                      }

                      $finalRuangan = $row['tipe_penempatan'] === 'lokasi'
                          ? $row['ruangan_pilihan']
                          : $row['user_id'];

                      $data = [
                          'uuid' => (string) Str::uuid(),
                          'nama_barang' => $row['nama_barang'],
                          'nup' => $row['nup'],
                          'kode_barang' => $kode,
                          'kategori' => $row['kategori'],
                          'ruangan' => $finalRuangan,
                          'unit_kerja' => $row['unit_kerja_pilihan'],
                          'merk' => $row['merk'] !== '' ? $row['merk'] : null,
                          'nomor_seri' => $row['nomor_seri'] !== '' ? $row['nomor_seri'] : null,
                          'jumlah' => (int) $row['jumlah'],
                          'persentase_kondisi' => $row['persentase_kondisi'],
                          'kondisi' => $this->tentukanKondisi(
                              (float) $row['persentase_kondisi']
                          ),
                          'tanggal_perolehan' => $row['tanggal_perolehan'] !== ''
                              ? $row['tanggal_perolehan']
                              : null,
                          'nilai_perolehan' => $row['nilai_perolehan'] !== ''
                              ? $row['nilai_perolehan']
                              : null,
                          'asal_pengadaan' => $row['asal_pengadaan'] !== ''
                              ? $row['asal_pengadaan']
                              : null,
                          'catatan' => $row['catatan'] !== ''
                              ? $row['catatan']
                              : null,
                          'qr_code' => $qrPath,
                      ];

                      // QR menggunakan route scan yang sama dengan store().
                      $scanUrl = route('user.inventaris.scan', $kode);

                      QrCode::format('png')
                          ->size(300)
                          ->margin(2)
                          ->generate(
                              $scanUrl,
                              Storage::disk('public')->path($qrPath)
                          );

                      $createdQrFiles[] = $qrPath;

                      BmnBarang::create($data);
                  }
              });
          } catch (\Throwable $e) {
              foreach ($createdQrFiles as $path) {
                  Storage::disk('public')->delete($path);
              }

              report($e);

              return back()->withErrors([
                  'file_csv' => 'Impor gagal saat menyimpan data. Tidak ada data yang diimpor. Periksa log aplikasi untuk detail teknis.',
              ]);
          }

          return redirect()
              ->route('barang.bmn_index')
              ->with('success', count($rows) . ' data barang berhasil diimpor.');
      } catch (\RuntimeException $e) {
          return back()->withErrors([
              'file_csv' => $e->getMessage(),
          ]);
      } finally {
          if (is_resource($handle)) {
              fclose($handle);
          }
      }
    }
}
