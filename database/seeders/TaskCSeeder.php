<?php

namespace Database\Seeders;

use App\Models\BmnBarang;
use App\Models\LaporanKerusakan;
use App\Models\PerawatanInventaris;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TaskCSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. USER / TEKNISI TASK C
        |--------------------------------------------------------------------------
        */

        // Gunakan Superadmin yang sudah ada sebagai pelapor/admin
        $admin = User::where('kode_user', 'USR061224')->first();

        if (!$admin) {
            $this->command->error(
                'User USR061224 tidak ditemukan. Jalankan UserSeeder terlebih dahulu.'
            );

            return;
        }

        // Buat user teknisi khusus untuk dummy Task C
       $teknisi = User::firstOrCreate(
    [
        'kode_user' => 'USRTEKC01',
    ],
    [
        'uuid' => Str::uuid(),
        'nama_lengkap' => 'Teknisi Task C',
        'email' => 'teknisi.taskc@esimba.test',
        'nip' => '1999010120260001',
        'nomor_hp' => '081234567890',
        'role' => 'teknisi',
        'jabatan_id' => 4,
        'password' => Hash::make('TeknisiTaskC123'),
        'qr_code' => 'taskc_teknisi_qr.png',
        'foto' => 'default.jpeg',
        'created_at' => now(),
        'updated_at' => now(),
    ]
);

        /*
        |--------------------------------------------------------------------------
        | 2. DATA BARANG BMN
        |--------------------------------------------------------------------------
        */

        $barangPending = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-LAP-001',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Laptop Admin Task C',
                'nup' => '001',
                'kategori' => 'Elektronik',
                'merk' => 'Lenovo',
                'nomor_seri' => 'TASKC-LAPTOP-001',
                'jumlah' => 1,
                'persentase_kondisi' => 70,
                'kondisi' => 'Rusak Ringan',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Ruang Administrasi',
                
                'tanggal_perolehan' => '2024-01-15',
                'nilai_perolehan' => 8500000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Administrasi',
                'posisi' => 'Meja Admin',
                'catatan' => 'Dummy Task C - laporan pending',
            ]
        );

        $barangDitolak = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-LAP-002',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Laptop Produksi Task C',
                'nup' => '002',
                'kategori' => 'Elektronik',
                'merk' => 'Acer',
                'nomor_seri' => 'TASKC-LAPTOP-002',
                'jumlah' => 1,
                'persentase_kondisi' => 80,
                'kondisi' => 'Baik',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Ruang Produksi',
                
                'tanggal_perolehan' => '2024-02-20',
                'nilai_perolehan' => 7500000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Produksi',
                'posisi' => 'Meja Produksi',
                'catatan' => 'Dummy Task C - laporan ditolak',
            ]
        );

        $barangPerbaikan = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-PRN-001',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Printer Keuangan Task C',
                'nup' => '003',
                'kategori' => 'Peralatan Kantor',
                'merk' => 'Epson',
                'nomor_seri' => 'TASKC-PRINTER-001',
                'jumlah' => 1,
                'persentase_kondisi' => 50,
                'kondisi' => 'Rusak',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Ruang Keuangan',
                
                'tanggal_perolehan' => '2023-05-10',
                'nilai_perolehan' => 4500000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Keuangan',
                'posisi' => 'Meja Keuangan',
                'catatan' => 'Dummy Task C - antrean perbaikan',
            ]
        );

        $barangSelesai = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-KMR-001',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Kamera Dokumentasi Task C',
                'nup' => '004',
                'kategori' => 'Kamera',
                'merk' => 'Canon',
                'nomor_seri' => 'TASKC-CAMERA-001',
                'jumlah' => 1,
                'persentase_kondisi' => 90,
                'kondisi' => 'Baik',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Ruang Dokumentasi',
                
                'tanggal_perolehan' => '2023-08-12',
                'nilai_perolehan' => 12000000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Dokumentasi',
                'posisi' => 'Lemari Kamera',
                'catatan' => 'Dummy Task C - riwayat perbaikan',
            ]
        );

        $barangHapus = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-LAP-003',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Laptop Arsip Task C',
                'nup' => '005',
                'kategori' => 'Elektronik',
                'merk' => 'HP',
                'nomor_seri' => 'TASKC-LAPTOP-003',
                'jumlah' => 1,
                'persentase_kondisi' => 20,
                'kondisi' => 'Rusak Berat',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Ruang Arsip',
                
                'tanggal_perolehan' => '2019-03-10',
                'nilai_perolehan' => 9000000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Arsip',
                'posisi' => 'Lemari Arsip',
                'catatan' => 'Dummy Task C - rencana penghapusan',
            ]
        );

        $barangArsip = BmnBarang::firstOrCreate(
            [
                'kode_barang' => 'TASKC-PRN-002',
            ],
            [
                'uuid' => Str::uuid(),
                'nama_barang' => 'Printer Lama Task C',
                'nup' => '006',
                'kategori' => 'Peralatan Kantor',
                'merk' => 'Canon',
                'nomor_seri' => 'TASKC-PRINTER-002',
                'jumlah' => 1,
                'persentase_kondisi' => 10,
                'kondisi' => 'Rusak Berat',
                'foto' => 'default.jpg',
                'qr_code' => null,
                'ruangan' => 'Gudang',
                
                'tanggal_perolehan' => '2018-01-10',
                'nilai_perolehan' => 3000000,
                'asal_pengadaan' => 'Pembelian',
                'peruntukan' => 'Operasional',
                'posisi' => 'Gudang BMN',
                'catatan' => 'Dummy Task C - arsip penghapusan',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 3. E12 - LAPORAN KERUSAKAN PENDING
        |--------------------------------------------------------------------------
        */

        LaporanKerusakan::firstOrCreate(
            [
                'barang_id' => $barangPending->id,
                'user_id' => $admin->id,
                'status' => 'pending',
            ],
            [
                'teknisi_id' => null,
                'jenis_kerusakan' => 'Layar rusak',
                'deskripsi' => 'Layar laptop mengalami garis dan tampilan berkedip.',
                'foto' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4. E12 - RIWAYAT LAPORAN DITOLAK
        |--------------------------------------------------------------------------
        */

        LaporanKerusakan::firstOrCreate(
            [
                'barang_id' => $barangDitolak->id,
                'user_id' => $admin->id,
                'status' => 'ditolak',
            ],
            [
                'teknisi_id' => null,
                'jenis_kerusakan' => 'Keyboard bermasalah',
                'deskripsi' => 'Beberapa tombol keyboard tidak berfungsi.',
                'foto' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 5. E15 - ANTREAN PERBAIKAN
        |--------------------------------------------------------------------------
        */

        PerawatanInventaris::firstOrCreate(
            [
                'barang_id' => $barangPerbaikan->id,
                'jenis_perawatan' => 'perbaikan',
                'status' => 'pending',
            ],
            [
                'user_id' => $admin->id,
                'tanggal_perawatan' => now()->subDays(2)->toDateString(),
                'deskripsi' => 'TASK-C: Printer tidak dapat mencetak dokumen.',
                'biaya' => null,
                'foto_kerusakan' => null,
                'foto_bukti' => null,
                'surat_penghapusan' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 6. E16 + E17 - RIWAYAT PERBAIKAN
        |--------------------------------------------------------------------------
        */

        PerawatanInventaris::firstOrCreate(
            [
                'barang_id' => $barangSelesai->id,
                'jenis_perawatan' => 'perbaikan',
                'deskripsi' => 'TASK-C: Pembersihan sensor kamera dan penggantian konektor.',
            ],
            [
                'user_id' => $teknisi->id,
                'tanggal_perawatan' => now()->subDays(5)->toDateString(),
                'status' => 'diperbaiki',
                'biaya' => 350000,
                'foto_kerusakan' => null,
                'foto_bukti' => null,
                'surat_penghapusan' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 7. E18 - RENCANA PENGHAPUSAN
        |--------------------------------------------------------------------------
        */

        PerawatanInventaris::firstOrCreate(
            [
                'barang_id' => $barangHapus->id,
                'jenis_perawatan' => 'rencana_penghapusan',
            ],
            [
                'user_id' => $admin->id,
                'tanggal_perawatan' => now()->subDays(1)->toDateString(),
                'status' => 'pending',
                'deskripsi' => 'TASK-C: Barang rusak berat dan direncanakan untuk penghapusan.',
                'biaya' => null,
                'foto_kerusakan' => null,
                'foto_bukti' => null,
                'surat_penghapusan' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 8. E18 - DATA PENGHAPUSAN / ARSIP
        |--------------------------------------------------------------------------
        */

        PerawatanInventaris::firstOrCreate(
            [
                'barang_id' => $barangArsip->id,
                'jenis_perawatan' => 'penghapusan',
            ],
            [
                'user_id' => $admin->id,
                'tanggal_perawatan' => now()->subDays(10)->toDateString(),
                'status' => 'selesai',
                'deskripsi' => 'TASK-C: Barang telah masuk arsip penghapusan.',
                'biaya' => null,
                'foto_kerusakan' => null,
                'foto_bukti' => null,
                'surat_penghapusan' => null,
            ]
        );

        $this->command->info('==========================================');
        $this->command->info('DUMMY DATA TASK C BERHASIL DIBUAT');
        $this->command->info('==========================================');
        $this->command->info('E12 : Laporan pending + laporan ditolak');
        $this->command->info('E13 : Data siap untuk pengujian duplikasi');
        $this->command->info('E15 : Antrean perbaikan');
        $this->command->info('E16 : Riwayat perbaikan');
        $this->command->info('E17 : Data logbook');
        $this->command->info('E18 : Rencana + arsip penghapusan');
        $this->command->info('==========================================');
    }
}