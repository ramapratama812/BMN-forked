<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class RepairMissingBarangQr extends Command
{
    protected $signature = 'barang:repair-missing-qr {--dry-run : Periksa data tanpa mengubah database atau storage}';
    protected $description = 'Regenerate QR SVG for barang entries whose QR file is missing or invalid';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        $missing = Barang::all()->filter(function ($b) {
            return empty($b->qr_code)
                || str_starts_with($b->qr_code, 'QR-')
                || !Storage::disk('public')->exists('uploads/qr_codes_barang/' . $b->qr_code);
        });

        $this->info("Found {$missing->count()} barang with missing or invalid QR files.");

        if ($isDryRun) {
            $this->warn("[DRY-RUN] Mode aktif: Tidak ada perubahan yang disimpan.");
            foreach ($missing as $barang) {
                $this->line(" - ID: {$barang->id} | Kode: {$barang->kode_barang} | Current QR: '{$barang->qr_code}'");
            }
            return self::SUCCESS;
        }

        $successCount = 0;
        foreach ($missing as $barang) {
            if (empty($barang->kode_barang)) {
                $this->warn("Skipping ID {$barang->id}: kode_barang is empty.");
                continue;
            }

            try {
                $svg = QrCode::format('svg')->size(200)->generate($barang->kode_barang);
                $fileName = Str::uuid() . '_qr.svg';
                Storage::disk('public')->put("uploads/qr_codes_barang/{$fileName}", $svg);

                $barang->qr_code = $fileName;
                $barang->save();

                $successCount++;
                $this->info("OK: ID {$barang->id} ({$barang->kode_barang}) -> {$fileName}");
            } catch (\Throwable $e) {
                $this->error("FAIL: ID {$barang->id} ({$barang->kode_barang}) - Error: {$e->getMessage()}");
            }
        }

        $this->info("Completed: {$successCount} QR code files successfully regenerated.");
        return self::SUCCESS;
    }
}
