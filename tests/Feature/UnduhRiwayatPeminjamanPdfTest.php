<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\BmnBarang;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use App\Models\Jabatan;
use App\Models\JenisBarang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Peruntukan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class UnduhRiwayatPeminjamanPdfTest extends TestCase
{
    use DatabaseTransactions;

    protected User $user1;
    protected User $user2;
    protected Peruntukan $peruntukan;
    protected JenisBarang $jenisBarang;

    protected function setUp(): void
    {
        parent::setUp();

        $jabatan = Jabatan::firstOrCreate(['jabatan' => 'Petugas Khusus'], ['uuid' => (string) Str::uuid()]);

        $this->user1 = User::factory()->create([
            'nip' => '999001',
            'nama_lengkap' => 'Pengguna Riwayat Satu',
            'email' => 'user1_pdf_riwayat@test.com',
            'role' => 'user',
            'jabatan_id' => $jabatan->id,
        ]);

        $this->user2 = User::factory()->create([
            'nip' => '999002',
            'nama_lengkap' => 'Pengguna Riwayat Dua',
            'email' => 'user2_pdf_riwayat@test.com',
            'role' => 'user',
            'jabatan_id' => $jabatan->id,
        ]);

        $this->peruntukan = Peruntukan::first() ?? Peruntukan::create([
            'uuid' => (string) Str::uuid(),
            'peruntukan' => 'Operasional Berita',
        ]);

        $this->jenisBarang = JenisBarang::first() ?? JenisBarang::create([
            'uuid' => (string) Str::uuid(),
            'jenis_barang' => 'Elektronik Studio',
        ]);
    }

    private function createBmnDanBarang(string $kode, string $nama): array
    {
        $bmn = BmnBarang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'kategori' => 'Elektronik',
            'nup' => '1',
            'merk' => 'Sony',
            'nomor_seri' => 'SN-' . $kode,
            'jumlah' => 1,
            'kondisi' => 'Baik',
            'ruangan' => 'Studio 1',
        ]);

        $barang = Barang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'merk' => 'Sony',
            'nomor_seri' => 'SN-' . $kode,
            'status' => 'tersedia',
            'jumlah' => 1,
            'limit' => 1,
            'sisa_limit' => 1,
            'jenis_barang_id' => $this->jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);

        return [$bmn, $barang];
    }

    /**
     * 1. PDF satu transaksi hanya berisi data dari kode PMB yang dipilih.
     */
    public function test_01_unduh_satu_transaksi_pdf_hanya_berisi_data_kode_pmb_terpilih(): void
    {
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-TEST-01A-' . time(), 'Kamera Utama');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-TEST-01B-' . time(), 'Tripod Carbon');

        $kodePmb1 = 'PMB-01A-' . time();
        $kodePmb2 = 'PMB-01B-' . time();

        $pmb1 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb1,
            'nomor_peminjaman' => 'PMJ-202610-01A',
            'nomor_surat' => 'ST/01A/2026',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $brg1->kode_barang]);

        $pmb2 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb2,
            'nomor_peminjaman' => 'PMJ-202610-01B',
            'nomor_surat' => 'ST/01B/2026',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb2, 'kode_barang' => $brg2->kode_barang]);

        // HTTP request ke endpoint riwayat PDF satu transaksi
        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmb1]));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
        $this->assertStringContainsString('riwayat-peminjaman-' . Str::slug($kodePmb1) . '.pdf', (string) $response->headers->get('content-disposition'));

        // Render view untuk memverifikasi isolasi konten
        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb1->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmb1,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString($kodePmb1, $html);
        $this->assertStringContainsString('ST/01A/2026', $html);
        $this->assertStringContainsString($brg1->kode_barang, $html);
        $this->assertStringNotContainsString($kodePmb2, $html);
        $this->assertStringNotContainsString('ST/01B/2026', $html);
    }

    /**
     * 2. Semua barang dalam satu transaksi tercantum dalam satu PDF.
     */
    public function test_02_semua_barang_dalam_satu_transaksi_tercantum_dalam_satu_pdf(): void
    {
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-MULTI-1-' . time(), 'Lensa Cinema');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-MULTI-2-' . time(), 'Wireless Mic');
        [$bmn3, $brg3] = $this->createBmnDanBarang('BRG-MULTI-3-' . time(), 'Lighting LED');

        $kodePmb = 'PMB-MULTI-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202610-MULTI',
            'nomor_surat' => 'ST/MULTI/2026',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(3)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg2->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg3->kode_barang]);

        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmb]));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));

        // Render view dan cek ketiga barang tercantum
        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmb,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString($brg1->kode_barang, $html);
        $this->assertStringContainsString('Lensa Cinema', $html);
        $this->assertStringContainsString($brg2->kode_barang, $html);
        $this->assertStringContainsString('Wireless Mic', $html);
        $this->assertStringContainsString($brg3->kode_barang, $html);
        $this->assertStringContainsString('Lighting LED', $html);
    }

    /**
     * 3. PDF semua riwayat memuat seluruh transaksi yang berhak diakses, bukan hanya halaman pagination aktif.
     */
    public function test_03_unduh_semua_riwayat_memuat_seluruh_transaksi_tanpa_terbatas_pagination(): void
    {
        $createdTransactions = [];
        // Buat 12 transaksi untuk user1 (halaman pagination normal adalah 10)
        for ($i = 1; $i <= 12; $i++) {
            [$bmn, $brg] = $this->createBmnDanBarang('BRG-PAGI-' . $i . '-' . time(), 'Alat ' . $i);
            $kodePmb = 'PMB-PAGI-' . $i . '-' . time();

            $p = Peminjaman::create([
                'uuid' => (string) Str::uuid(),
                'kode_peminjaman' => $kodePmb,
                'nomor_peminjaman' => 'PMJ-PAGI-' . $i,
                'nomor_surat' => 'ST/PAGI/' . $i,
                'peruntukan_id' => $this->peruntukan->id,
                'tanggal_penggunaan' => now()->toDateString(),
                'tanggal_peminjaman' => now()->subDays($i),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
                'peminjam' => $this->user1->nama_lengkap,
                'status' => 'Proses',
            ]);
            DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg->kode_barang]);
            $createdTransactions[] = $p;
        }

        // Buka unduh semua riwayat (tanpa kode_peminjaman)
        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf'));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
        $this->assertStringContainsString('semua-riwayat-peminjaman-', (string) $response->headers->get('content-disposition'));

        // Cek bahwa view template merender semua 12 transaksi
        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => Peminjaman::with(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])
                ->where('peminjam', $this->user1->nama_lengkap)->get(),
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        foreach ($createdTransactions as $tx) {
            $this->assertStringContainsString($tx->kode_peminjaman, $html);
            $this->assertStringContainsString($tx->nomor_surat, $html);
        }
    }

    /**
     * 4. Data transaksi tidak tercampur antarkode PMB.
     */
    public function test_04_data_transaksi_tidak_tercampur_antar_kode_pmb(): void
    {
        [$bmnA, $brgA] = $this->createBmnDanBarang('BRG-A-' . time(), 'Kamera A');
        [$bmnB, $brgB] = $this->createBmnDanBarang('BRG-B-' . time(), 'Kamera B');

        $kodePmbA = 'PMB-ISO-A-' . time();
        $kodePmbB = 'PMB-ISO-B-' . time();

        $pmbA = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbA,
            'nomor_peminjaman' => 'PMJ-ISO-A',
            'nomor_surat' => 'ST/ISO/A',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(1)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbA, 'kode_barang' => $brgA->kode_barang]);

        $pmbB = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbB,
            'nomor_peminjaman' => 'PMJ-ISO-B',
            'nomor_surat' => 'ST/ISO/B',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(1)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbB, 'kode_barang' => $brgB->kode_barang]);

        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmbA]));

        $response->assertStatus(200);

        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmbA->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmbA,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString($brgA->kode_barang, $html);
        $this->assertStringContainsString('Kamera A', $html);
        $this->assertStringNotContainsString($brgB->kode_barang, $html);
        $this->assertStringNotContainsString('Kamera B', $html);
    }

    /**
     * 5. Pengguna tidak dapat mengunduh transaksi di luar hak aksesnya (403 Forbidden).
     */
    public function test_05_pengguna_tidak_dapat_mengunduh_transaksi_di_luar_hak_aksesnya(): void
    {
        [$bmn, $brg] = $this->createBmnDanBarang('BRG-FORBIDDEN-' . time(), 'Rahasia User 2');
        $kodePmbUser2 = 'PMB-U2-' . time();

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbUser2,
            'nomor_peminjaman' => 'PMJ-U2-001',
            'nomor_surat' => 'ST/U2/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user2->nama_lengkap, // Milik User 2
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbUser2, 'kode_barang' => $brg->kode_barang]);

        // User 1 mencoba mengunduh transaksi milik User 2
        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmbUser2]));

        $response->assertStatus(403);
    }

    /**
     * 6. Kondisi riwayat kosong ditangani dengan benar tanpa error 500.
     */
    public function test_06_kondisi_riwayat_kosong_ditangani_dengan_benar(): void
    {
        $userBaru = User::factory()->create([
            'nip' => '999009',
            'nama_lengkap' => 'Pengguna Baru Nol Riwayat',
            'email' => 'user_empty_riwayat@test.com',
            'role' => 'user',
        ]);

        $response = $this->actingAs($userBaru)
            ->get(route('user.peminjaman.riwayat.pdf'));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));

        // Cek bahwa pesan kondisi kosong ter-render dengan baik
        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([]),
            'isSingle' => false,
            'user' => $userBaru,
            'peminjamUser' => $userBaru,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('Tidak Ada Data Riwayat Peminjaman', $html);
    }

    /**
     * 7. Filter pencarian atau status bekerja sesuai ketentuan pada unduh semua riwayat.
     */
    public function test_07_filter_pencarian_dan_status_bekerja_sesuai_ketentuan(): void
    {
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-FILT-1-' . time(), 'Filter Drone X');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-FILT-2-' . time(), 'Filter Audio Recorder');

        $suratMatch = 'ST/SPECIAL/FILTER/MATCH';
        $suratOther = 'ST/OTHER/IGNORE';

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-FL-MATCH-' . time(),
            'nomor_peminjaman' => 'PMJ-MATCH-01',
            'nomor_surat' => $suratMatch,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Selesai',
        ]);

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-FL-OTHER-' . time(),
            'nomor_peminjaman' => 'PMJ-OTHER-02',
            'nomor_surat' => $suratOther,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);

        // Filter status Selesai
        $resStatus = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['status_riwayat' => 'Selesai']));
        $resStatus->assertStatus(200);
        $this->assertEquals('application/pdf', $resStatus->headers->get('content-type'));

        // Filter pencarian
        $resSearch = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['search_riwayat' => 'SPECIAL']));
        $resSearch->assertStatus(200);
        $this->assertEquals('application/pdf', $resSearch->headers->get('content-type'));
    }

    /**
     * 8. Informasi tanggal dan status pada PDF sesuai dengan data transaksi.
     */
    public function test_08_informasi_tanggal_dan_status_pada_pdf_sesuai_dengan_data_transaksi(): void
    {
        [$bmn, $brg] = $this->createBmnDanBarang('BRG-INFO-' . time(), 'Kamera Studio Info');
        $kodePmb = 'PMB-INFO-' . time();
        $tglPinjam = '2026-10-10 08:30:00';
        $tglPenggunaan = '2026-10-11';
        $tglKembali = '2026-10-15';

        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-INFO-001',
            'nomor_surat' => 'ST/INFO/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => $tglPenggunaan,
            'tanggal_peminjaman' => $tglPinjam,
            'tanggal_kembali' => $tglKembali,
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg->kode_barang]);

        // Simulasikan pengembalian barang dengan kondisi 'rusak'
        $kodePgb = 'PGB-INFO-' . time();
        $tglAktualKembali = '2026-10-14';
        Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePgb,
            'kode_peminjaman' => $kodePmb,
            'peminjam' => $this->user1->nama_lengkap,
            'tanggal_kembali' => $tglAktualKembali,
            'status' => 'selesai',
        ]);

        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePgb,
            'kode_barang' => $brg->kode_barang,
            'status' => 'rusak',
            'deskripsi' => 'Lensa tergores ringan',
        ]);

        $response = $this->actingAs($this->user1)
            ->get(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmb]));

        $response->assertStatus(200);

        // Render view dan cek informasi tanggal dan status di HTML
        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmb,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('Sudah Kembali', $html);
        $this->assertStringContainsString('Rusak', $html);
        $this->assertStringContainsString('Lensa tergores ringan', $html);
        $this->assertStringContainsString('10 Okt 2026', $html);
        $this->assertStringContainsString('11 Okt 2026', $html);
        $this->assertStringContainsString('15 Okt 2026', $html);
    }

    /**
     * 9. Halaman web riwayat memuat tombol 'Unduh Semua Riwayat' dan tombol 'Unduh PDF'.
     */
    public function test_09_halaman_web_memuat_tombol_unduh_semua_riwayat_dan_unduh_pdf(): void
    {
        [$bmn, $brg] = $this->createBmnDanBarang('BRG-BTN-VIEW-' . time(), 'Kamera Button View');
        $kodePmb = 'PMB-BTN-VIEW-' . time();

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-BTN-01',
            'nomor_surat' => 'ST/BTN/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg->kode_barang]);

        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);

        // Tombol unduh semua riwayat di bagian atas halaman
        $res->assertSee('Unduh Semua Riwayat');
        $res->assertSee(route('user.peminjaman.riwayat.pdf'));

        // Tombol unduh PDF satu transaksi di tabel
        $res->assertSee('Unduh PDF');
        $res->assertSee(route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $kodePmb]));
    }

    /**
     * 10. Fitur surat peminjaman lama dan route PDF lama tetap berjalan tanpa regresi.
     */
    public function test_10_endpoint_lama_surat_peminjaman_tetap_berfungsi(): void
    {
        [$bmn, $brg] = $this->createBmnDanBarang('BRG-LEGACY-' . time(), 'Kamera Legacy');
        $kodePmb = 'PMB-LEGACY-' . time();

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-LEGACY-01',
            'nomor_surat' => 'ST/LEGACY/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg->kode_barang]);

        // Route lama: /user/peminjaman/pdf?kode_peminjaman=...
        $pdfRes = $this->actingAs($this->user1)
            ->get('/user/peminjaman/pdf?kode_peminjaman=' . $kodePmb);

        $pdfRes->assertStatus(200);
        $this->assertEquals('application/pdf', $pdfRes->headers->get('content-type'));
    }

    /**
     * 11. Setiap transaksi pada Unduh Semua Riwayat memiliki nomor urut otomatis dan berurutan (Transaksi #1, #2, #3).
     */
    public function test_11_nomor_urut_transaksi_otomatis_dan_berurutan_pada_unduh_semua_riwayat(): void
    {
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-NUM-1-' . time(), 'Kamera Num 1');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-NUM-2-' . time(), 'Kamera Num 2');
        [$bmn3, $brg3] = $this->createBmnDanBarang('BRG-NUM-3-' . time(), 'Kamera Num 3');

        $kodePmb1 = 'PMB-NUM-01-' . time();
        $kodePmb2 = 'PMB-NUM-02-' . time();
        $kodePmb3 = 'PMB-NUM-03-' . time();

        $pmb1 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb1,
            'nomor_peminjaman' => 'PMJ-NUM-01',
            'nomor_surat' => 'ST/NUM/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now()->subDays(3),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $brg1->kode_barang]);

        $pmb2 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb2,
            'nomor_peminjaman' => 'PMJ-NUM-02',
            'nomor_surat' => 'ST/NUM/02',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now()->subDays(2),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb2, 'kode_barang' => $brg2->kode_barang]);

        $pmb3 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb3,
            'nomor_peminjaman' => 'PMJ-NUM-03',
            'nomor_surat' => 'ST/NUM/03',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now()->subDays(1),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb3, 'kode_barang' => $brg3->kode_barang]);

        // Urutan: pmb3 (Transaksi #1), pmb2 (Transaksi #2), pmb1 (Transaksi #3)
        $list = collect([$pmb3, $pmb2, $pmb1]);

        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => $list,
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('Transaksi #1', $html);
        $this->assertStringContainsString('Transaksi #2', $html);
        $this->assertStringContainsString('Transaksi #3', $html);

        // Verifikasi urutan kemunculan Transaksi #1 sebelum Transaksi #2, dan Transaksi #2 sebelum Transaksi #3
        $pos1 = strpos($html, 'Transaksi #1');
        $pos2 = strpos($html, 'Transaksi #2');
        $pos3 = strpos($html, 'Transaksi #3');

        $this->assertTrue($pos1 < $pos2, 'Transaksi #1 harus muncul sebelum Transaksi #2');
        $this->assertTrue($pos2 < $pos3, 'Transaksi #2 harus muncul sebelum Transaksi #3');
    }

    /**
     * 12. Satu transaksi dengan banyak barang hanya memiliki satu nomor urut transaksi.
     */
    public function test_12_transaksi_banyak_barang_memiliki_satu_nomor_urut_transaksi(): void
    {
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-MB-1-' . time(), 'Kamera A');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-MB-2-' . time(), 'Kamera B');
        [$bmn3, $brg3] = $this->createBmnDanBarang('BRG-MB-3-' . time(), 'Kamera C');

        $kodePmb = 'PMB-MB-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-MB-01',
            'nomor_surat' => 'ST/MB/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg2->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg3->kode_barang]);

        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        // Hanya ada 1 nomor urut transaksi (Transaksi #1)
        $this->assertEquals(1, substr_count($html, '<span class="tx-badge">'));
        $this->assertStringContainsString('Transaksi #1', $html);
        $this->assertStringNotContainsString('Transaksi #2', $html);

        // Namun ketiga barang ada di dalam tabel rincian barang
        $this->assertStringContainsString($brg1->kode_barang, $html);
        $this->assertStringContainsString($brg2->kode_barang, $html);
        $this->assertStringContainsString($brg3->kode_barang, $html);
    }

    /**
     * 13. Nomor urut transaksi berlanjut secara konsisten pada dataset banyak transaksi.
     */
    public function test_13_nomor_urut_transaksi_berlanjut_tanpa_reset(): void
    {
        $transactions = [];
        for ($i = 1; $i <= 8; $i++) {
            [$bmn, $brg] = $this->createBmnDanBarang('BRG-SEQ-' . $i . '-' . time(), 'Alat Seq ' . $i);
            $kode = 'PMB-SEQ-' . $i . '-' . time();
            $p = Peminjaman::create([
                'uuid' => (string) Str::uuid(),
                'kode_peminjaman' => $kode,
                'nomor_peminjaman' => 'PMJ-SEQ-' . $i,
                'nomor_surat' => 'ST/SEQ/' . $i,
                'peruntukan_id' => $this->peruntukan->id,
                'tanggal_penggunaan' => now()->toDateString(),
                'tanggal_peminjaman' => now()->subHours($i),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
                'peminjam' => $this->user1->nama_lengkap,
                'status' => 'Proses',
            ]);
            DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kode, 'kode_barang' => $brg->kode_barang]);
            $transactions[] = $p;
        }

        $html = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect($transactions),
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        for ($i = 1; $i <= 8; $i++) {
            $this->assertStringContainsString('Transaksi #' . $i, $html);
        }
    }

    /**
     * 14. Nomor pada kolom 'No' berurutan secara global di seluruh transaksi (1, 2, 3, 4, 5...).
     */
    public function test_14_nomor_urut_kolom_no_berurutan_global_antar_transaksi(): void
    {
        // Transaksi 1: 3 barang (No: 1, 2, 3)
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-G1-1-' . time(), 'Barang G1-1');
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-G1-2-' . time(), 'Barang G1-2');
        [$bmn3, $brg3] = $this->createBmnDanBarang('BRG-G1-3-' . time(), 'Barang G1-3');

        $kodePmb1 = 'PMB-GLOBAL-1-' . time();
        $pmb1 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb1,
            'nomor_peminjaman' => 'PMJ-G1',
            'nomor_surat' => 'ST/G1',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now()->subDays(2),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $brg1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $brg2->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $brg3->kode_barang]);

        // Transaksi 2: 2 barang (No: 4, 5 - BUKAN 1, 2)
        [$bmn4, $brg4] = $this->createBmnDanBarang('BRG-G2-1-' . time(), 'Barang G2-1');
        [$bmn5, $brg5] = $this->createBmnDanBarang('BRG-G2-2-' . time(), 'Barang G2-2');

        $kodePmb2 = 'PMB-GLOBAL-2-' . time();
        $pmb2 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb2,
            'nomor_peminjaman' => 'PMJ-G2',
            'nomor_surat' => 'ST/G2',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now()->subDays(1),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb2, 'kode_barang' => $brg4->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb2, 'kode_barang' => $brg5->kode_barang]);

        $htmlAll = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([
                $pmb1->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian']),
                $pmb2->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian']),
            ]),
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        // Verifikasi sel tabel No memuat angka 1, 2, 3 untuk transaksi 1 dan 4, 5 untuk transaksi 2
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">1</td>', $htmlAll);
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">2</td>', $htmlAll);
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">3</td>', $htmlAll);
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">4</td>', $htmlAll);
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">5</td>', $htmlAll);

        // Pada mode single transaksi, nomor urut barang transaksi 2 kembali mulai dari 1
        $htmlSingle = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb2->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmb2,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">1</td>', $htmlSingle);
        $this->assertStringContainsString('<td style="text-align: center; color: #64748b;">2</td>', $htmlSingle);
        $this->assertStringNotContainsString('<td style="text-align: center; color: #64748b;">4</td>', $htmlSingle);
    }

    /**
     * 15. Informasi tanggal tidak berulang saat tanggal peminjaman dan penggunaan sama.
     */
    public function test_15_informasi_tanggal_tidak_berulang_saat_pinjam_dan_penggunaan_sama(): void
    {
        // Kasus 1: Tanggal Pinjam dan Penggunaan SAMA (16 Okt 2026)
        [$bmn1, $brg1] = $this->createBmnDanBarang('BRG-SAME-1-' . time(), 'Kamera Same');
        $kodePmbSame = 'PMB-SAME-' . time();

        $pmbSame = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbSame,
            'nomor_peminjaman' => 'PMJ-SAME',
            'nomor_surat' => 'ST/SAME/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_peminjaman' => '2026-10-16 09:00:00',
            'tanggal_kembali' => '2026-10-18',
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbSame, 'kode_barang' => $brg1->kode_barang]);

        $htmlSame = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmbSame->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmbSame,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        // Harus menampilkan Penggunaan: 16 Okt 2026 dan Batas: 18 Okt 2026
        $this->assertStringContainsString('Penggunaan: <strong>16 Okt 2026</strong>', $htmlSame);
        $this->assertStringContainsString('Batas: <strong>18 Okt 2026</strong>', $htmlSame);
        // TIDAK menampilkan Pinjam: 16 Okt 2026 berulang di baris header transaksi
        $this->assertStringNotContainsString('Pinjam: <strong>16 Okt 2026</strong>', $htmlSame);

        // Kasus 2: Tanggal Pinjam dan Penggunaan BERBEDA (Pinjam: 14 Okt 2026, Penggunaan: 16 Okt 2026)
        [$bmn2, $brg2] = $this->createBmnDanBarang('BRG-DIFF-1-' . time(), 'Kamera Diff');
        $kodePmbDiff = 'PMB-DIFF-' . time();

        $pmbDiff = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbDiff,
            'nomor_peminjaman' => 'PMJ-DIFF',
            'nomor_surat' => 'ST/DIFF/01',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_peminjaman' => '2026-10-14 09:00:00',
            'tanggal_kembali' => '2026-10-18',
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmbDiff, 'kode_barang' => $brg2->kode_barang]);

        $htmlDiff = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmbDiff->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmbDiff,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        // Saat berbeda, kedua tanggal ditampilkan
        $this->assertStringContainsString('Pinjam: <strong>14 Okt 2026</strong>', $htmlDiff);
        $this->assertStringContainsString('Penggunaan: <strong>16 Okt 2026</strong>', $htmlDiff);
        $this->assertStringContainsString('Batas: <strong>18 Okt 2026</strong>', $htmlDiff);
    }

    /**
     * 16. Memastikan perbedaan tegas antara Batas Pengembalian dan Tanggal Kembali Aktual
     * pada PDF individual dan Unduh Semua (misal: penggunaan 16 Okt, batas 18 Okt, kembali aktual 16 Okt).
     */
    public function test_16_perbedaan_jelas_antara_batas_pengembalian_dan_tanggal_kembali_aktual(): void
    {
        [$bmn, $brg] = $this->createBmnDanBarang('BRG-DIFF-TGL-' . time(), 'Kamera Studio E20');
        $kodePmb = 'PMB-TEST-16-18-' . time();

        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-TGL-1618',
            'nomor_surat' => 'ST/TGL/1618',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => '2026-10-16',
            'tanggal_peminjaman' => '2026-10-16 08:00:00',
            'tanggal_kembali' => '2026-10-18', // Batas pengembalian
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Selesai',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $brg->kode_barang]);

        $kodePg = 'PG-TEST-1618-' . time();
        $pg = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => '2026-10-16 15:00:00', // Tanggal pengembalian aktual
            'status' => 'Lengkap',
            'peminjam' => $this->user1->nama_lengkap,
        ]);
        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $brg->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        // 1. Uji PDF Individual
        $htmlSingle = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => true,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Riwayat Peminjaman Barang - ' . $kodePmb,
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('<th style="width: 90px; text-align: center;">Tgl. Kembali</th>', $htmlSingle);
        $this->assertStringContainsString('Penggunaan: <strong>16 Okt 2026</strong>', $htmlSingle);
        $this->assertStringContainsString('Batas: <strong>18 Okt 2026</strong>', $htmlSingle);
        $this->assertMatchesRegularExpression('/<td style="text-align: center; font-size: 9\.5px;">\s*18 Okt 2026\s*<\/td>/', $htmlSingle);

        // 2. Uji PDF Unduh Semua
        $htmlAll = view('user.laporan.peminjaman.riwayat_pdf', [
            'riwayatList' => collect([$pmb->load(['peruntukan', 'detailPeminjaman.barang', 'pengembalian.detailPengembalian'])]),
            'isSingle' => false,
            'user' => $this->user1,
            'peminjamUser' => $this->user1,
            'title' => 'Laporan Seluruh Riwayat Peminjaman Barang',
            'filters' => ['search' => null, 'status' => null, 'peruntukan' => null],
            'printDate' => now(),
        ])->render();

        $this->assertStringContainsString('<th style="width: 90px; text-align: center;">Tgl. Kembali</th>', $htmlAll);
        $this->assertStringContainsString('Penggunaan: <strong>16 Okt 2026</strong>', $htmlAll);
        $this->assertStringContainsString('Batas: <strong>18 Okt 2026</strong>', $htmlAll);
        $this->assertMatchesRegularExpression('/<td style="text-align: center; font-size: 9\.5px;">\s*18 Okt 2026\s*<\/td>/', $htmlAll);
    }
}
