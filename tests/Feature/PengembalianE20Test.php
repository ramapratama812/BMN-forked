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

class PengembalianE20Test extends TestCase
{
    use DatabaseTransactions;

    protected User $user;
    protected Peminjaman $peminjaman;
    protected Barang $barang1;
    protected Barang $barang2;
    protected string $kodePmb;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role', 'user')->first() ?? User::factory()->create(['role' => 'user']);

        $peruntukan = Peruntukan::first() ?? Peruntukan::create([
            'uuid' => (string) Str::uuid(),
            'peruntukan' => 'Operasional Studio',
        ]);

        $jenisBarang = JenisBarang::first() ?? JenisBarang::create([
            'uuid' => (string) Str::uuid(),
            'jenis_barang' => 'Elektronik',
        ]);

        $this->barang1 = Barang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => 'BRG-TEST-E20-001',
            'nama_barang' => 'Camera Sony A7',
            'merk' => 'Sony',
            'nomor_seri' => 'SN-001',
            'status' => 'tidak-tersedia',
            'jumlah' => 1,
            'limit' => 10,
            'sisa_limit' => 5,
            'jenis_barang_id' => $jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);

        $this->barang2 = Barang::create([
            'uuid' => (string) Str::uuid(),
            'kode_barang' => 'BRG-TEST-E20-002',
            'nama_barang' => 'Tripod Manfrotto',
            'merk' => 'Manfrotto',
            'nomor_seri' => 'SN-002',
            'status' => 'tidak-tersedia',
            'jumlah' => 1,
            'limit' => 10,
            'sisa_limit' => 5,
            'jenis_barang_id' => $jenisBarang->id,
            'asal_pengadaan' => 'Pengadaan',
            'studio' => 'studio1',
        ]);

        $this->kodePmb = 'PMB-TEST-' . time();

        $this->peminjaman = Peminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $this->kodePmb,
            'nomor_peminjaman' => 'NP-' . time(),
            'nomor_surat' => 'ST-TEST-001',
            'peruntukan_id' => $peruntukan->id,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_penggunaan' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(2)->toDateString(),
            'peminjam' => $this->user->nama_lengkap ?? 'User Test',
            'status' => 'Proses',
        ]);

        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $this->kodePmb,
            'kode_barang' => $this->barang1->kode_barang,
        ]);

        DetailPeminjaman::create([
            'uuid' => (string) Str::uuid(),
            'kode_peminjaman' => $this->kodePmb,
            'kode_barang' => $this->barang2->kode_barang,
        ]);
    }

    public function test_alur_lengkap_pengembalian_dan_pencegahan_pmb_sama(): void
    {
        // 1. Periksa kode PMB aktif
        $checkResponse = $this->actingAs($this->user)->postJson('/user/pengembalian/check', [
            'code' => $this->kodePmb,
        ]);

        $checkResponse->assertStatus(200);
        $checkResponse->assertJson([
            'success' => true,
            'message' => 'Silakan lakukan pengembalian.',
        ]);

        // 2. Buka halaman pengembalian barang
        $indexResponse = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->get('/user/pengembalian');

        $indexResponse->assertStatus(200);
        $indexResponse->assertSee($this->barang1->nama_barang);
        $indexResponse->assertSee($this->barang2->nama_barang);

        // 3. Validasi QR barang: barang di luar transaksi harus ditolak
        $invalidScan = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->postJson('/user/pengembalian/validation', [
                'itemCode' => 'BRG-ASING-999',
            ]);

        $invalidScan->assertStatus(404);
        $invalidScan->assertJson([
            'success' => false,
            'message' => 'QR barang tidak terdaftar dalam peminjaman aktif ini.',
        ]);

        // 4. Validasi QR barang: barang pertama berhasil divalidasi
        $validScan1 = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->postJson('/user/pengembalian/validation', [
                'itemCode' => $this->barang1->kode_barang,
            ]);

        $validScan1->assertStatus(200);
        $validScan1->assertJson([
            'success' => true,
        ]);

        // 5. Validasi QR barang: pemindaian barang duplikat harus ditolak
        $sessionKey = 'scanned_pengembalian_' . $this->user->id . '_' . $this->kodePmb;
        $duplicateScan = $this->actingAs($this->user)
            ->withSession([
                'kodePeminjaman' => $this->kodePmb,
                $sessionKey => [$this->barang1->kode_barang],
            ])
            ->postJson('/user/pengembalian/validation', [
                'itemCode' => $this->barang1->kode_barang,
            ]);

        $duplicateScan->assertStatus(409);
        $duplicateScan->assertJson([
            'success' => false,
            'already_scanned' => true,
        ]);

        // 6. Validasi QR barang kedua
        $validScan2 = $this->actingAs($this->user)
            ->withSession([
                'kodePeminjaman' => $this->kodePmb,
                $sessionKey => [$this->barang1->kode_barang],
            ])
            ->postJson('/user/pengembalian/validation', [
                'itemCode' => $this->barang2->kode_barang,
            ]);

        $validScan2->assertStatus(200);
        $validScan2->assertJson([
            'success' => true,
        ]);

        // 7. Simpan pengembalian ditolak jika belum seluruh barang divalidasi
        $incompleteStore = $this->actingAs($this->user)
            ->withSession([
                'kodePeminjaman' => $this->kodePmb,
                $sessionKey => [$this->barang1->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_code' => $this->barang1->kode_barang,
                    'condition' => 'baik',
                    'isChecked' => true,
                ],
            ]);

        $incompleteStore->assertStatus(422);

        // 8. Simpan pengembalian berhasil setelah seluruh barang divalidasi
        $storeResponse = $this->actingAs($this->user)
            ->withSession([
                'kodePeminjaman' => $this->kodePmb,
                $sessionKey => [$this->barang1->kode_barang, $this->barang2->kode_barang],
            ])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_code' => $this->barang1->kode_barang,
                    'condition' => 'baik',
                    'isChecked' => true,
                ],
                [
                    'item_code' => $this->barang2->kode_barang,
                    'condition' => 'rusak',
                    'isChecked' => true,
                ],
            ]);

        $storeResponse->assertStatus(200);
        $storeResponse->assertJson([
            'status' => 'success',
        ]);

        // Pastikan status database berubah
        $this->peminjaman->refresh();
        $this->assertEquals('Selesai', $this->peminjaman->status);

        $pengembalian = Pengembalian::where('kode_peminjaman', $this->kodePmb)->first();
        $this->assertNotNull($pengembalian);
        $this->assertEquals('Lengkap', $pengembalian->status);

        $this->barang1->refresh();
        $this->assertEquals('tersedia', $this->barang1->status);
        $this->assertEquals(10, $this->barang1->sisa_limit);

        $this->barang2->refresh();
        $this->assertEquals('tidak-tersedia', $this->barang2->status);

        // 9. Bukti pengembalian (report) dapat diakses
        $reportResponse = $this->actingAs($this->user)
            ->withSession(['kodePengembalian' => $pengembalian->kode_pengembalian])
            ->get('/user/pengembalian/report');

        $reportResponse->assertStatus(200);
        $reportResponse->assertSee($pengembalian->kode_pengembalian);

        // 10. Tombol Selesai (kembali ke user.option) membersihkan session
        $optionsResponse = $this->actingAs($this->user)
            ->withSession([
                'kodePeminjaman' => $this->kodePmb,
                'kodePengembalian' => $pengembalian->kode_pengembalian,
            ])
            ->get('/user/options');

        $optionsResponse->assertStatus(200);
        $optionsResponse->assertSessionMissing('kodePeminjaman');
        $optionsResponse->assertSessionMissing('kodePengembalian');

        // 11. Masukkan kembali kode PMB yang sama -> Harus menampilkan "Pengembalian barang sudah selesai" dan menyediakan URL bukti
        $recheckResponse = $this->actingAs($this->user)->postJson('/user/pengembalian/check', [
            'code' => $this->kodePmb,
        ]);

        $recheckResponse->assertStatus(400);
        $recheckResponse->assertJson([
            'success' => false,
            'message' => 'Pengembalian barang sudah selesai',
            'already_returned' => true,
        ]);
        $recheckData = $recheckResponse->json('data');
        $this->assertNotEmpty($recheckData['report_url']);
        $this->assertNotEmpty($recheckData['pdf_url']);
        $this->assertEquals($pengembalian->kode_pengembalian, $recheckData['kode_pengembalian']);

        // 12. Tidak ada transaksi pengembalian ganda
        $this->assertEquals(1, Pengembalian::where('kode_peminjaman', $this->kodePmb)->count());

        // 13. Panggilan store ulang ditolak
        $secondStore = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->postJson('/user/pengembalian/store', [
                [
                    'item_code' => $this->barang1->kode_barang,
                    'condition' => 'baik',
                    'isChecked' => true,
                ],
                [
                    'item_code' => $this->barang2->kode_barang,
                    'condition' => 'baik',
                    'isChecked' => true,
                ],
            ]);

        $secondStore->assertStatus(400);
        $secondStore->assertJson([
            'status' => 'error',
            'message' => 'Pengembalian barang sudah selesai',
        ]);
    }

    public function test_lihat_ulang_bukti_pengembalian_melalui_query_param(): void
    {
        // Siapkan transaksi pengembalian yang sudah selesai di database
        $this->peminjaman->update(['status' => 'Selesai']);
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => 'PG-TEST-' . time(),
            'kode_peminjaman' => $this->kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap ?? 'User Test',
        ]);

        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $pengembalian->kode_pengembalian,
            'kode_barang' => $this->barang1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $pengembalian->kode_pengembalian,
            'kode_barang' => $this->barang2->kode_barang,
            'status' => 'rusak',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        $initialPengembalianCount = Pengembalian::count();
        $initialDetailCount = DetailPengembalian::count();

        // 1. Akses halaman laporan (HTML) menggunakan kode_peminjaman
        $responsePmb = $this->actingAs($this->user)
            ->get('/user/pengembalian/report?kode_peminjaman=' . $this->kodePmb);

        $responsePmb->assertStatus(200);
        $responsePmb->assertSee($pengembalian->kode_pengembalian);
        $responsePmb->assertSee($this->barang1->kode_barang);
        $responsePmb->assertSee($this->barang1->nama_barang);
        $responsePmb->assertSee($this->barang2->kode_barang);
        $responsePmb->assertSee($this->barang2->nama_barang);
        // Seluruh barang kembali (tidak ada barang hilang), tabel oranye/kuning tidak muncul
        $responsePmb->assertDontSee('Barang belum dikembalikan');
        $responsePmb->assertDontSee('Tidak ada barang yang belum dikembalikan (Nihil)');

        // 2. Akses halaman laporan (HTML) menggunakan kode_pengembalian
        $responsePg = $this->actingAs($this->user)
            ->get('/user/pengembalian/report?kode_pengembalian=' . $pengembalian->kode_pengembalian);

        $responsePg->assertStatus(200);
        $responsePg->assertSee($pengembalian->kode_pengembalian);
        $responsePg->assertDontSee('Barang belum dikembalikan');
        $responsePg->assertDontSee('Tidak ada barang yang belum dikembalikan (Nihil)');

        // 3. Cetak ulang bukti PDF via query param
        $responsePdf = $this->actingAs($this->user)
            ->get('/user/pengembalian/pdf?kode_pengembalian=' . $pengembalian->kode_pengembalian);

        $responsePdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $responsePdf->headers->get('Content-Type'));

        // 4. Pastikan akses berulang tidak membuat transaksi baru atau mengubah data
        $this->assertEquals($initialPengembalianCount, Pengembalian::count());
        $this->assertEquals($initialDetailCount, DetailPengembalian::count());
    }

    public function test_tampilan_laporan_jika_ada_barang_hilang(): void
    {
        $this->peminjaman->update(['status' => 'Selesai']);
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => 'PG-HILANG-' . time(),
            'kode_peminjaman' => $this->kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap ?? 'User Test',
        ]);

        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $pengembalian->kode_pengembalian,
            'kode_barang' => $this->barang1->kode_barang,
            'status' => 'baik',
            'deskripsi' => 'Barang Telah Dikembalikan',
        ]);

        DetailPengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => $pengembalian->kode_pengembalian,
            'kode_barang' => $this->barang2->kode_barang,
            'status' => 'hilang',
            'deskripsi' => 'Barang tertinggal di lokasi liputan',
        ]);

        // 1. Pratinjau HTML harus menampilkan data barang hilang dan deskripsinya
        $responseHtml = $this->actingAs($this->user)
            ->get('/user/pengembalian/report?kode_pengembalian=' . $pengembalian->kode_pengembalian);

        $responseHtml->assertStatus(200);
        $responseHtml->assertSee($this->barang1->nama_barang);
        $responseHtml->assertSee($this->barang2->kode_barang);
        $responseHtml->assertSee($this->barang2->nama_barang);
        // Karena ada barang hilang, teks Nihil TIDAK boleh muncul
        $responseHtml->assertDontSee('Tidak ada barang yang belum dikembalikan (Nihil)');

        // 2. Unduh PDF juga berhasil dimuat
        $responsePdf = $this->actingAs($this->user)
            ->get('/user/pengembalian/pdf?kode_pengembalian=' . $pengembalian->kode_pengembalian);

        $responsePdf->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $responsePdf->headers->get('Content-Type'));
    }

    public function test_otorisasi_dan_keamanan_bukti_pengembalian(): void
    {
        $this->peminjaman->update(['status' => 'Selesai']);
        $pengembalian = Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => 'PG-SEC-' . time(),
            'kode_peminjaman' => $this->kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Lengkap',
            'peminjam' => 'User Test',
        ]);

        // 1. Pengguna tanpa login ditolak saat mengakses report
        $guestReport = $this->get('/user/pengembalian/report?kode_peminjaman=' . $this->kodePmb);
        $guestReport->assertRedirect(route('login'));

        // 2. Pengguna tanpa login ditolak saat mengakses cetak PDF
        $guestPdf = $this->get('/user/pengembalian/pdf?kode_peminjaman=' . $this->kodePmb);
        $guestPdf->assertRedirect(route('login'));

        // 3. Akses bukti dengan kode PMB yang tidak ada tidak membuka data apa pun
        $unknownReport = $this->actingAs($this->user)
            ->get('/user/pengembalian/report?kode_peminjaman=PMB-TIDAK-VALID-12345');
        $unknownReport->assertRedirect(route('user.option'));

        $unknownPdf = $this->actingAs($this->user)
            ->get('/user/pengembalian/pdf?kode_peminjaman=PMB-TIDAK-VALID-12345');
        $unknownPdf->assertRedirect(route('user.option'));
    }

    public function test_kode_pmb_belum_selesai_berjalan_normal(): void
    {
        // Kode PMB aktif (status Proses)
        $response = $this->actingAs($this->user)->postJson('/user/pengembalian/check', [
            'code' => $this->kodePmb,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Silakan lakukan pengembalian.',
        ]);

        // Sesi peminjaman tersimpan
        $response->assertSessionHas('kodePeminjaman', $this->kodePmb);

        // Halaman index dapat diakses normal
        $indexResponse = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->get('/user/pengembalian');

        $indexResponse->assertStatus(200);
        $indexResponse->assertSee($this->barang1->nama_barang);
    }

    public function test_penanganan_kode_pmb_tidak_ditemukan(): void
    {
        $response = $this->actingAs($this->user)->postJson('/user/pengembalian/check', [
            'code' => 'PMB-TIDAK-ADA-999999',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'Kode tidak ditemukan.',
        ]);
    }

    public function test_akses_langsung_halaman_pengembalian_yang_sudah_selesai_dialihkan(): void
    {
        // Tandai peminjaman sebagai selesai
        $this->peminjaman->update(['status' => 'Selesai']);
        Pengembalian::create([
            'uuid' => (string) Str::uuid(),
            'kode_pengembalian' => 'PG-' . time(),
            'kode_peminjaman' => $this->kodePmb,
            'tanggal_kembali' => now(),
            'status' => 'Lengkap',
            'peminjam' => $this->user->nama_lengkap ?? 'User Test',
        ]);

        // Coba akses langsung index pengembalian dengan session kodePeminjaman yang sudah selesai
        $response = $this->actingAs($this->user)
            ->withSession(['kodePeminjaman' => $this->kodePmb])
            ->get('/user/pengembalian');

        $response->assertRedirect(route('user.option'));
        $response->assertSessionMissing('kodePeminjaman');
    }
}
