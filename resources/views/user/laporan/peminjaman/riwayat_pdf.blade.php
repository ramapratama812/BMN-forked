@php
  use Carbon\Carbon;
  Carbon::setLocale('id');

  $logoPath = public_path('img/assets/esimprod_logo.png');
  $hasLogo = file_exists($logoPath);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <style>
    @page {
      margin: 15mm 12mm 15mm 12mm;
      size: a4 portrait;
    }

    * {
      box-sizing: border-box;
      font-family: 'Helvetica', 'Arial', sans-serif;
    }

    body {
      font-size: 11px;
      color: #1f2937;
      line-height: 1.4;
      margin: 0;
      padding: 0;
    }

    /* Header Dokumen */
    .doc-header {
      width: 100%;
      border-bottom: 2px solid #1e3a8a;
      padding-bottom: 10px;
      margin-bottom: 14px;
    }

    .doc-header table {
      width: 100%;
      border-collapse: collapse;
    }

    .doc-title {
      font-size: 17px;
      font-weight: bold;
      color: #1e3a8a;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 3px;
    }

    .doc-subtitle {
      font-size: 11px;
      color: #4b5563;
    }

    /* Info Meta Box */
    .meta-box {
      width: 100%;
      background-color: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 4px;
      padding: 8px 12px;
      margin-bottom: 16px;
    }

    .meta-box table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10.5px;
    }

    .meta-box td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .meta-label {
      color: #64748b;
      font-weight: 500;
      width: 110px;
    }

    .meta-val {
      color: #0f172a;
      font-weight: bold;
    }

    /* Kartu Transaksi */
    .transaction-block {
      margin-bottom: 20px;
      border: 1px solid #cbd5e1;
      border-radius: 4px;
      background: #ffffff;
    }

    .transaction-header {
      background-color: #f1f5f9;
      border-bottom: 1px solid #cbd5e1;
      padding: 8px 10px;
      page-break-inside: avoid;
      page-break-after: avoid;
    }

    .transaction-header table {
      width: 100%;
      border-collapse: collapse;
    }

    .pmb-code {
      font-size: 13px;
      font-weight: bold;
      color: #1e3a8a;
      font-family: 'Courier New', monospace;
    }

    .tx-badge {
      display: inline-block;
      background-color: #1e3a8a;
      color: #ffffff;
      font-weight: bold;
      font-size: 10px;
      padding: 2px 7px;
      border-radius: 3px;
      margin-right: 6px;
      vertical-align: middle;
      letter-spacing: 0.3px;
    }

    .badge {
      display: inline-block;
      padding: 2px 8px;
      border-radius: 3px;
      font-size: 9.5px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .badge-selesai {
      background-color: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    .badge-sebagian {
      background-color: #dbeafe;
      color: #1e40af;
      border: 1px solid #bfdbfe;
    }

    .badge-dipinjam {
      background-color: #fef3c7;
      color: #92400e;
      border: 1px solid #fde68a;
    }

    /* Tabel Barang */
    .table-container {
      padding: 8px 10px;
    }

    table.items-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
    }

    table.items-table th {
      background-color: #2563eb;
      color: #ffffff;
      padding: 6px 7px;
      text-align: left;
      font-weight: bold;
      border: 1px solid #1d4ed8;
      font-size: 9.5px;
    }

    table.items-table td {
      padding: 5px 7px;
      border: 1px solid #e2e8f0;
      vertical-align: middle;
    }

    table.items-table tr:nth-child(even) {
      background-color: #f8fafc;
    }

    table.items-table tr {
      page-break-inside: avoid;
    }

    .tag-status {
      display: inline-block;
      padding: 1px 5px;
      border-radius: 2px;
      font-size: 9px;
      font-weight: 600;
    }

    .tag-kembali {
      background-color: #ecfdf5;
      color: #047857;
      border: 1px solid #a7f3d0;
    }

    .tag-pinjam {
      background-color: #fffbeb;
      color: #b45309;
      border: 1px solid #fde68a;
    }

    .kondisi-baik { color: #047857; font-weight: bold; }
    .kondisi-rusak { color: #b91c1c; font-weight: bold; }
    .kondisi-hilang { color: #c2410c; font-weight: bold; }

    /* Footer & Nomor Halaman */
    .page-footer {
      position: fixed;
      bottom: -10mm;
      left: 0;
      right: 0;
      height: 10mm;
      text-align: center;
      font-size: 9px;
      color: #94a3b8;
      border-top: 1px solid #e2e8f0;
      padding-top: 4px;
    }

    .empty-state {
      padding: 30px;
      text-align: center;
      background-color: #f8fafc;
      border: 1px dashed #cbd5e1;
      border-radius: 6px;
      color: #64748b;
      margin: 20px 0;
    }
  </style>
</head>
<body>

  {{-- HEADER DOKUMEN --}}
  <div class="doc-header">
    <table>
      <tr>
        <td style="width: 70%; vertical-align: top;">
          <div class="doc-title">{{ $title }}</div>
          <div class="doc-subtitle">Sistem Informasi Manajemen Barang Milik Negara (eSIMBA) TVRI Stasiun Gorontalo</div>
        </td>
        <td style="width: 30%; text-align: right; vertical-align: top;">
          @if ($hasLogo)
            <img src="{{ $logoPath }}" alt="eSIMBA Logo" style="height: 38px;">
          @else
            <div style="font-size: 16px; font-weight: bold; color: #1e3a8a;">eSIMBA</div>
          @endif
        </td>
      </tr>
    </table>
  </div>

  {{-- META INFORMASI DOKUMEN --}}
  <div class="meta-box">
    <table>
      <tr>
        <td class="meta-label">Peminjam</td>
        <td style="width: 5px;">:</td>
        <td class="meta-val" style="width: 40%;">
          {{ $peminjamUser?->nama_lengkap ?? ($user?->nama_lengkap ?? ($riwayatList->first()?->peminjam ?? '-')) }}
        </td>
        <td class="meta-label">Tanggal Cetak</td>
        <td style="width: 5px;">:</td>
        <td class="meta-val">{{ Carbon::parse($printDate)->locale('id')->translatedFormat('d F Y, H:i') }} WIB</td>
      </tr>
      <tr>
        <td class="meta-label">NIP / ID</td>
        <td>:</td>
        <td class="meta-val">{{ $peminjamUser?->nip ?? ($user?->nip ?? '-') }}</td>
        <td class="meta-label">Total Transaksi</td>
        <td>:</td>
        <td class="meta-val">{{ $riwayatList->count() }} Transaksi</td>
      </tr>
      <tr>
        <td class="meta-label">Jabatan</td>
        <td>:</td>
        <td class="meta-val">{{ $peminjamUser?->jabatan?->jabatan ?? ($user?->jabatan?->jabatan ?? '-') }}</td>
        <td class="meta-label">Filter Riwayat</td>
        <td>:</td>
        <td class="meta-val">
          @if (!empty($filters['status']) || !empty($filters['search']) || !empty($filters['peruntukan']))
            @php
              $activeFilters = [];
              if (!empty($filters['status'])) $activeFilters[] = 'Status: ' . $filters['status'];
              if (!empty($filters['search'])) $activeFilters[] = 'Cari: "' . $filters['search'] . '"';
              if (!empty($filters['peruntukan'])) $activeFilters[] = 'Peruntukan: ' . $filters['peruntukan'];
            @endphp
            <span style="color: #2563eb;">{{ implode(' | ', $activeFilters) }}</span>
          @else
            <span style="color: #64748b; font-weight: normal;">Semua Riwayat (Tanpa Filter)</span>
          @endif
        </td>
      </tr>
    </table>
  </div>

  {{-- DAFTAR TRANSAKSI RIWAYAT --}}
  @php $globalItemIndex = 1; @endphp
  @forelse ($riwayatList as $pIndex => $row)
    @php
      $statusReal = $row->computed_status;
      $returnMap = $row->return_details_map;
      $totalItems = $row->detailPeminjaman->count();
      $totalReturned = count($returnMap);

      $badgeClass = 'badge-dipinjam';
      if ($statusReal === 'Selesai') {
        $badgeClass = 'badge-selesai';
      } elseif ($statusReal === 'Dikembalikan Sebagian') {
        $badgeClass = 'badge-sebagian';
      }
    @endphp

    <div class="transaction-block">
      {{-- Header Kartu Transaksi --}}
      <div class="transaction-header">
        <table>
          <tr>
            <td style="width: 55%; vertical-align: top;">
              @if (!$isSingle)
                <span class="tx-badge">Transaksi #{{ $loop->iteration }}</span>
              @endif
              <span class="pmb-code">{{ $row->kode_peminjaman }}</span>
              <span style="margin-left: 6px; font-weight: bold; color: #374151;">
                {{ $row->nomor_surat ?: '-' }}
              </span>
              <div style="font-size: 9.5px; color: #64748b; margin-top: 3px;">
                No. Peminjaman: {{ $row->nomor_peminjaman ?: '-' }} | Peruntukan: <strong>{{ $row->peruntukan->peruntukan ?? '-' }}</strong>
              </div>
            </td>
            <td style="width: 50%; text-align: right; vertical-align: top;">
              <span class="badge {{ $badgeClass }}">
                {{ $statusReal }} ({{ $totalReturned }}/{{ $totalItems }} Kembali)
              </span>
              <div style="font-size: 9.5px; color: #64748b; margin-top: 3px;">
                @php
                  $tglPinjamFmt = !empty($row->tanggal_peminjaman) ? Carbon::parse($row->tanggal_peminjaman)->locale('id')->translatedFormat('d M Y') : null;
                  $tglPenggunaanFmt = !empty($row->tanggal_penggunaan) ? Carbon::parse($row->tanggal_penggunaan)->locale('id')->translatedFormat('d M Y') : null;
                  $tglBatasFmt = !empty($row->tanggal_kembali) ? Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d M Y') : '-';
                @endphp
                @if ($tglPinjamFmt && $tglPenggunaanFmt && $tglPinjamFmt !== $tglPenggunaanFmt)
                  Pinjam: <strong>{{ $tglPinjamFmt }}</strong> |
                  Penggunaan: <strong>{{ $tglPenggunaanFmt }}</strong> |
                @elseif ($tglPenggunaanFmt)
                  Penggunaan: <strong>{{ $tglPenggunaanFmt }}</strong> |
                @elseif ($tglPinjamFmt)
                  Pinjam: <strong>{{ $tglPinjamFmt }}</strong> |
                @endif
                Batas: <strong>{{ $tglBatasFmt }}</strong>
              </div>
            </td>
          </tr>
        </table>
      </div>

      {{-- Tabel Rincian Barang Transaksi Ini --}}
      <div class="table-container">
        <table class="items-table">
          <thead>
            <tr>
              <th style="width: 25px; text-align: center;">No</th>
              <th style="width: 95px;">Kode Barang</th>
              <th>Nama Barang & Merk</th>
              <th style="width: 85px;">No. Seri</th>
              <th style="width: 95px; text-align: center;">Status Pengembalian</th>
              <th style="width: 90px; text-align: center;">Tgl. Kembali</th>
              <th style="width: 105px;">Kondisi / Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($row->detailPeminjaman as $bIndex => $detail)
              @php
                $item = $detail->barang;
                $retInfo = $returnMap[$detail->kode_barang] ?? null;
                $isKembali = !is_null($retInfo);
                $kondisi = strtolower($retInfo['status'] ?? 'baik');
                $itemNumber = $isSingle ? ($bIndex + 1) : $globalItemIndex++;
              @endphp
              <tr>
                <td style="text-align: center; color: #64748b;">{{ $itemNumber }}</td>
                <td style="font-family: 'Courier New', monospace; font-weight: bold; color: #1e3a8a;">
                  {{ $detail->kode_barang }}
                </td>
                <td>
                  <strong style="color: #0f172a;">{{ $item->nama_barang ?? 'Barang #' . $detail->kode_barang }}</strong>
                  @if (!empty($item?->merk))
                    <div style="font-size: 9px; color: #64748b;">Merk: {{ $item->merk }}</div>
                  @endif
                </td>
                <td style="font-family: 'Courier New', monospace; font-size: 9.5px;">
                  {{ $item->nomor_seri ?: '-' }}
                </td>
                <td style="text-align: center;">
                  @if ($isKembali)
                    <span class="tag-status tag-kembali">Sudah Kembali</span>
                  @else
                    <span class="tag-status tag-pinjam">Masih Dipinjam</span>
                  @endif
                </td>
                <td style="text-align: center; font-size: 9.5px;">
                  {{ !empty($row->tanggal_kembali) ? Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d M Y') : '-' }}
                </td>
                <td>
                  @if ($isKembali)
                    @if ($kondisi === 'rusak')
                      <span class="kondisi-rusak">Rusak</span>
                    @elseif ($kondisi === 'hilang')
                      <span class="kondisi-hilang">Hilang</span>
                    @else
                      <span class="kondisi-baik">Baik</span>
                    @endif
                    @if (!empty($retInfo['deskripsi']))
                      <div style="font-size: 9px; color: #64748b;">{{ $retInfo['deskripsi'] }}</div>
                    @endif
                  @else
                    <span style="color: #94a3b8; font-style: italic;">Sedang dalam penggunaan</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" style="text-align: center; color: #94a3b8; padding: 10px;">
                  Tidak ada barang yang terdaftar pada transaksi ini.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @empty
    <div class="empty-state">
      <div style="font-size: 13px; font-weight: bold; margin-bottom: 4px;">Tidak Ada Data Riwayat Peminjaman</div>
      <div>Tidak ditemukan transaksi peminjaman yang sesuai dengan filter atau hak akses Anda.</div>
    </div>
  @endforelse

  {{-- FOOTER HALAMAN --}}
  <div class="page-footer">
    Dokumen dicetak secara otomatis dari Sistem eSIMBA TVRI Gorontalo &bull; {{ Carbon::parse($printDate)->locale('id')->translatedFormat('d F Y') }}
  </div>

</body>
</html>
