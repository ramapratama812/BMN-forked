<?php

namespace App\Helpers;

use BaconQrCode\Encoder\Encoder;
use BaconQrCode\Common\ErrorCorrectionLevel;

class QrCodeHelper
{
    /**
     * Generate QR Code sebagai PNG data URI menggunakan GD (tanpa Imagick).
     * Cocok untuk embed di DomPDF.
     *
     * @param string $text   Data yang di-encode ke QR
     * @param int    $size   Ukuran output gambar (pixel)
     * @param int    $margin Margin (dalam modul)
     * @return string        "data:image/png;base64,..."
     */
    public static function generatePngDataUri(string $text, int $size = 250, int $margin = 2): string
    {
        // Encode QR menggunakan BaconQrCode Encoder
        $qrCode = Encoder::encode($text, ErrorCorrectionLevel::M());

        $matrix = $qrCode->getMatrix();
        $dimension = $matrix->getHeight(); // jumlah modul (biasanya 21–45)
        $moduleCount = $dimension + ($margin * 2);

        // Hitung ukuran tiap modul
        $moduleSize = (int) floor($size / $moduleCount);
        if ($moduleSize < 1) $moduleSize = 1;
        $imgSize = $moduleSize * $moduleCount;

        // Buat gambar GD
        $img = imagecreatetruecolor($imgSize, $imgSize);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        imagefill($img, 0, 0, $white);

        // Gambar tiap modul
        for ($y = 0; $y < $dimension; $y++) {
            for ($x = 0; $x < $dimension; $x++) {
                if ($matrix->get($x, $y) === 1) {
                    $px = ($x + $margin) * $moduleSize;
                    $py = ($y + $margin) * $moduleSize;
                    imagefilledrectangle(
                        $img,
                        $px, $py,
                        $px + $moduleSize - 1,
                        $py + $moduleSize - 1,
                        $black
                    );
                }
            }
        }

        // Capture output sebagai PNG
        ob_start();
        imagepng($img);
        $pngData = ob_get_clean();
        imagedestroy($img);

        return 'data:image/png;base64,' . base64_encode($pngData);
    }
}
