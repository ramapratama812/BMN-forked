<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfilNomorHpE24Test extends TestCase
{
    use DatabaseTransactions;

    protected User $admin;
    protected User $user;
    protected User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan nomor uji (081234567890 dan 0812345678901) tidak bentrok dengan data user manual
        User::whereIn('nomor_hp', ['081234567890', '0812345678901'])->update(['nomor_hp' => '0899999999999']);

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'nomor_hp' => '081299990001',
        ]);

        $this->user = User::factory()->create([
            'role' => 'user',
            'nomor_hp' => '081299990002',
        ]);

        $this->otherUser = User::factory()->create([
            'role' => 'user',
            'nomor_hp' => '081299990003',
        ]);
    }

    /**
     * E24-01: Nomor HP berisi digit valid (12 digit) lolos validasi pada profil admin.
     */
    public function test_nomor_hp_berisi_digit_valid_lolos_pada_profil_admin(): void
    {
        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => '081234567890',
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('profil.index'));
        $this->assertEquals('081234567890', $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-02: Input huruf ditolak dengan pesan "Nomor HP harus berupa angka."
     */
    public function test_input_huruf_ditolak_pada_profil_admin(): void
    {
        $originalHp = $this->admin->nomor_hp;

        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->from(route('profil.index'))
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => 'abcdefgh',
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP harus berupa angka.',
        ]);
        $response->assertRedirect(route('profil.index'));
        $this->assertEquals($originalHp, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-02: Input kombinasi huruf dan angka ditolak dengan pesan "Nomor HP harus berupa angka."
     */
    public function test_input_kombinasi_huruf_dan_angka_ditolak(): void
    {
        $originalHp = $this->admin->nomor_hp;

        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => '0812abc3456',
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP harus berupa angka.',
        ]);
        $this->assertEquals($originalHp, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-04: Nomor HP menggunakan tanda pemisah (Data Uji: 0812-3456-7890) ditolak karena format nomor HP tidak sesuai ketentuan.
     */
    public function test_input_simbol_desimal_dan_eksponensial_ditolak(): void
    {
        $invalidInputs = [
            '0812-3456-7890',  // simbol tanda hubung (tanda pemisah)
            '0812.345678',     // desimal
            '+62812345678',    // tanda tambah
            '-08123456789',    // tanda minus
        ];

        foreach ($invalidInputs as $invalidInput) {
            $response = $this->actingAs($this->admin)
                ->withSession(['passwordVerified' => true])
                ->patch(route('profil.update-profil'), [
                    'nama_lengkap' => $this->admin->nama_lengkap,
                    'email' => $this->admin->email,
                    'nip' => $this->admin->nip,
                    'nomor_hp' => $invalidInput,
                ]);

            $response->assertSessionHasErrors([
                'nomor_hp' => 'Format nomor HP tidak sesuai ketentuan.',
            ]);
        }
    }

    /**
     * E24-05: Input nomor HP mengandung spasi ditolak dengan pesan "Nomor HP tidak boleh mengandung spasi."
     */
    public function test_input_mengandung_spasi_ditolak_pada_profil_admin(): void
    {
        $originalHp = $this->admin->nomor_hp;
        $inputsWithSpace = [
            '0812 3456 7890',
            '0812 3456 789',
            '081 234 567 890',
        ];

        foreach ($inputsWithSpace as $inputWithSpace) {
            $response = $this->actingAs($this->admin)
                ->withSession(['passwordVerified' => true])
                ->patch(route('profil.update-profil'), [
                    'nama_lengkap' => $this->admin->nama_lengkap,
                    'email' => $this->admin->email,
                    'nip' => $this->admin->nip,
                    'nomor_hp' => $inputWithSpace,
                ]);

            $response->assertSessionHasErrors([
                'nomor_hp' => 'Nomor HP tidak boleh mengandung spasi.',
            ]);
        }

        $this->assertEquals($originalHp, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-03: Input nomor HP kosong ditolak dengan pesan "Nomor HP harus diisi."
     */
    public function test_input_nomor_hp_kosong_ditolak(): void
    {
        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => '',
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP harus diisi.',
        ]);
    }

    /**
     * E24-06: Nomor HP tepat 13 digit diterima pada profil Admin.
     */
    public function test_admin_profil_13_digit_diterima(): void
    {
        $hp13Digit = '0812345678901';

        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => $hp13Digit,
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('profil.index'));
        $this->assertEquals($hp13Digit, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-06: Nomor HP 14 digit ditolak pada backend profil Admin.
     */
    public function test_admin_profil_14_digit_ditolak_backend(): void
    {
        $originalHp = $this->admin->nomor_hp;
        $hp14Digit = '08123456789012';

        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => $hp14Digit,
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP tidak boleh lebih dari 13 digit.',
        ]);
        $this->assertEquals($originalHp, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-06: Nomor HP 15 digit ditolak pada backend profil Admin.
     */
    public function test_admin_profil_15_digit_ditolak_backend(): void
    {
        $originalHp = $this->admin->nomor_hp;
        $hp15Digit = '081234567890123';

        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => $hp15Digit,
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP tidak boleh lebih dari 13 digit.',
        ]);
        $this->assertEquals($originalHp, $this->admin->fresh()->nomor_hp);
    }

    /**
     * E24-07: Nomor HP duplikat milik akun lain ditolak dengan pesan "Nomor HP sudah digunakan oleh user lain."
     */
    public function test_nomor_hp_duplikat_milik_akun_lain_ditolak(): void
    {
        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => $this->admin->nama_lengkap,
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => $this->otherUser->nomor_hp,
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP sudah digunakan oleh user lain.',
        ]);
    }

    /**
     * E24-08: Pengguna dapat menyimpan kembali nomor HP miliknya sendiri.
     */
    public function test_pengguna_dapat_menyimpan_kembali_nomor_hp_miliknya_sendiri(): void
    {
        $response = $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => 'Nama Admin Baru',
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => $this->admin->nomor_hp,
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertEquals('Nama Admin Baru', $this->admin->fresh()->nama_lengkap);
    }

    /**
     * Data lama tidak berubah ketika input tidak valid.
     */
    public function test_data_lama_tidak_berubah_ketika_input_tidak_valid(): void
    {
        $originalHp = $this->admin->nomor_hp;
        $originalName = $this->admin->nama_lengkap;

        $this->actingAs($this->admin)
            ->withSession(['passwordVerified' => true])
            ->patch(route('profil.update-profil'), [
                'nama_lengkap' => 'Nama Yang Seharusnya Tidak Berubah',
                'email' => $this->admin->email,
                'nip' => $this->admin->nip,
                'nomor_hp' => 'HURUF_TIDAK_VALID',
            ]);

        $freshAdmin = $this->admin->fresh();
        $this->assertEquals($originalHp, $freshAdmin->nomor_hp);
        $this->assertEquals($originalName, $freshAdmin->nama_lengkap);
    }

    /**
     * E24-05: Alur profil Pengguna menolak spasi dengan pesan "Nomor HP tidak boleh mengandung spasi."
     */
    public function test_alur_profil_pengguna_menolak_spasi_dengan_pesan_khusus(): void
    {
        $originalHp = $this->user->nomor_hp;

        $response = $this->actingAs($this->user)
            ->patch(route('user.profil.update'), [
                'nama_lengkap' => $this->user->nama_lengkap,
                'email' => $this->user->email,
                'nip' => $this->user->nip,
                'nomor_hp' => '0812 3456 7890',
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP tidak boleh mengandung spasi.',
        ]);
        $this->assertEquals($originalHp, $this->user->fresh()->nomor_hp);
    }

    /**
     * E24-06: Nomor HP tepat 13 digit diterima pada profil Pengguna.
     */
    public function test_pengguna_profil_13_digit_diterima(): void
    {
        $hp13Digit = '0812345678901';

        $response = $this->actingAs($this->user)
            ->patch(route('user.profil.update'), [
                'nama_lengkap' => $this->user->nama_lengkap,
                'email' => $this->user->email,
                'nip' => $this->user->nip,
                'nomor_hp' => $hp13Digit,
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertEquals($hp13Digit, $this->user->fresh()->nomor_hp);
    }

    /**
     * E24-06: Nomor HP 14 digit ditolak pada backend profil Pengguna.
     */
    public function test_pengguna_profil_14_digit_ditolak_backend(): void
    {
        $originalHp = $this->user->nomor_hp;
        $hp14Digit = '08123456789012';

        $response = $this->actingAs($this->user)
            ->patch(route('user.profil.update'), [
                'nama_lengkap' => $this->user->nama_lengkap,
                'email' => $this->user->email,
                'nip' => $this->user->nip,
                'nomor_hp' => $hp14Digit,
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP tidak boleh lebih dari 13 digit.',
        ]);
        $this->assertEquals($originalHp, $this->user->fresh()->nomor_hp);
    }

    /**
     * E24-06: Nomor HP 15 digit ditolak pada backend profil Pengguna.
     */
    public function test_pengguna_profil_15_digit_ditolak_backend(): void
    {
        $originalHp = $this->user->nomor_hp;
        $hp15Digit = '081234567890123';

        $response = $this->actingAs($this->user)
            ->patch(route('user.profil.update'), [
                'nama_lengkap' => $this->user->nama_lengkap,
                'email' => $this->user->email,
                'nip' => $this->user->nip,
                'nomor_hp' => $hp15Digit,
            ]);

        $response->assertSessionHasErrors([
            'nomor_hp' => 'Nomor HP tidak boleh lebih dari 13 digit.',
        ]);
        $this->assertEquals($originalHp, $this->user->fresh()->nomor_hp);
    }

    /**
     * Alur profil Pengguna menolak huruf, simbol, input kosong, dan duplikat.
     */
    public function test_alur_profil_pengguna_menolak_huruf_simbol_kosong_dan_duplikat(): void
    {
        $originalHp = $this->user->nomor_hp;

        // Uji huruf
        $resHuruf = $this->actingAs($this->user)->patch(route('user.profil.update'), [
            'nama_lengkap' => $this->user->nama_lengkap,
            'email' => $this->user->email,
            'nip' => $this->user->nip,
            'nomor_hp' => '0812abc3456',
        ]);
        $resHuruf->assertSessionHasErrors(['nomor_hp' => 'Nomor HP harus berupa angka.']);

        // Uji simbol
        $resSimbol = $this->actingAs($this->user)->patch(route('user.profil.update'), [
            'nama_lengkap' => $this->user->nama_lengkap,
            'email' => $this->user->email,
            'nip' => $this->user->nip,
            'nomor_hp' => '0812-3456-7890',
        ]);
        $resSimbol->assertSessionHasErrors(['nomor_hp' => 'Format nomor HP tidak sesuai ketentuan.']);

        // Uji kosong
        $resKosong = $this->actingAs($this->user)->patch(route('user.profil.update'), [
            'nama_lengkap' => $this->user->nama_lengkap,
            'email' => $this->user->email,
            'nip' => $this->user->nip,
            'nomor_hp' => '',
        ]);
        $resKosong->assertSessionHasErrors(['nomor_hp' => 'Nomor HP harus diisi.']);

        // Uji duplikat milik akun lain
        $resDuplikat = $this->actingAs($this->user)->patch(route('user.profil.update'), [
            'nama_lengkap' => $this->user->nama_lengkap,
            'email' => $this->user->email,
            'nip' => $this->user->nip,
            'nomor_hp' => $this->admin->nomor_hp,
        ]);
        $resDuplikat->assertSessionHasErrors(['nomor_hp' => 'Nomor HP sudah digunakan oleh user lain.']);

        $this->assertEquals($originalHp, $this->user->fresh()->nomor_hp);
    }

    /**
     * Alur profil Pengguna mempertahankan nomor milik sendiri.
     */
    public function test_alur_profil_pengguna_mempertahankan_nomor_sendiri(): void
    {
        $currentHp = $this->user->nomor_hp;

        $response = $this->actingAs($this->user)->patch(route('user.profil.update'), [
            'nama_lengkap' => 'Nama Pengguna Baru Terupdate',
            'email' => $this->user->email,
            'nip' => $this->user->nip,
            'nomor_hp' => $currentHp,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertEquals('Nama Pengguna Baru Terupdate', $this->user->fresh()->nama_lengkap);
        $this->assertEquals($currentHp, $this->user->fresh()->nomor_hp);
    }
}
