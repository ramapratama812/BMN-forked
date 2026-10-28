<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Label QR Code Barang</title>
    <style>
        @page {
            size: a4 portrait;
            margin: 10mm 10mm 12mm 10mm;
        }

        @font-face {
            font-family: 'Gotham Black';
            src: url('{{ public_path('fonts/Gotham-Black.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #ffffff;
        }

        /* Header Halaman Pertama (Penanda Ruangan & Batas Kertas) */
        .page-header {
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 2px solid #003366;
        }

        .page-header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-title-main {
            font-size: 13px;
            font-weight: bold;
            color: #000000ff;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .header-subtitle {
            font-size: 8px;
            color: #000000ff;
            margin-top: 1px;
        }

        .room-badge {
            display: inline-block;
            background-color: #ebf8ff;
            border: 1.5px solid #003366;
            color: #003366;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: right;
        }

        /* Tabel Grid 2 Kolom untuk Kertas A4 (Aman dari Overflow) */
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .sticker-cell {
            width: 50%;
            vertical-align: top;
            padding: 3px 4px;
        }

        /* Kartu Stiker Horizontal dengan Garis Bantu Potong */
        .sticker-card {
            border: 1px dashed #718096;
            border-radius: 4px;
            padding: 6px 8px;
            background-color: #ffffff;
            page-break-inside: avoid;
        }

        .inner-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Sisi Kiri: Khusus QR Code */
        .qr-col {
            width: 76px;
            text-align: center;
            vertical-align: middle;
            padding-right: 8px;
            border-right: 1px dotted #cbd5e0;
        }

        .img-qr {
            width: 72px;
            height: 72px;
            display: block;
            margin: 0 auto;
        }

        .info-col {
            vertical-align: top;
            padding-left: 8px;
        }

        .header-table {
            width: 95%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .logo-tvri-box {
            text-align: left;
            vertical-align: middle;
            width: 50%;
        }

        .logo-tvri-wrapper {
            width: 55px;
            text-align: center;
        }

        .img-logo-tvri {
            height: 18px;
            width: auto;
            display: inline-block;
            margin-bottom: 2px;
        }

        .text-kalsel {
            font-family: 'Gotham Black', sans-serif;
            font-size: 4.5px;
            font-weight: bold;
            letter-spacing: 0.3px;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            color: #1a202c;
        }

        .logo-esimba-box {
            text-align: right;
            vertical-align: middle;
            width: 50%;
            padding-right: 10px;
        }

        .img-logo-esimba {
            height: 22px;
            width: auto;
            display: inline-block;
        }

        .divider {
            border-top: 1px solid #e2e8f0;
            margin: 3px 0 4px 0;
        }

        .nama-barang {
            font-weight: bold;
            font-size: 10px;
            color: #1a202c;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 3px;
            max-height: 26px;
            overflow: hidden;
        }

        .meta-info {
            font-size: 8px;
            color: #4a5568;
            line-height: 1.25;
        }

        .badge-empty {
            color: #e53e3e;
            font-size: 7.5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
        // Deteksi Nama Ruangan untuk Header Halaman
        $ruangReq = request('ruangan');
        $katReq = request('kategori');

        if ($ruangReq && $ruangReq !== 'all') {
            $namaRuangan = $ruangReq;
        } elseif ($barang->isNotEmpty() && !empty($barang->first()->ruangan)) {
            $uniqueRuangan = $barang->pluck('ruangan')->filter()->unique();
            if ($uniqueRuangan->count() === 1) {
                $namaRuangan = $uniqueRuangan->first();
            } else {
                $namaRuangan = 'SEMUA RUANGAN (BMN)';
            }
        } elseif ($katReq === 'master') {
            $namaRuangan = 'OPERASIONAL SIARAN';
        } else {
            $namaRuangan = 'SEMUA INVENTARIS';
        }

        // Pecah per 2 stiker per baris untuk membuat grid 2 kolom rapi di A4
        $chunks = $barang->chunk(2);
        $logoTvri = public_path('img/assets/logo_tvri_icon.png');
        $logoEsimba = public_path('img/assets/logo_esimba_bluebg.png');
    @endphp

    <!-- HEADER HALAMAN PERTAMA -->
    <div class="page-header">
        <table class="page-header-table">
            <tr>
                <td style="text-align: left; vertical-align: middle;">
                    <div class="header-title-main">LABEL QR CODE INVENTARIS</div>
                    <div class="header-subtitle">LPP TVRI STASIUN KALIMANTAN SELATAN</div>
                </td>
                <td style="text-align: right; vertical-align: middle;">
                    <div class="room-badge">
                        RUANGAN: {{ strtoupper($namaRuangan) }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="grid-table">
        <tbody>
            @foreach ($chunks as $chunk)
                <tr>
                    @foreach ($chunk as $b)
                        @php
                            $isBmn = isset($b->ruangan);
                            if ($isBmn) {
                                $qrPath = public_path('storage/' . $b->qr_code);
                            } else {
                                $qrPath = public_path('storage/uploads/qr_codes_barang/' . $b->qr_code);
                            }
                        @endphp
                        <td class="sticker-cell">
                            <div class="sticker-card">
                                <table class="inner-table">
                                    <tr>
                                        <!-- SISI KIRI: QR CODE -->
                                        <td class="qr-col">
                                            @if ($b->qr_code && file_exists($qrPath))
                                                <img src="{{ $qrPath }}" class="img-qr" alt="QR Code">
                                            @else
                                                <span class="badge-empty">QR KOSONG</span>
                                            @endif
                                        </td>

                                        <!-- SISI KANAN: HEADER & INFORMASI BARANG -->
                                        <td class="info-col">
                                            <!-- HEADER: LOGO TVRI & LOGO ESIMBA -->
                                            <table class="header-table">
                                                <tr>
                                                    <td class="logo-tvri-box">
                                                        <div class="logo-tvri-wrapper">
                                                            <img src="{{ $logoTvri }}" class="img-logo-tvri"
                                                                alt="TVRI">
                                                            <div class="text-kalsel">KALIMANTAN SELATAN</div>
                                                        </div>
                                                    </td>
                                                    <td class="logo-esimba-box">
                                                        <img src="{{ $logoEsimba }}" class="img-logo-esimba"
                                                            alt="E-SIMBA">
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="divider"></div>

                                            <!-- NAMA BARANG -->
                                            <div class="nama-barang">
                                                {{ \Illuminate\Support\Str::limit($b->nama_barang, 45) }}
                                            </div>

                                            <!-- METADATA (URUTAN: RUANGAN, NUP) -->
                                            <div class="meta-info">
                                                @if ($isBmn)
                                                    @if (!empty($b->ruangan))
                                                        Ruangan: <strong>{{ $b->ruangan }}</strong><br>
                                                    @endif
                                                    @if (!empty($b->nup))
                                                        NUP: <strong>{{ $b->nup }}</strong>
                                                    @endif
                                                @else
                                                    @if (!empty($b->merk))
                                                        Merk:
                                                        <strong>{{ \Illuminate\Support\Str::limit($b->merk, 25) }}</strong>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    @endforeach

                    {{-- Isi sel kosong jika baris ganjil di akhir halaman --}}
                    @if ($chunk->count() == 1)
                        <td class="sticker-cell" style="border: none; background: transparent;"></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
