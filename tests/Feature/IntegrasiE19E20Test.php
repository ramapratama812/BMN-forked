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
use App\Models\PerawatanInventaris;
use App\Models\LaporanKerusakan;
use App\Models\Peruntukan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class IntegrasiE19E20Test extends TestCase
{
    use DatabaseTransactions;

    protected User $petugasKhusus;
    protected User $technicalDirector;
    protected User $adminUser;
    protected User $teknisiUser;
    protected Peruntukan $peruntukan;
    protected JenisBarang $jenisBarang;

    protected function setUp(): void
    {
        parent::setUp();

        $jabatanPK = Jabatan::firstOrCreate(['jabatan' => 'Petugas Khusus'], ['uuid' => (string) Str::uuid()]);
        $jabatanTD = Jabatan::firstOrCreate(['jabatan' => 'Technical Director (TD)'], ['uuid' => (string) Str::uuid()]);

        $this->petugasKhusus = User::where('nip', '999001')->first() ?? User::factory()->create([
            'role' => 'user',
            'nip' => '999001',
            'nama_lengkap' => 'Petugas Khusus Test',
            'jabatan_id' => $jabatanPK->id,
        ]);

        $this->technicalDirector = User::where('nip', '999002')->first() ?? User::factory()->create([
            'role' => 'user',
            'nip' => '999002',
            'nama_lengkap' => 'TD Test',
            'jabatan_id' => $jabatanTD->id,
        ]);

        $this->adminUser = User::where('role', 'admin')->first() ?? User::factory()->create([
            'role' => 'admin',
            'nip' => '999003',
            'nama_lengkap' => 'Admin Perawatan Test',
        ]);

        $this->teknisiUser = User::where('role', 'tim_perbaikan')->first() ?? User::factory()->create([
            'role' => 'tim_perbaikan',
            'nip' => '999004',
            'nama_lengkap' => 'Teknisi Test',
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
     * Pengujian A — Peminjaman dan pengembalian normal
     */
    public function test_skenario_a_peminjaman_dan_pengembalian_normal(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-A-' . time(), 'Kamera Utama A', 1, 'Baik');

        // 1. Pilih barang yang tersedia melalui E19 (searchBarang)
        $search = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);

        $search->assertStatus(200);
        $search->assertJsonPath('data.0.is_available', true);
        $this->assertEquals(1, $search->json('data.0.sisa_limit'));

        // Tambah ke daftar peminjaman (addItem)
        $add = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $add->assertStatus(200);
        $itemData = $add->json('item');

        // 2. Simpan peminjaman (store)
        $storePeminjaman = $this->actingAs($this->petugasKhusus)
            ->withSession(['borrowed_items' => [$itemData]])
            ->postJson('/user/peminjaman/store', [
                'nomor_surat' => 'ST/TEST/001',
                'peruntukan_id' => $this->peruntukan->id,
                'tanggal_penggunaan' => now()->toDateString(),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
            ]);

        $storePeminjaman->assertStatus(200);
        $peminjaman = Peminjaman::where('nomor_surat', 'ST/TEST/001')->first();
        $this->assertNotNull($peminjaman);
        $kodePmb = $peminjaman->kode_peminjaman;

        // Pastikan barang terupdate menjadi tidak-tersedia saat dipinjam
        $barang->refresh();
        $this->assertEquals(0, $barang->sisa_limit);
        $this->assertEquals('tidak-tersedia', $barang->status);

        // 3. Buka E20 dan gunakan kode yang sama
        $checkE20 = $this->actingAs($this->petugasKhusus)
            ->postJson('/user/pengembalian/check', ['code' => $kodePmb]);
        $checkE20->assertStatus(200);

        // 4. Pindai serta validasi barang yang dikembalikan
        $scan = $this->actingAs($this->petugasKhusus)
            ->withSession(['kodePeminjaman' => $kodePmb])
            ->postJson('/user/pengembalian/validation', [
                'itemCode' => $barang->kode_barang,
            ]);
        $scan->assertStatus(200);

        // 5. Simpan pengembalian di E20
        $sessionKey = 'scanned_pengembalian_' . $this->petugasKhusus->id . '_' . $kodePmb;
        $storeReturn = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_code' => $barang->kode_barang,
                    'condition' => 'baik',
                    'isChecked' => true,
                ],
            ]);

        $storeReturn->assertStatus(200);

        // 6. Buka E19 dan cari barang yang sama
        $searchAfterReturn = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);

        $searchAfterReturn->assertStatus(200);

        // 7. Pastikan barang bisa dipilih kembali apabila masih memenuhi syarat
        $searchAfterReturn->assertJsonPath('data.0.is_available', true);
        $this->assertEquals(1, $searchAfterReturn->json('data.0.sisa_limit'));
        $this->assertEquals('tersedia', $searchAfterReturn->json('data.0.status'));

        $barang->refresh();
        $this->assertEquals(1, $barang->sisa_limit);
        $this->assertEquals('tersedia', $barang->status);

        // Uji tambah barang kembali di E19 berhasil
        $addAgain = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $addAgain->assertStatus(200);
    }

    /**
     * Pengujian B — Transaksi masih aktif
     */
    public function test_skenario_b_transaksi_masih_aktif_barang_tidak_tersedia(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-B-' . time(), 'Lensa Zoom B', 1, 'Baik');

        // Pinjam barang
        $add = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $add->assertStatus(200);
        $itemData = $add->json('item');

        $store = $this->actingAs($this->petugasKhusus)
            ->withSession(['borrowed_items' => [$itemData]])
            ->postJson('/user/peminjaman/store', [
                'nomor_surat' => 'ST/TEST/002',
                'peruntukan_id' => $this->peruntukan->id,
                'tanggal_penggunaan' => now()->toDateString(),
                'tanggal_kembali' => now()->addDays(2)->toDateString(),
            ]);
        $store->assertStatus(200);

        // Transaksi peminjaman masih aktif (belum dikembalikan)
        // Cari di E19: barang tidak boleh dianggap tersedia
        $search = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);

        $search->assertStatus(200);
        $search->assertJsonPath('data.0.is_available', false);
        $this->assertEquals(0, $search->json('data.0.sisa_limit'));
        $this->assertEquals('tidak-tersedia', $search->json('data.0.status'));

        // Coba pinjam lagi -> harus ditolak
        $addAttempt = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $addAttempt->assertStatus(400);
        $addAttempt->assertJsonPath('success', false);
    }

    /**
     * Pengujian C — Pengembalian sebagian / barang rusak & baik
     */
    public function test_skenario_c_pengembalian_sebagian_kondisi_rusak_dan_baik(): void
    {
        [$bmn1, $barang1] = $this->createBmnDanBarang('BRG-TEST-C1-' . time(), 'Kamera C1', 1, 'Baik');
        [$bmn2, $barang2] = $this->createBmnDanBarang('BRG-TEST-C2-' . time(), 'Tripod C2', 1, 'Baik');

        $kodePmb = 'PMB-TEST-C-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-TEST-C',
            'nomor_surat' => 'ST/TEST/003',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang1->kode_barang]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang2->kode_barang]);
        $barang1->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);
        $barang2->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        // Kembalikan barang 1 dalam kondisi 'baik', barang 2 dalam kondisi 'rusak'
        $sessionKey = 'scanned_pengembalian_' . $this->petugasKhusus->id . '_' . $kodePmb;
        $returnResponse = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang1->kode_barang, $barang2->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang1->kode_barang, 'condition' => 'baik', 'isChecked' => true],
                ['item_code' => $barang2->kode_barang, 'condition' => 'rusak', 'isChecked' => true],
            ]);

        $returnResponse->assertStatus(200);

        // Barang 1 (baik) harus tersedia kembali
        $barang1->refresh();
        $this->assertEquals('tersedia', $barang1->status);
        $this->assertEquals(1, $barang1->sisa_limit);

        // Barang 2 (rusak) harus tetap TIDAK tersedia
        $barang2->refresh();
        $this->assertEquals('tidak-tersedia', $barang2->status);
        $this->assertEquals(0, $barang2->sisa_limit);

        $bmn2->refresh();
        $this->assertEquals('Rusak', $bmn2->kondisi);

        // Cek pencarian E19
        $searchB1 = $this->actingAs($this->petugasKhusus)->getJson('/user/peminjaman/search-barang?q=' . $barang1->kode_barang);
        $searchB1->assertJsonPath('data.0.is_available', true);

        $searchB2 = $this->actingAs($this->petugasKhusus)->getJson('/user/peminjaman/search-barang?q=' . $barang2->kode_barang);
        $searchB2->assertJsonPath('data.0.is_available', false);
    }

    /**
     * Pengujian D — Pengembalian ganda
     */
    public function test_skenario_d_pengembalian_ganda_tidak_menambah_stok_dua_kali(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-D-' . time(), 'Monitor D', 1, 'Baik');

        $kodePmb = 'PMB-TEST-D-' . time();
        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-TEST-D',
            'nomor_surat' => 'ST/TEST/004',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create(['uuid' => Str::uuid(), 'kode_peminjaman' => $kodePmb, 'kode_barang' => $barang->kode_barang]);
        $barang->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        $sessionKey = 'scanned_pengembalian_' . $this->petugasKhusus->id . '_' . $kodePmb;
        $firstReturn = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang->kode_barang, 'condition' => 'baik', 'isChecked' => true],
            ]);
        $firstReturn->assertStatus(200);

        $barang->refresh();
        $this->assertEquals(1, $barang->sisa_limit);

        // Percobaan pengembalian kedua pada transaksi yang sama harus ditolak
        $secondReturn = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePmb,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                ['item_code' => $barang->kode_barang, 'condition' => 'baik', 'isChecked' => true],
            ]);
        $secondReturn->assertStatus(400);

        // Stok tidak bertambah melebihi limit
        $barang->refresh();
        $this->assertEquals(1, $barang->sisa_limit);
    }

    /**
     * Pengujian E — Kondisi barang & perawatan
     */
    public function test_skenario_e_barang_dalam_perawatan_tidak_bisa_dipinjam(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-E-' . time(), 'Audio Recorder E', 1, 'Baik');

        // Daftarkan ke perawatan aktif
        PerawatanInventaris::create([
            'barang_id' => $bmn->id,
            'jenis_perawatan' => 'perbaikan',
            'deskripsi_kerusakan' => 'Port audio kendur',
            'status' => 'proses',
        ]);

        $search = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);

        $search->assertStatus(200);
        $search->assertJsonPath('data.0.is_available', false);

        $add = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $add->assertStatus(400);
        $this->assertStringContainsString('sedang dalam perawatan', $add->json('message'));
    }

    /**
     * Pengujian F — Integrasi dan akses pengguna (Technical Director & Petugas Khusus)
     */
    public function test_skenario_f_akses_petugas_khusus_dan_technical_director(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-F-' . time(), 'Switcher ATEM F', 1, 'Baik');

        // 1. Technical Director dapat mencari dan menambah barang di E19
        $searchTD = $this->actingAs($this->technicalDirector)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);
        $searchTD->assertStatus(200);
        $searchTD->assertJsonPath('data.0.is_available', true);

        $addTD = $this->actingAs($this->technicalDirector)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $addTD->assertStatus(200);

        // 2. Petugas Khusus juga dapat mencari dan menambah barang di E19
        $searchPK = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);
        $searchPK->assertStatus(200);
        $searchPK->assertJsonPath('data.0.is_available', true);
    }

    /**
     * Pengujian Fitur Keterangan Alasan Barang Tidak Bisa Dipinjam pada E19
     */
    public function test_keterangan_alasan_barang_tidak_dapat_dipinjam_pada_e19(): void
    {
        // 1. Kondisi F: Barang Layak dan Stok Tersedia -> unavailable_reason null
        [$bmnNormal, $brgNormal] = $this->createBmnDanBarang('BRG-RSN-F-' . time(), 'Kamera Normal', 1, 'Baik');
        $resNormal = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnNormal->kode_barang);
        $resNormal->assertStatus(200);
        $resNormal->assertJsonPath('data.0.is_available', true);
        $this->assertNull($resNormal->json('data.0.unavailable_reason'));
        $this->assertNull($resNormal->json('data.0.reason_type'));

        // 2. Kondisi A: Seluruh Stok Sedang Dipinjam -> reason_type 'all_borrowed'
        [$bmnDipinjam, $brgDipinjam] = $this->createBmnDanBarang('BRG-RSN-A-' . time(), 'Mic Wireless Dipinjam', 1, 'Baik');
        $kodePmb = 'PMB-RSN-A-' . time();
        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'nomor_peminjaman' => 'PMJ-RSN-A',
            'nomor_surat' => 'ST/RSN/001',
            'peruntukan_id' => $this->peruntukan->id,
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'status' => 'Proses',
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmb,
            'kode_barang' => $brgDipinjam->kode_barang,
        ]);
        $brgDipinjam->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        $resDipinjam = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnDipinjam->kode_barang);
        $resDipinjam->assertStatus(200);
        $resDipinjam->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('all_borrowed', $resDipinjam->json('data.0.reason_type'));
        $this->assertStringContainsString('seluruh barang sedang dipinjam', $resDipinjam->json('data.0.unavailable_reason'));

        // addItem juga menolak dengan pesan yang sesuai
        $addDipinjam = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmnDipinjam->uuid,
        ]);
        $addDipinjam->assertStatus(400);
        $this->assertStringContainsString('seluruh barang sedang dipinjam', $addDipinjam->json('message'));

        // 3. Kondisi B: Stok Memang 0 (Bukan karena dipinjam) -> reason_type 'out_of_stock'
        [$bmnHabis, $brgHabis] = $this->createBmnDanBarang('BRG-RSN-B-' . time(), 'Lampu Studio Habis', 0, 'Baik');
        $brgHabis->update(['limit' => 0, 'sisa_limit' => 0, 'status' => 'tidak-tersedia']);
        $bmnHabis->update(['jumlah' => 0]);

        $resHabis = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnHabis->kode_barang);
        $resHabis->assertStatus(200);
        $resHabis->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('out_of_stock', $resHabis->json('data.0.reason_type'));
        $this->assertStringContainsString('Tidak ada stok yang tersedia', $resHabis->json('data.0.unavailable_reason'));

        // 4. Kondisi C: Barang Rusak / Tidak Layak -> reason_type 'damaged'
        [$bmnRusak, $brgRusak] = $this->createBmnDanBarang('BRG-RSN-C-' . time(), 'Kamera Rusak Fisik', 1, 'Rusak');
        $resRusak = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnRusak->kode_barang);
        $resRusak->assertStatus(200);
        $resRusak->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('damaged', $resRusak->json('data.0.reason_type'));
        $this->assertStringContainsString('kondisinya tidak layak digunakan', $resRusak->json('data.0.unavailable_reason'));

        // 5. Kondisi C (Perawatan): Sedang dalam Perawatan -> reason_type 'maintenance'
        [$bmnRawat, $brgRawat] = $this->createBmnDanBarang('BRG-RSN-E-' . time(), 'Kamera Servis', 1, 'Baik');
        PerawatanInventaris::create([
            'barang_id' => $bmnRawat->id,
            'jenis_perawatan' => 'perbaikan',
            'deskripsi_kerusakan' => 'Sensor kotor',
            'status' => 'proses',
        ]);
        $resRawat = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnRawat->kode_barang);
        $resRawat->assertStatus(200);
        $resRawat->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('maintenance', $resRawat->json('data.0.reason_type'));
        $this->assertStringContainsString('sedang dalam proses perawatan', $resRawat->json('data.0.unavailable_reason'));
    }

    /**
     * Skenario 1, 2, 9: Pengembalian Rusak membuat satu LaporanKerusakan, cegah duplikat, dan riwayat E20 utuh.
     */
    public function test_pengembalian_rusak_membuat_laporan_kerusakan_dan_mencegah_duplikasi(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-TEST-RSK-' . time(), 'Kamera Rusak E20', 1, 'Baik');

        $kodePeminjaman = 'PMB-TEST-RSK-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePeminjaman,
            'nomor_peminjaman' => 'PMJ-' . $kodePeminjaman,
            'nomor_surat' => 'SURAT-' . $kodePeminjaman,
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'status' => 'Proses',
            'peruntukan_id' => $this->peruntukan->id,
            'user_id' => $this->petugasKhusus->id,
        ]);

        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePeminjaman,
            'kode_barang' => $barang->kode_barang,
        ]);
        $barang->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        $sessionKey = 'scanned_pengembalian_' . $this->petugasKhusus->id . '_' . $kodePeminjaman;

        // Simpan pengembalian dengan kondisi rusak
        $response = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePeminjaman,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_uuid' => $barang->uuid,
                    'item_code' => $barang->kode_barang,
                    'condition' => 'rusak',
                    'isChecked' => true,
                ]
            ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        // 1. Kondisi BMN menjadi Rusak & Barang menjadi tidak-tersedia
        $this->assertEquals('Rusak', $bmn->fresh()->kondisi);
        $this->assertEquals('tidak-tersedia', $barang->fresh()->status);
        $this->assertEquals(0, $barang->fresh()->sisa_limit);

        // 2. Terbentuk tepat satu laporan kerusakan dengan status 'disetujui'
        $laporanList = LaporanKerusakan::where('barang_id', $bmn->id)->get();
        $this->assertCount(1, $laporanList);
        $laporan = $laporanList->first();
        $this->assertEquals('disetujui', $laporan->status);
        $this->assertEquals('Kerusakan Pasca Penggunaan', $laporan->jenis_kerusakan);

        // 3. Pengiriman ulang pengembalian yang sama ditolak dan tidak menduplikasi laporan
        $resReplay = $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePeminjaman,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_uuid' => $barang->uuid,
                    'item_code' => $barang->kode_barang,
                    'condition' => 'rusak',
                    'isChecked' => true,
                ]
            ]);
        $resReplay->assertStatus(400);
        $this->assertCount(1, LaporanKerusakan::where('barang_id', $bmn->id)->get());

        // 4. Riwayat E20 (Pengembalian & DetailPengembalian) tetap ada
        $this->assertDatabaseHas('pengembalian', ['kode_peminjaman' => $kodePeminjaman]);
        $this->assertDatabaseHas('detail_pengembalian', [
            'kode_barang' => $barang->kode_barang,
            'status' => 'rusak',
        ]);
    }

    /**
     * Skenario 3 & 4: Barang rusak dan barang sedang perawatan tidak dapat dipinjam di E19.
     */
    public function test_barang_rusak_dan_sedang_perawatan_tidak_dapat_dipinjam_di_e19(): void
    {
        // 3. Barang Rusak
        [$bmnRusak, $barangRusak] = $this->createBmnDanBarang('BRG-RSK-E19-' . time(), 'Mic Rusak', 1, 'Rusak');
        $searchRusak = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnRusak->kode_barang);
        $searchRusak->assertStatus(200);
        $searchRusak->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('damaged', $searchRusak->json('data.0.reason_type'));

        $addRusak = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmnRusak->uuid,
        ]);
        $addRusak->assertStatus(400);

        // 4. Barang yang masih memiliki LaporanKerusakan aktif (sedang dalam antrean perbaikan)
        [$bmnRawat, $barangRawat] = $this->createBmnDanBarang('BRG-RWT-E19-' . time(), 'Lensa Dalam Perawatan', 1, 'Baik');
        LaporanKerusakan::create([
            'barang_id' => $bmnRawat->id,
            'user_id' => $this->petugasKhusus->id,
            'jenis_kerusakan' => 'Maintenance',
            'deskripsi' => 'Fokus blur',
            'status' => 'disetujui',
        ]);

        $searchRawat = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmnRawat->kode_barang);
        $searchRawat->assertStatus(200);
        $searchRawat->assertJsonPath('data.0.is_available', false);
        $this->assertEquals('maintenance', $searchRawat->json('data.0.reason_type'));

        $addRawat = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmnRawat->uuid,
        ]);
        $addRawat->assertStatus(400);
        $this->assertStringContainsString('sedang dalam proses perawatan', $addRawat->json('message'));
    }

    /**
     * Skenario 5 & 8: Barang berhasil diperbaiki dan diverifikasi layak dapat dipinjam tanpa stok ganda.
     */
    public function test_barang_berhasil_diperbaiki_dan_diverifikasi_layak_dapat_dipinjam_tanpa_stok_ganda(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-FIX-E19-' . time(), 'Switcher Diperbaiki', 1, 'Rusak');
        $barang->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        // Simulasikan PerawatanInventaris dari hasil kerja teknisi
        $perawatan = PerawatanInventaris::create([
            'uuid' => (string) Str::uuid(),
            'barang_id' => $bmn->id,
            'user_id' => $this->teknisiUser->id,
            'tanggal_perawatan' => now()->toDateString(),
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => 'Penggantian IC power berhasil',
            'biaya' => 250000,
            'status' => 'diperbaiki',
        ]);

        // Admin melakukan verifikasi selesai
        $resVerif = $this->actingAs($this->adminUser)
            ->post('/admin/perawatan/verifikasi/' . $perawatan->id);
        $resVerif->assertRedirect(route('perawatan_inventaris.index'));

        // Assert kondisi pulih
        $this->assertEquals('Baik', $bmn->fresh()->kondisi);
        $this->assertEquals(100, $bmn->fresh()->persentase_kondisi);
        $this->assertEquals('tersedia', $barang->fresh()->status);
        $this->assertEquals(1, $barang->fresh()->sisa_limit);
        $this->assertEquals('selesai', $perawatan->fresh()->status);

        // Verifikasi ulang (idempotensi) tidak menggandakan stok
        $resVerif2 = $this->actingAs($this->adminUser)
            ->post('/admin/perawatan/verifikasi/' . $perawatan->id);
        $resVerif2->assertRedirect(route('perawatan_inventaris.index'));
        $this->assertEquals(1, $barang->fresh()->sisa_limit);

        // Barang kini dapat dicari dan ditambahkan di E19
        $searchRes = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);
        $searchRes->assertStatus(200);
        $searchRes->assertJsonPath('data.0.is_available', true);

        $addRes = $this->actingAs($this->petugasKhusus)->postJson('/user/peminjaman/add-item', [
            'uuid' => $bmn->uuid,
        ]);
        $addRes->assertStatus(200);
        $addRes->assertJson(['success' => true]);
    }

    /**
     * Skenario 6: Barang yang tidak dapat diperbaiki tetap tidak dapat dipinjam.
     */
    public function test_barang_tidak_dapat_diperbaiki_tetap_tidak_dapat_dipinjam(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-UNFIX-' . time(), 'Tripod Patah Total', 1, 'Rusak');
        $barang->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        $perawatan = PerawatanInventaris::create([
            'uuid' => (string) Str::uuid(),
            'barang_id' => $bmn->id,
            'user_id' => $this->teknisiUser->id,
            'tanggal_perawatan' => now()->toDateString(),
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => 'Engsel patah tidak ada suku cadang',
            'biaya' => 0,
            'status' => 'tidak_dapat_diperbaiki',
        ]);

        // Admin memverifikasi
        $res = $this->actingAs($this->adminUser)
            ->post('/admin/perawatan/verifikasi/' . $perawatan->id);
        $res->assertRedirect(route('perawatan_inventaris.index'));

        // Kondisi barang tetap Rusak dan tidak-tersedia
        $this->assertEquals('Rusak', $bmn->fresh()->kondisi);
        $this->assertEquals('tidak-tersedia', $barang->fresh()->status);
        $this->assertEquals(0, $barang->fresh()->sisa_limit);

        // Di E19 tetap tidak dapat dipinjam
        $searchRes = $this->actingAs($this->petugasKhusus)
            ->getJson('/user/peminjaman/search-barang?q=' . $bmn->kode_barang);
        $searchRes->assertStatus(200);
        $searchRes->assertJsonPath('data.0.is_available', false);
    }

    /**
     * Skenario 7: Barang lain yang masih dipinjam tidak ikut menjadi tersedia saat barang A selesai dirawat.
     */
    public function test_barang_lain_yang_masih_dipinjam_tidak_ikut_menjadi_tersedia(): void
    {
        [$bmnA, $barangA] = $this->createBmnDanBarang('BRG-ISO-A-' . time(), 'Barang Selesai Rawat', 1, 'Rusak');
        [$bmnB, $barangB] = $this->createBmnDanBarang('BRG-ISO-B-' . time(), 'Barang Masih Dipinjam', 1, 'Baik');

        // Barang B masih dipinjam aktif di peminjaman status 'Proses'
        $kodePmbAktif = 'PMB-AKTIF-' . time();
        Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbAktif,
            'nomor_peminjaman' => 'PMJ-' . $kodePmbAktif,
            'nomor_surat' => 'SURAT-' . $kodePmbAktif,
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(3)->toDateString(),
            'status' => 'Proses',
            'peruntukan_id' => $this->peruntukan->id,
            'user_id' => $this->petugasKhusus->id,
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePmbAktif,
            'kode_barang' => $barangB->kode_barang,
        ]);
        $barangB->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        // Perawatan barang A
        $perawatanA = PerawatanInventaris::create([
            'uuid' => (string) Str::uuid(),
            'barang_id' => $bmnA->id,
            'user_id' => $this->teknisiUser->id,
            'tanggal_perawatan' => now()->toDateString(),
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => 'Perbaikan selesai',
            'status' => 'diperbaiki',
        ]);

        $this->actingAs($this->adminUser)->post('/admin/perawatan/verifikasi/' . $perawatanA->id);

        // Barang A pulih
        $this->assertEquals('Baik', $bmnA->fresh()->kondisi);
        $this->assertEquals('tersedia', $barangA->fresh()->status);
        $this->assertEquals(1, $barangA->fresh()->sisa_limit);

        // Barang B TETAP tidak-tersedia karena peminjaman aktifnya belum selesai
        $this->assertEquals('tidak-tersedia', $barangB->fresh()->status);
        $this->assertEquals(0, $barangB->fresh()->sisa_limit);
    }

    /**
     * Skenario D: Penjelasan kerusakan dapat disimpan dan tersinkron ke laporan kerusakan.
     */
    public function test_penjelasan_kerusakan_dapat_disimpan_dan_tersinkron_ke_laporan(): void
    {
        [$bmn, $barang] = $this->createBmnDanBarang('BRG-DESC-' . time(), 'Mic Wireless Rusak', 1, 'Baik');

        $kodePeminjaman = 'PMB-DESC-' . time();
        $peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePeminjaman,
            'nomor_peminjaman' => 'PMJ-' . $kodePeminjaman,
            'nomor_surat' => 'SURAT-' . $kodePeminjaman,
            'peminjam' => $this->petugasKhusus->nama_lengkap,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(1)->toDateString(),
            'status' => 'Proses',
            'peruntukan_id' => $this->peruntukan->id,
            'user_id' => $this->petugasKhusus->id,
        ]);
        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $kodePeminjaman,
            'kode_barang' => $barang->kode_barang,
        ]);
        $barang->update(['status' => 'tidak-tersedia', 'sisa_limit' => 0]);

        $sessionKey = 'scanned_pengembalian_' . $this->petugasKhusus->id . '_' . $kodePeminjaman;

        // Return as rusak
        $this->actingAs($this->petugasKhusus)
            ->withSession([
                'kodePeminjaman' => $kodePeminjaman,
                $sessionKey => [$barang->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_uuid' => $barang->uuid,
                    'item_code' => $barang->kode_barang,
                    'condition' => 'rusak',
                    'isChecked' => true,
                ]
            ]);

        $detailPengembalian = DetailPengembalian::where('kode_barang', $barang->kode_barang)->firstOrFail();
        $laporan = LaporanKerusakan::where('barang_id', $bmn->id)->firstOrFail();

        // Kirim update_desc
        $resDesc = $this->actingAs($this->petugasKhusus)->postJson('/user/pengembalian/update_desc', [
            'barang' => [
                [
                    'uuid' => $detailPengembalian->uuid,
                    'description' => 'Kabel antena putus dan modul transmitter mati total',
                ]
            ]
        ]);

        $resDesc->assertStatus(200);
        $resDesc->assertJson(['message' => 'Deskripsi barang berhasil diperbarui']);

        $this->assertEquals('Kabel antena putus dan modul transmitter mati total', $detailPengembalian->fresh()->deskripsi);
        $this->assertStringContainsString('Kabel antena putus', $laporan->fresh()->deskripsi);
    }
}
