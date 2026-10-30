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

class PdfPengembalianE20Test extends TestCase
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
            'nama_lengkap' => 'Tester E20 User',
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
            'status' => 'tidak-tersedia',
            'jumlah' => 1,
            'limit' => 5,
            'sisa_limit' => 0,
            'jenis_barang_id' => $this->jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);
    }

    /**
     * Skenario 1: Semua barang sudah dikembalikan.
     * Baik pada proses Cetak Bukti (PDF) maupun Lihat Bukti (HTML), tabel kuning tidak muncul.
     */
    public function test_01_semua_barang_sudah_dikembalikan_tabel_kuning_tidak_muncul_pada_cetak_dan_lihat_bukti(): void
    {
        $b1 = $this->createBarang('BRG-PDF-ALL-1-' . time(), 'Kamera Utama A');
        $b2 = $this->createBarang('BRG-PDF-ALL-2-' . time(), 'Lensa 24-70mm A');

        $kodePmb = 'PMB-PDF-ALL-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-PDF-01',
            'nomor_surat' => 'ST/PDF/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b2->kode_barang]);

        $kodePg = 'PG-PDF-ALL-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
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

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b2->kode_barang,
            'status' => 'rusak',
            'deskripsi' => 'Fokus lensa macet',
        ]);

        // 1. Uji Proses Cetak Bukti (PDF)
        $resPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_pengembalian=' . $kodePg);
        $resPdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $resPdf->headers->get('Content-Type'));

        $htmlPdf = view('user.laporan.pengembalian.report', [
            'pengembalian' => $pengembalian,
            'barangKembali' => [
                ['kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
                ['kode_barang' => $b2->kode_barang, 'nama_barang' => $b2->nama_barang, 'merk' => $b2->merk, 'nomor_seri' => $b2->nomor_seri, 'kondisi' => 'rusak', 'deskripsi' => 'Fokus lensa macet'],
            ],
            'barangHilang' => [],
        ])->render();

        $this->assertStringContainsString('table class="products"', $htmlPdf);
        $this->assertStringNotContainsString('Barang Belum dikembalikan:', $htmlPdf);
        $this->assertStringNotContainsString('table class="back"', $htmlPdf);
        $this->assertStringNotContainsString('Nihil', $htmlPdf);

        // 2. Uji Proses Lihat Bukti (HTML)
        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);
        $resHtml->assertSee($pengembalian->kode_pengembalian);
        $resHtml->assertSee($b1->nama_barang);
        $resHtml->assertSee($b2->nama_barang);
        $resHtml->assertDontSee('Barang belum dikembalikan');
        $resHtml->assertDontSee('Tidak ada barang yang belum dikembalikan (Nihil)');
    }

    /**
     * Skenario 2: Masih ada barang yang belum dikembalikan (barang hilang).
     * Baik pada proses Cetak Bukti (PDF) maupun Lihat Bukti (HTML), tabel kuning muncul dengan data yang benar.
     */
    public function test_02_masih_ada_barang_belum_dikembalikan_tabel_kuning_muncul_pada_kedua_proses(): void
    {
        $b1 = $this->createBarang('BRG-PDF-HLG-1-' . time(), 'Kamera Utama B');
        $b2 = $this->createBarang('BRG-PDF-HLG-2-' . time(), 'Mic Wireless B');

        $kodePmb = 'PMB-PDF-HLG-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-PDF-02',
            'nomor_surat' => 'ST/PDF/002',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b2->kode_barang]);

        $kodePg = 'PG-PDF-HLG-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
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

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b2->kode_barang,
            'status' => 'hilang',
            'deskripsi' => 'Mic hilang di studio liputan',
        ]);

        // 1. Cetak Bukti (PDF)
        $resPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_pengembalian=' . $kodePg);
        $resPdf->assertStatus(200);

        $htmlPdf = view('user.laporan.pengembalian.report', [
            'pengembalian' => $pengembalian,
            'barangKembali' => [
                ['kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
            ],
            'barangHilang' => [
                ['kode_barang' => $b2->kode_barang, 'nama_barang' => $b2->nama_barang, 'merk' => $b2->merk, 'nomor_seri' => $b2->nomor_seri, 'deskripsi' => 'Mic hilang di studio liputan'],
            ],
        ])->render();

        $this->assertStringContainsString('table class="products"', $htmlPdf);
        $this->assertStringContainsString($b1->nama_barang, $htmlPdf);
        $this->assertStringContainsString('Barang Belum dikembalikan:', $htmlPdf);
        $this->assertStringContainsString('table class="back"', $htmlPdf);
        $this->assertStringContainsString($b2->nama_barang, $htmlPdf);
        $this->assertStringContainsString('Mic hilang di studio liputan', $htmlPdf);

        // 2. Lihat Bukti (HTML)
        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);
        $resHtml->assertSee($b1->nama_barang);
        $resHtml->assertSee('Barang belum dikembalikan');
        $resHtml->assertSee($b2->nama_barang);
        $resHtml->assertSee('Mic hilang di studio liputan');
        $resHtml->assertDontSee('Tidak ada barang yang belum dikembalikan (Nihil)');
    }

    /**
     * Skenario 3: Pengembalian sebagian.
     * Tabel biru berisi barang yang sudah kembali, tabel kuning berisi barang yang belum kembali.
     * Konsisten pada kedua proses (PDF dan HTML).
     */
    public function test_03_pengembalian_sebagian_konsisten_pada_cetak_dan_lihat_bukti(): void
    {
        $b1 = $this->createBarang('BRG-PDF-PAR-1-' . time(), 'Kamera Parsial 1');
        $b2 = $this->createBarang('BRG-PDF-PAR-2-' . time(), 'Kamera Parsial 2');
        $b3 = $this->createBarang('BRG-PDF-PAR-3-' . time(), 'Tripod Belum Kembali');

        $kodePmb = 'PMB-PDF-PAR-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-PDF-03',
            'nomor_surat' => 'ST/PDF/003',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b2->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b3->kode_barang]);

        $kodePg = 'PG-PDF-PAR-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Sebagian',
            'peminjam' => $this->user->nama_lengkap,
        ]);

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b2->kode_barang,
            'status' => 'rusak',
            'deskripsi' => 'Layar LCD pecah',
        ]);

        // 1. Cetak Bukti (PDF)
        $resPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_pengembalian=' . $kodePg);
        $resPdf->assertStatus(200);

        // 2. Lihat Bukti (HTML)
        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);

        // Tabel biru berisi barang yang sudah kembali
        $resHtml->assertSee($b1->nama_barang);
        $resHtml->assertSee($b2->nama_barang);

        // Tabel kuning hanya berisi barang yang belum kembali
        $resHtml->assertSee('Barang belum dikembalikan');
        $resHtml->assertSee($b3->nama_barang);
        $resHtml->assertSee('Masih Dipinjam');

        // Status transaksi tetap belum selesai
        $peminjaman->refresh();
        $this->assertEquals('Dikembalikan Sebagian', $peminjaman->computed_status);
    }

    /**
     * Skenario 4: Ada barang yang dikembalikan dalam kondisi rusak.
     * Kondisi rusak dan penjelasannya tetap tercantum pada tabel biru pada Cetak dan Lihat Bukti.
     */
    public function test_04_barang_rusak_tercantum_pada_tabel_biru_di_kedua_proses(): void
    {
        $b1 = $this->createBarang('BRG-PDF-RSK-' . time(), 'Lampu Flash Rusak');

        $kodePmb = 'PMB-PDF-RSK-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-PDF-04',
            'nomor_surat' => 'ST/PDF/004',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);

        $kodePg = 'PG-PDF-RSK-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap,
        ]);

        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $b1->kode_barang,
            'status' => 'rusak',
            'deskripsi' => 'Bohlam flash putus dan terbakar',
        ]);

        // 1. Cetak Bukti (PDF)
        $resPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_pengembalian=' . $kodePg);
        $resPdf->assertStatus(200);

        // 2. Lihat Bukti (HTML)
        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);
        $resHtml->assertSee($b1->nama_barang);
        $resHtml->assertSee('rusak');
        $resHtml->assertSee('Bohlam flash putus dan terbakar');
        $resHtml->assertDontSee('Barang belum dikembalikan');
    }

    /**
     * Skenario 5: Informasi utama surat tetap lengkap.
     */
    public function test_05_informasi_utama_surat_tetap_lengkap(): void
    {
        $b1 = $this->createBarang('BRG-PDF-INFO-' . time(), 'Audio Recorder H6');

        $kodePmb = 'PMB-PDF-INFO-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-PDF-INFO-777',
            'nomor_surat' => 'ST/KHUSUS/777',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(3)->toDateString(),
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);

        $kodePg = 'PG-PDF-INFO-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
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

        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Daftar Barang Kembali');
        $resHtml->assertSee('NP-PDF-INFO-777');
        $resHtml->assertSee($kodePg);
        $resHtml->assertSee($this->user->nama_lengkap);
        $resHtml->assertSee('ST/KHUSUS/777');
        $resHtml->assertSee($this->peruntukan->peruntukan);
    }

    /**
     * Skenario 6: Format tanggal Bahasa Indonesia (Oktober bukan October),
     * serta pemisahan jelas antara Batas Pengembalian dan Tanggal Pengembalian Aktual (tanpa Tanggal Peminjaman pada bukti E20).
     */
    public function test_06_format_tanggal_dan_label_pada_lihat_bukti_dan_cetak_pdf_konsisten_bahasa_indonesia(): void
    {
        $b1 = $this->createBarang('BRG-TGL-1-' . time(), 'Kamera Mirrorless TGL');

        $kodePmb = 'PMB-TGL-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-TGL-01',
            'nomor_surat' => 'ST/TGL/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => '2026-10-16',
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_kembali' => '2026-10-18', // Batas pengembalian sesuai surat
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);

        $kodePg = 'PG-TGL-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => '2026-10-17 14:30:00', // Pengembalian aktual tercatat tanggal 17
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

        // 1. Uji Tampilan HTML (Lihat Bukti)
        $resHtml = $this->actingAs($this->user)->get('/user/pengembalian/report?kode_pengembalian=' . $kodePg);
        $resHtml->assertStatus(200);

        // Pastikan label Tanggal Peminjaman dan Tanggal Pengembalian Aktual tidak muncul di luar tabel, sedangkan Tgl. Penggunaan dan Batas Pengembalian tampil
        $resHtml->assertDontSee('Tanggal Peminjaman:');
        $resHtml->assertDontSee('Tanggal Pengembalian Aktual:');
        $resHtml->assertSee('Tgl. Penggunaan:');
        $resHtml->assertSee('16 Oktober 2026');
        $resHtml->assertSee('Batas Pengembalian:');
        $resHtml->assertSee('18 Oktober 2026');

        // Pastikan tidak ada nama bulan berbahasa Inggris 'October'
        $resHtml->assertDontSee('October');

        // 2. Uji Tampilan Cetak PDF
        $resPdf = $this->actingAs($this->user)->get('/user/pengembalian/pdf?kode_pengembalian=' . $kodePg);
        $resPdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $resPdf->headers->get('Content-Type'));

        $htmlPdf = view('user.laporan.pengembalian.report', [
            'pengembalian' => $pengembalian,
            'barangKembali' => [
                ['kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
            ],
            'barangHilang' => [],
        ])->render();

        $this->assertStringNotContainsString('Tanggal Peminjaman:', $htmlPdf);
        $this->assertStringNotContainsString('Tanggal Pengembalian Aktual:', $htmlPdf);
        $this->assertStringContainsString('Tgl. Penggunaan :', $htmlPdf);
        $this->assertStringContainsString('16 Oktober 2026', $htmlPdf);
        $this->assertStringContainsString('Batas Pengembalian :', $htmlPdf);
        $this->assertStringContainsString('18 Oktober 2026', $htmlPdf);
        $this->assertStringNotContainsString('October', $htmlPdf);
    }

    /**
     * Skenario 7: Tanggal pengembalian aktual tidak boleh terisi otomatis
     * menggunakan tanggal sekarang jika kolom di database bernilai null/kosong,
     * serta memastikan Tanggal Peminjaman tidak muncul pada bukti pengembalian.
     */
    public function test_07_tanggal_pengembalian_aktual_dan_peminjaman_tidak_otomatis_mengisi_tanggal_sekarang_jika_kosong(): void
    {
        $b1 = $this->createBarang('BRG-NULL-1-' . time(), 'Kamera Tanpa Tanggal');

        $kodePmb = 'PMB-NULL-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'NP-NULL-01',
            'nomor_surat' => 'ST/NULL/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_peminjaman' => '2026-10-16',
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_kembali' => '2026-10-18',
            'peminjam' => $this->user->nama_lengkap,
            'status' => 'Selesai',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $b1->kode_barang]);

        $kodePg = 'PG-NULL-' . time();
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => '2026-10-17',
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

        // Uji jika tanggal_kembali bernilai null pada model pengembalian saat render view
        $pengembalianNull = clone $pengembalian;
        $pengembalianNull->tanggal_kembali = null;
        $peminjamanNull = clone $peminjaman;
        $peminjamanNull->tanggal_peminjaman = null;
        $pengembalianNull->setRelation('peminjaman', $peminjamanNull);

        $htmlReport = view('user.laporan.pengembalian.report', [
            'pengembalian' => $pengembalianNull,
            'barangKembali' => [
                ['kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
            ],
            'barangHilang' => [],
        ])->render();

        // Tanggal peminjaman dan tanggal pengembalian aktual tidak muncul pada bukti pengembalian
        $this->assertStringNotContainsString('Tanggal Peminjaman:', $htmlReport);
        $this->assertStringNotContainsString('Tanggal Pengembalian Aktual:', $htmlReport);
        $this->assertStringContainsString('Tgl. Penggunaan :', $htmlReport);
        $this->assertStringContainsString('16 Oktober 2026', $htmlReport);
        $this->assertStringNotContainsString('October', $htmlReport);

        // Uji pada view index (Lihat Bukti)
        $htmlIndex = view('user.laporan.pengembalian.index', [
            'detailPengembalian' => $pengembalianNull->detailPengembalian ?? [],
            'pengembalian' => $pengembalianNull,
            'barangKembali' => [
                ['uuid' => (string) Str::uuid(), 'kode_barang' => $b1->kode_barang, 'nama_barang' => $b1->nama_barang, 'merk' => $b1->merk, 'nomor_seri' => $b1->nomor_seri, 'kondisi' => 'baik', 'deskripsi' => 'Barang Telah Dikembalikan'],
            ],
            'barangHilang' => [],
        ])->render();

        $this->assertStringNotContainsString('Tanggal Peminjaman:', $htmlIndex);
        $this->assertStringNotContainsString('Tanggal Pengembalian Aktual:', $htmlIndex);
        $this->assertStringContainsString('Tgl. Penggunaan:', $htmlIndex);
        $this->assertStringContainsString('16 Oktober 2026', $htmlIndex);
        $this->assertStringNotContainsString('October', $htmlIndex);
    }
}
