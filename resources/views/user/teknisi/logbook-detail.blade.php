
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengerjaan | Logbook Teknisi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .header, .section {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
        }

        h1 {
            font-size: 25px;
            margin: 0 0 8px;
        }

        h2 {
            font-size: 18px;
            margin-top: 0;
        }

        .muted {
            color: #6b7280;
            font-size: 14px;
        }

        .row {
            display: grid;
            grid-template-columns: 190px 1fr;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            color: #6b7280;
        }

        .value {
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: #e0f2fe;
            color: #075985;
            font-size: 13px;
            font-weight: bold;
        }

        .evidence {
            max-width: 100%;
            max-height: 400px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .button {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            background: #374151;
            color: #fff;
            text-decoration: none;
        }

        .file-link {
            display: inline-block;
            margin-top: 8px;
            color: #2563eb;
            overflow-wrap: anywhere;
        }

        @media (max-width: 600px) {
            .row {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .header, .section {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Detail Pengerjaan</h1>
        <p class="muted">
            Rincian hasil pekerjaan perbaikan barang inventaris.
        </p>

        <a href="{{ route('user.teknisi.logbook') }}" class="button">
            Kembali ke Logbook
        </a>
    </div>

    <div class="section">
        <h2>Informasi Barang</h2>

        <div class="row">
            <div class="label">Nama Barang</div>
            <div class="value">
                {{ $perawatan->barang->nama_barang ?? '-' }}
            </div>
        </div>

        <div class="row">
            <div class="label">Tanggal Pengerjaan</div>
            <div class="value">
                {{ $perawatan->tanggal_perawatan
                    ? \Carbon\Carbon::parse($perawatan->tanggal_perawatan)->format('d/m/Y H:i')
                    : $perawatan->created_at?->format('d/m/Y H:i') ?? '-' }}
            </div>
        </div>

        <div class="row">
            <div class="label">Jenis Perawatan</div>
            <div class="value">
                {{ ucfirst($perawatan->jenis_perawatan ?? '-') }}
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Rincian Pengerjaan</h2>

        <div class="row">
            <div class="label">Keluhan Awal</div>
            <div class="value">{{ \Illuminate\Support\Str::after(
                $perawatan->deskripsi ?? '',
                'Keluhan: '
            ) }}</div>
        </div>

        <div class="row">
            <div class="label">Deskripsi Pengerjaan</div>
            <div class="value">{{ str_contains($perawatan->deskripsi ?? '', 'Tindakan Perbaikan:')
                ? trim(\Illuminate\Support\Str::after(
                    $perawatan->deskripsi,
                    'Tindakan Perbaikan:'
                ))
                : ($perawatan->deskripsi ?? '-') }}</div>
        </div>

        <div class="row">
            <div class="label">Biaya Perbaikan</div>
            <div class="value">
                Rp {{ number_format((float) $perawatan->biaya, 0, ',', '.') }}
            </div>
        </div>

        <div class="row">
            <div class="label">Status Perbaikan</div>
            <div class="value">
                <span class="status">
                    {{ ucfirst(str_replace('_', ' ', $perawatan->status ?? '-')) }}
                </span>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Bukti Pengerjaan</h2>

        <div class="row">
            <div class="label">Foto Kerusakan Awal</div>
            <div class="value">
                @if ($perawatan->foto_kerusakan)
                    <a href="{{ asset('storage/' . $perawatan->foto_kerusakan) }}"
                       target="_blank" rel="noopener">
                        Lihat Foto Kerusakan
                    </a>
                    <br>
                    <img class="evidence"
                         src="{{ asset('storage/' . $perawatan->foto_kerusakan) }}"
                         alt="Foto kerusakan awal">
                @else
                    Belum ada foto kerusakan.
                @endif
            </div>
        </div>

        <div class="row">
            <div class="label">Foto Bukti Pengerjaan</div>
            <div class="value">
                @if ($perawatan->foto_bukti)
                    <a href="{{ asset('storage/' . $perawatan->foto_bukti) }}"
                       target="_blank" rel="noopener">
                        Lihat Foto Bukti
                    </a>
                    <br>
                    <img class="evidence"
                         src="{{ asset('storage/' . $perawatan->foto_bukti) }}"
                         alt="Foto bukti pengerjaan">
                @else
                    Belum ada foto bukti pengerjaan.
                @endif
            </div>
        </div>

        <div class="row">
            <div class="label">Dokumen Bukti</div>
            <div class="value">
                @if ($perawatan->dokumen_bukti)
                    <a class="file-link"
                       href="{{ asset('storage/' . $perawatan->dokumen_bukti) }}"
                       target="_blank" rel="noopener">
                        Buka atau unduh dokumen bukti
                    </a>
                @else
                    Belum ada dokumen bukti.
                @endif
            </div>
        </div>
    </div>

</div>
</body>
</html>
