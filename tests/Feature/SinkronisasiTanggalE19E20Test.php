<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use App\Models\JenisBarang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Peruntukan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class SinkronisasiTanggalE19E20Test extends TestCase
{
    use DatabaseTransactions;

    protected User $user;
    protected Peruntukan $peruntukan;
    protected JenisBarang $jenisBarang;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role', 'user')->first() ?? User::factory()->create([
            'role' => 'user',
            'nama_lengkap' => 'Tester User Tanggal',
        ]);

        $this->peruntukan = Peruntukan::first() ?? Peruntukan::create([
            'uuid' => (string) Str::uuid(),
            'peruntukan' => 'Operasional Studio',
        ]);

        $this->jenisBarang = JenisBarang::first() ?? JenisBarang::create([
            'uuid' => (string) Str::uuid(),
            'jenis_barang' => 'Elektronik',
        ]);
    }

    private function createBarang(string $kode, string $nama, string $merk = 'Sony', string $nomorSeri = 'SN-100'): Barang
    {
        return Barang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'merk' => $merk,
            'nomor_seri' => $nomorSeri,
            'status' => 'tersedia',
            'jumlah' => 1,
            'limit' => 5,
            'sisa_limit' => 5,
            'jenis_barang_id' => $this->jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);
    }

    /**
     * Skenario 1:
     * Peminjaman dengan:
     * - Tgl. Penggunaan: 16 Oktober 2026
     * - Batas Pengembalian: 17 Oktober 2026
     * - Waktu Peminjaman: 15 Oktober 2026
     * - Tanggal Pengembalian Aktual: 17 Oktober 2026
     *
     * Diuji pada:
     * 1. Surat peminjaman E19 (Web & PDF)
     * 2. Riwayat peminjaman E19 (Tabel & Modal Detail)
     * 3. Halaman pengembalian E20 (Placeholder & Label)
     * 4. Bukti pengembalian E20 (Web & PDF)
     */
    public function test_01_konsistensi_tanggal_surat_riwayat_dan_bukti_pengembalian(): void
    {
        $b1 = $this->createBarang('BRG-SYNC-1-' . time(), 'Kamera Utama Sync');

        $kodePmb = 'PMB-SYNC-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-SYNC-01',
            'nomor_surat' => 'ST/SYNC/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => '2026-10-15 09:00:00',
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_kembali' => '2026-10-17', // Batas pengembalian
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create([
            'uuid' => Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'kode_barang' => $b1->kode_barang
        ]);

        // 1. Uji Surat Peminjaman E19 (Web)
        session()->put('kodePeminjaman', $kodePmb);
        $resSuratWeb = $this->actingAs($this->user)->get('/user/peminjaman/report');
        $resSuratWeb->assertStatus(200);
        $resSuratWeb->assertSee('Tanggal Peminjaman:');
        $resSuratWeb->assertSee('15 Oktober 2026');
        $resSuratWeb->assertSee('Tgl. Penggunaan:');
        $resSuratWeb->assertSee('16 Oktober 2026');
        $resSuratWeb->assertSee('Batas Pengembalian:');
        $resSuratWeb->assertSee('17 Oktober 2026');
        $resSuratWeb->assertDontSee('October');

        // Uji Surat Peminjaman E19 (PDF)
        $resSuratPdf = $this->actingAs($this->user)->get('/user/peminjaman/pdf?kode_peminjaman=' . $kodePmb);
        $resSuratPdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $resSuratPdf->headers->get('Content-Type'));

        $htmlSuratPdf = view('user.laporan.peminjaman.report', [
            'peminjaman' => $peminjaman,
            'barang' => [
                ['nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'status' => 'tidak-tersedia']
            ],
            'catatan' => []
        ])->render();
        $this->assertStringContainsString('Tanggal Peminjaman:', $htmlSuratPdf);
        $this->assertStringContainsString('15 Oktober 2026', $htmlSuratPdf);
        $this->assertStringContainsString('Tgl. Penggunaan :', $htmlSuratPdf);
        $this->assertStringContainsString('16 Oktober 2026', $htmlSuratPdf);
        $this->assertStringContainsString('Batas Pengembalian :', $htmlSuratPdf);
        $this->assertStringContainsString('17 Oktober 2026', $htmlSuratPdf);
        $this->assertStringNotContainsString('October', $htmlSuratPdf);

        // 2. Uji Riwayat Peminjaman E19
        $resRiwayat = $this->actingAs($this->user)->get('/user/peminjaman?tab=riwayat');
        $resRiwayat->assertStatus(200);
        $resRiwayat->assertSee('Pinjam:');
        $resRiwayat->assertSee('15 Okt 2026');
        $resRiwayat->assertSee('Batas Kembali:');
        $resRiwayat->assertSee('17 Okt 2026');
        $resRiwayat->assertSee('Tgl. Penggunaan:');
        $resRiwayat->assertSee('16 Oktober 2026');
        $resRiwayat->assertSee('Batas Pengembalian:');
        $resRiwayat->assertSee('17 Oktober 2026');
        $resRiwayat->assertDontSee('October');

        // 3. Uji Halaman Daftar Pengembalian E20 (Saat Form Pengembalian Dibuka)
        session()->put('kodePeminjaman', $kodePmb);
        $resPengembalianForm = $this->actingAs($this->user)->get('/user/pengembalian');
        $resPengembalianForm->assertStatus(200);
        $resPengembalianForm->assertSee('Tgl. Penggunaan');
        $resPengembalianForm->assertSee('16 Oktober 2026');
        $resPengembalianForm->assertSee('Batas Pengembalian');
        $resPengembalianForm->assertSee('17 Oktober 2026');
        $resPengembalianForm->assertDontSee('October');

        // 4. Proses Transaksi Pengembalian E20 Aktual pada 17 Oktober 2026
        $kodePg = 'PG-SYNC-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => '2026-10-17 15:30:00', // Pengembalian aktual
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap,
        ]);

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        $peminjaman->update(['status' => 'Selesai']);

        // 5. Uji Bukti Pengembalian E20 (Web)
        $resBuktiWeb = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_peminjaman=' . $kodePmb);
        $resBuktiWeb->assertStatus(200);
        $resBuktiWeb->assertDontSee('Tanggal Peminjaman:');
        $resBuktiWeb->assertDontSee('Tanggal Pengembalian Aktual:');
        $resBuktiWeb->assertSee('Tgl. Penggunaan:');
        $resBuktiWeb->assertSee('16 Oktober 2026');
        $resBuktiWeb->assertSee('Batas Pengembalian:');
        $resBuktiWeb->assertSee('17 Oktober 2026');
        $resBuktiWeb->assertDontSee('October');

        // 6. Uji Bukti Pengembalian E20 (PDF)
        $resBuktiPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_peminjaman=' . $kodePmb);
        $resBuktiPdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $resBuktiPdf->headers->get('Content-Type'));

        $htmlBuktiPdf = view('user.laporan.pengembalian.report', [
            'pengembalian' => $pengembalian,
            'barangKembali' => [
                ['kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
            ],
            'barangHilang' => [],
        ])->render();

        $this->assertStringNotContainsString('Tanggal Peminjaman:', $htmlBuktiPdf);
        $this->assertStringNotContainsString('Tanggal Pengembalian Aktual:', $htmlBuktiPdf);
        $this->assertStringContainsString('Tgl. Penggunaan :', $htmlBuktiPdf);
        $this->assertStringContainsString('16 Oktober 2026', $htmlBuktiPdf);
        $this->assertStringContainsString('Batas Pengembalian :', $htmlBuktiPdf);
        $this->assertStringContainsString('17 Oktober 2026', $htmlBuktiPdf);
        $this->assertStringNotContainsString('October', $htmlBuktiPdf);
    }

    /**
     * Skenario 2:
     * Pengembalian Sebagian & Isolasi Tanggal Antar Transaksi Peminjaman:
     * - Surat A berisi 2 barang, baru 1 yang dikembalikan.
     * - Surat B berisi 1 barang berbeda, dengan tanggal transaksi lain.
     * - Memastikan data tanggal dan rincian barang Surat A tidak tertukar dengan Surat B
     *   meskipun ada session kodePengembalian lama.
     */
    public function test_02_pengembalian_sebagian_dan_isolasi_tanggal_antar_transaksi(): void
    {
        $b1 = $this->createBarang('BRG-PAR-A1-' . time(), 'Kamera Parsial A1');
        $b2 = $this->createBarang('BRG-PAR-A2-' . time(), 'Lensa Parsial A2');
        $b3 = $this->createBarang('BRG-PAR-B1-' . time(), 'Tripod Transaksi B');

        // Transaksi Peminjaman A
        $kodePmbA = 'PMB-TRANS-A-' . time();
        $pmbA = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbA,
            'nomor_peminjaman' => 'NP-A-01',
            'nomor_surat' => 'ST/TRANS/A',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => '2026-10-16 08:00:00',
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_kembali' => '2026-10-17', // Batas pengembalian A
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbA, 'kode_barang' => $b1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbA, 'kode_barang' => $b2->kode_barang]);

        // Transaksi Peminjaman B
        $kodePmbB = 'PMB-TRANS-B-' . time();
        $pmbB = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbB,
            'nomor_peminjaman' => 'NP-B-01',
            'nomor_surat' => 'ST/TRANS/B',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => '2026-10-20 08:00:00',
            'tanggal_penggunaan' => '2026-10-20',
            'tanggal_kembali' => '2026-10-22', // Batas pengembalian B
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbB, 'kode_barang' => $b3->kode_barang]);

        // Pengembalian parsial untuk Transaksi A: hanya b1 yang kembali pada 16 Oktober 2026
        $kodePgA = 'PG-TRANS-A-' . time();
        $pgA = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePgA,
            'kode_peminjaman' => $kodePmbA,
            'tanggal_kembali' => '2026-10-16 16:00:00', // Pengembalian aktual A
            'status' => 'Sebagian',
            'peminjam' => $this->user->nama_lengkap,
        ]);
        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePgA,
            'kode_barang' => $b1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        // Pengembalian lengkap untuk Transaksi B pada 21 Oktober 2026
        $kodePgB = 'PG-TRANS-B-' . time();
        $pgB = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePgB,
            'kode_peminjaman' => $kodePmbB,
            'tanggal_kembali' => '2026-10-21 11:00:00', // Pengembalian aktual B
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap,
        ]);
        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePgB,
            'kode_barang' => $b3->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        // Simulasikan session memegang transaksi B
        session()->put('kodePengembalian', $kodePgB);

        // Akses laporan Bukti Pengembalian A via parameter ?kode_peminjaman=PMB-TRANS-A
        // Harus menampilkan data dan tanggal Transaksi A, BUKAN tertimpa session transaksi B!
        $resA = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_peminjaman=' . $kodePmbA);
        $resA->assertStatus(200);

        // Memastikan batas pengembalian adalah milik Surat A
        $resA->assertDontSee('Tanggal Peminjaman:');
        $resA->assertDontSee('Tanggal Pengembalian Aktual:');
        $resA->assertSee('Batas Pengembalian:');
        $resA->assertSee('17 Oktober 2026');
        $resA->assertSee('Tgl. Penggunaan:');
        $resA->assertSee('16 Oktober 2026');

        // Pastikan TIDAK memuat tanggal Transaksi B
        $resA->assertDontSee('20 Oktober 2026');
        $resA->assertDontSee('21 Oktober 2026');
        $resA->assertDontSee('22 Oktober 2026');

        // Pada tabel barang:
        // b1 ada di tabel kembali
        $resA->assertSee($b1->nama_barang);
        // b2 ada di tabel belum kembali (Masih Dipinjam)
        $resA->assertSee($b2->nama_barang);
        $resA->assertSee('Masih Dipinjam');
        // b3 TIDAK boleh ada di laporan Transaksi A
        $resA->assertDontSee($b3->nama_barang);

        // Pastikan status peminjaman A adalah Dikembalikan Sebagian
        $pmbA->refresh();
        $this->assertEquals('Dikembalikan Sebagian', $pmbA->computed_status);
    }
}
