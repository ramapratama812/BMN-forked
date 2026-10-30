<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\BmnBarang;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use App\Models\Jabatan;
use App\Models\JenisBarang;
use App\Models\LaporanKerusakan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PerawatanInventaris;
use App\Models\Peruntukan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class RiwayatPeminjamanE19Test extends TestCase
{
    use DatabaseTransactions;

    protected User $user1;
    protected User $user2;
    protected User $superadmin;
    protected Peruntukan $peruntukan;
    protected JenisBarang $jenisBarang;

    protected function setUp(): void
    {
        parent::setUp();

        $jabatan = Jabatan::firstOrCreate(['jabatan' => 'Petugas Khusus'], ['uuid' => (string) Str::uuid()]);

        $this->user1 = User::factory()->create([
            'nip' => '888001',
            'nama_lengkap' => 'Peminjam User Satu',
            'email' => 'user1_riwayat@test.com',
            'role' => 'user',
            'jabatan_id' => $jabatan->id,
        ]);

        $this->user2 = User::factory()->create([
            'nip' => '888002',
            'nama_lengkap' => 'Peminjam User Dua',
            'email' => 'user2_riwayat@test.com',
            'role' => 'user',
            'jabatan_id' => $jabatan->id,
        ]);

        $this->superadmin = User::where('role', 'superadmin')->first() ?? User::factory()->create([
            'nip' => '888003',
            'nama_lengkap' => 'Super Admin Test',
            'email' => 'superadmin_riwayat@test.com',
            'role' => 'superadmin',
            'jabatan_id' => $jabatan->id,
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

    private function createBmnDanBarang(string $kode, string $nama, int $jumlah = 1, string $kondisi = 'Baik'): array
    {
        $bmn = BmnBarang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'kategori' => 'Elektronik',
            'nup' => '1',
            'merk' => 'Sony',
            'nomor_seri' => 'SN-' . $kode,
            'jumlah' => $jumlah,
            'kondisi' => $kondisi,
            'ruangan' => 'Studio 1',
        ]);

        $barang = Barang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => $kode,
            'nama_barang' => $nama,
            'merk' => 'Sony',
            'nomor_seri' => 'SN-' . $kode,
            'status' => ($kondisi === 'Baik') ? 'tersedia' : 'tidak-tersedia',
            'jumlah' => $jumlah,
            'limit' => $jumlah,
            'sisa_limit' => ($kondisi === 'Baik') ? $jumlah : 0,
            'jenis_barang_id' => $this->jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);

        return [$bmn, $barang];
    }

    /**
     * 1. Peminjaman baru muncul di riwayat pada halaman E19 yang sama.
     */
    public function test_01_peminjaman_baru_muncul_di_riwayat_pada_halaman_e19(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-NEW-' . time(), 'Kamera New 1');

        $itemData = [
            'uuid' => $barang->uuid,
            'kode_barang' => $barang->kode_barang,
            'name' => $barang->nama_barang,
            'merk' => $barang->merk,
            'serial_number' => $barang->nomor_seri,
        ];

        $nomorSurat = 'ST/NEW/001/' . time();

        $storeResponse = $this->actingAs($this->user1)
            ->withSession(['borrowed_items' => [$itemData]])
            ->postJson('/user/peminjaman/store', [
                'nomor_surat' => $nomorSurat,
                'peruntukan_id' => $this->peruntukan->id,
                'tanggal_penggunaan' => now()->toDateString(),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
            ]);

        $storeResponse->assertStatus(200);

        // Buka halaman E19
        $response = $this->actingAs($this->user1)
            ->get('/user/peminjaman?tab=riwayat');

        $response->assertStatus(200);
        $response->assertSee($nomorSurat);
        $response->assertSee($barang->nama_barang);
        $response->assertSee('Masih Dipinjam');
    }

    /**
     * 2. Riwayat transaksi lama tetap tampil.
     */
    public function test_02_riwayat_transaksi_lama_tetap_tampil(): void
    {
        [$bmn1, $barang1] = $this->createBmnDanBarang('BRG-OLD1-' . time(), 'Lensa Lama');
        [$bmn2, $barang2] = $this->createBmnDanBarang('BRG-OLD2-' . time(), 'Tripod Lama');

        $suratLama = 'ST/HIST/001';
        $suratBaru = 'ST/HIST/002';

        $pmbLama = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-OLD-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-01',
            'nomor_surat' => $suratLama,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->subDays(5)->toDateString(),
            'tanggal_peminjaman' => now()->subDays(5),
            'tanggal_kembali' => now()->subDays(3)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $pmbLama->kode_peminjaman,
            'kode_barang' => $barang1->kode_barang,
        ]);

        $pmbBaru = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-NEW-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-02',
            'nomor_surat' => $suratBaru,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $pmbBaru->kode_peminjaman,
            'kode_barang' => $barang2->kode_barang,
        ]);

        $response = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $response->assertStatus(200);
        $response->assertSee($suratLama);
        $response->assertSee($suratBaru);
    }

    /**
     * 3. Pengguna tidak dapat mengakses transaksi milik pengguna lain tanpa hak.
     */
    public function test_03_pengguna_tidak_dapat_mengakses_transaksi_milik_pengguna_lain(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-PRIV-' . time(), 'Kamera Rahasia');

        $suratUser1 = 'ST/USER1/PRIVATE/' . time();
        $pmbUser1 = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-U1-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-99',
            'nomor_surat' => $suratUser1,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $pmbUser1->kode_peminjaman,
            'kode_barang' => $barang->kode_barang,
        ]);

        // User2 membuka riwayat di E19: tidak boleh melihat transaksi milik User1
        $resUser2 = $this->actingAs($this->user2)->get('/user/peminjaman?tab=riwayat');
        $resUser2->assertStatus(200);
        $resUser2->assertDontSee($suratUser1);
        $resUser2->assertDontSee($pmbUser1->kode_peminjaman);

        // User2 mencoba mendownload PDF milik User1 -> dicegah dengan 403 Forbidden
        $pdfAttempt = $this->actingAs($this->user2)
            ->get('/user/peminjaman/pdf?kode_peminjaman=' . $pmbUser1->kode_peminjaman);

        $pdfAttempt->assertStatus(403);
    }

    /**
     * 4. Status peminjaman aktif ditampilkan dengan benar ('Masih Dipinjam').
     */
    public function test_04_status_peminjaman_aktif_ditampilkan_sebagai_masih_dipinjam(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-ACT-' . time(), 'Mikrofon Wireless');

        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-ACT-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-04',
            'nomor_surat' => 'ST/ACTIVE/004',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $pmb->kode_peminjaman,
            'kode_barang' => $barang->kode_barang,
        ]);

        $this->assertEquals('Masih Dipinjam', $pmb->computed_status);

        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('Masih Dipinjam');
    }

    /**
     * 5. Pengembalian sebagian ditampilkan dengan benar ('Dikembalikan Sebagian').
     */
    public function test_05_status_pengembalian_sebagian_ditampilkan_dengan_benar(): void
    {
        [$bmn1, $barang1] = $this->createBmnDanBarang('BRG-PAR1-' . time(), 'Kamera Parsial');
        [$bmn2, $barang2] = $this->createBmnDanBarang('BRG-PAR2-' . time(), 'Tripod Parsial');

        $kodePmb = 'PMB-PARTIAL-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202410-05',
            'nomor_surat' => 'ST/PARTIAL/005',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang2->kode_barang]);

        // Simpan 1 barang kembali (pengembalian sebagian)
        $kodePg = 'PG-PARTIAL-' . time();
        $pg = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_peminjaman' => $kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Sebagian',
            'peminjam' => $this->user1->nama_lengkap,
        ]);
        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $kodePg,
            'kode_barang' => $barang1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan Sebagian',
        ]);

        $pmb->refresh();
        $this->assertEquals('Dikembalikan Sebagian', $pmb->computed_status);

        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('Dikembalikan Sebagian');
    }

    /**
     * 6. Pengembalian penuh menampilkan status selesai ('Selesai').
     */
    public function test_06_pengembalian_penuh_menampilkan_status_selesai(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-FULL-' . time(), 'Lighting Studio');

        $kodePmb = 'PMB-FULL-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202410-06',
            'nomor_surat' => 'ST/FULL/006',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang->kode_barang]);

        // Pengembalian melalui alur E20
        $sessionKey = 'scanned_pengembalian_' . $this->user1->id . '_' . $kodePmb;
        $returnRes = $this->actingAs($this->user1)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang->kode_barang, 'condition' => 'baik', 'isChecked' => true],
            ]);

        $returnRes->assertStatus(200);

        $pmb->refresh();
        $this->assertEquals('Selesai', $pmb->status);
        $this->assertEquals('Selesai', $pmb->computed_status);

        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('Selesai');
    }

    /**
     * 7. Pengembalian barang Rusak tidak menghilangkan riwayat.
     */
    public function test_07_pengembalian_barang_rusak_tidak_menghilangkan_riwayat(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-DMG-' . time(), 'Kamera Rusak Test');

        $kodePmb = 'PMB-DMG-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202410-07',
            'nomor_surat' => 'ST/DMG/007',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang->kode_barang]);

        $sessionKey = 'scanned_pengembalian_' . $this->user1->id . '_' . $kodePmb;
        $this->actingAs($this->user1)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang->kode_barang, 'condition' => 'rusak', 'isChecked' => true],
            ]);

        // Cek halaman riwayat E19
        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('ST/DMG/007');
        $res->assertSee('Ada Rusak');
    }

    /**
     * 8. Perbaikan dan verifikasi Superadmin tidak merusak riwayat.
     */
    public function test_08_perbaikan_dan_verifikasi_superadmin_tidak_merusak_riwayat(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-REP-' . time(), 'Monitor Perbaikan');

        $kodePmb = 'PMB-REP-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202410-08',
            'nomor_surat' => 'ST/REP/008',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang->kode_barang]);

        $sessionKey = 'scanned_pengembalian_' . $this->user1->id . '_' . $kodePmb;
        $this->actingAs($this->user1)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang->kode_barang, 'condition' => 'rusak', 'isChecked' => true],
            ]);

        // Catat perawatan inventaris
        $perawatan = PerawatanInventaris::create([
            'uuid' => (string) Str::uuid(),
            'barang_id' => $bmn->id,
            'tanggal_perawatan' => now()->toDateString(),
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => 'Penggantian modul',
            'status' => 'diperbaiki',
            'biaya' => 200000,
        ]);

        // Superadmin verifikasi selesai
        $verif = $this->actingAs($this->superadmin)
            ->post('/admin/perawatan/verifikasi/' . $perawatan->id, [
                'status_kelayakan' => 'layak',
            ]);

        $this->assertTrue(in_array($verif->status(), [200, 302]));

        // Pastikan riwayat peminjaman lama milik user1 masih utuh
        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('ST/REP/008');
        $res->assertSee($pmb->kode_peminjaman);
    }

    /**
     * 9. Peminjaman ulang setelah barang diperbaiki tercatat sebagai transaksi baru.
     */
    public function test_09_peminjaman_ulang_setelah_barang_diperbaiki_tercatat_sebagai_transaksi_baru(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-REBORROW-' . time(), 'Drone 4K');

        // Transaksi 1
        $kodePmb1 = 'PMB-TX1-' . time();
        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb1,
            'nomor_peminjaman' => 'PMJ-202410-09A',
            'nomor_surat' => 'ST/FIRST/009',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->subDays(10)->toDateString(),
            'tanggal_peminjaman' => now()->subDays(10),
            'tanggal_kembali' => now()->subDays(8)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Selesai',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb1, 'kode_barang' => $barang->kode_barang]);

        $pg1 = Pengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => 'PG-TX1-' . time(),
            'kode_peminjaman' => $kodePmb1,
            'tanggal_kembali' => now()->subDays(8),
            'status' => 'Lengkap',
            'peminjam' => $this->user1->nama_lengkap,
        ]);
        DetailPengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => $pg1->kode_pengembalian,
            'kode_barang' => $barang->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Kembali',
        ]);

        // Transaksi 2 (peminjaman ulang)
        $kodePmb2 = 'PMB-TX2-' . time();
        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb2,
            'nomor_peminjaman' => 'PMJ-202410-09B',
            'nomor_surat' => 'ST/SECOND/009',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb2, 'kode_barang' => $barang->kode_barang]);

        // Buka E19 riwayat: kedua transaksi harus muncul terpisah
        $res = $this->actingAs($this->user1)->get('/user/peminjaman?tab=riwayat');
        $res->assertStatus(200);
        $res->assertSee('ST/FIRST/009');
        $res->assertSee('ST/SECOND/009');
        $res->assertSee($kodePmb1);
        $res->assertSee($kodePmb2);
    }

    /**
     * 10. Download PDF, Send Email, dan Selesai tetap berfungsi.
     */
    public function test_10_download_pdf_send_email_dan_selesai_tetap_berfungsi(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-BTN-' . time(), 'Audio Recorder');

        $kodePmb = 'PMB-BTN-' . time();
        $pmb = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-202410-10',
            'nomor_surat' => 'ST/BTN/010',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang->kode_barang]);

        // Download PDF via query parameter dari riwayat
        $pdfRes = $this->actingAs($this->user1)
            ->get('/user/peminjaman/pdf?kode_peminjaman=' . $kodePmb);

        $pdfRes->assertStatus(200);
        $this->assertEquals('application/pdf', $pdfRes->headers->get('content-type'));

        // Download PDF via session lama (dari halaman laporan)
        $pdfSessionRes = $this->actingAs($this->user1)
            ->withSession(['kodePeminjaman' => $kodePmb])
            ->get('/user/peminjaman/pdf');

        $pdfSessionRes->assertStatus(200);
        $this->assertEquals('application/pdf', $pdfSessionRes->headers->get('content-type'));

        // Halaman laporan peminjaman memuat tombol Download PDF, Send Email, dan Selesai
        $reportRes = $this->actingAs($this->user1)
            ->withSession(['kodePeminjaman' => $kodePmb])
            ->get('/user/peminjaman/report');

        $reportRes->assertStatus(200);
        $reportRes->assertSee('Download PDF');
        $reportRes->assertSee('Send Email');
        $reportRes->assertSee('Selesai');
    }

    /**
     * 11. Keranjang peminjaman tidak hilang saat pengguna membuka bagian riwayat.
     */
    public function test_11_keranjang_peminjaman_tidak_hilang_saat_pengguna_membuka_riwayat(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-CART-' . time(), 'Item Keranjang Test');

        $cartItem = [
            'uuid' => $barang->uuid,
            'kode_barang' => $barang->kode_barang,
            'name' => $barang->nama_barang,
            'merk' => $barang->merk,
            'serial_number' => $barang->nomor_seri,
        ];

        // User memiliki item di keranjang session lalu membuka tab riwayat
        $res = $this->actingAs($this->user1)
            ->withSession(['borrowed_items' => [$cartItem]])
            ->get('/user/peminjaman?tab=riwayat');

        $res->assertStatus(200);
        // Pastikan keranjang item tetap ter-render di dalam panel formulir
        $res->assertSee($barang->nama_barang);
        $res->assertSee($barang->nomor_seri);
    }

    /**
     * 12. Filter status dan pencarian riwayat berfungsi dengan benar.
     */
    public function test_12_filter_dan_pencarian_riwayat_berfungsi(): void
    {
        [$bmn1, $barang1] = $this->createBmnDanBarang('BRG-F1-' . time(), 'Kamera Alpha');
        [$bmn2, $barang2] = $this->createBmnDanBarang('BRG-F2-' . time(), 'Tripod Beta');

        $surat1 = 'ST/SEARCH/ALPHA';
        $surat2 = 'ST/SEARCH/BETA';

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-FL1-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-12A',
            'nomor_surat' => $surat1,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);

        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => 'PMB-FL2-' . time(),
            'nomor_peminjaman' => 'PMJ-202410-12B',
            'nomor_surat' => $surat2,
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user1->nama_lengkap,
            'status' => 'Proses',
        ]);

        // Cari 'ALPHA'
        $searchRes = $this->actingAs($this->user1)
            ->get('/user/peminjaman?tab=riwayat&search_riwayat=ALPHA');

        $searchRes->assertStatus(200);
        $searchRes->assertSee($surat1);
        $searchRes->assertDontSee($surat2);
    }
}
