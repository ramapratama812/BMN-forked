@php
  use Carbon\Carbon;
  Carbon::setLocale('id');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="csrf-token"
    content="{{ csrf_token() }}"
  >
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>ESIMPROD | LAPORAN PENGEMBALIAN</title>

  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 93%;
      margin: auto;
      padding: 10px;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    h1 {
      margin: 0;
    }

    .logo {
      width: 100px;
      height: auto;
    }

    .info-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .above-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      margin-top: 20px;
    }


    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    table th {
      background-color: #3251ad;
      color: white;
    }

    table .blm {
      background-color: #e26a2c;
      color: white;
    }

    .btn-group {
      margin-top: 30px;
      text-align: center;
    }

    .btn {
      background-color: #1e3164;
      border: none;
      color: white;
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn:hover {
      transition-duration: 0.5s;
      background-color: #3251ad;
    }

    input {
      outline: none;
      border: none;
      box-sizing: border-box;
      position: relative;
      /* z-index: 1; */
      width: 100%;
    }

  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Daftar Barang Kembali</h1>
      <img
        src="{{ asset('img/assets/esimprod_logo.png') }}"
        alt="Logo"
        class="logo"
      >
    </div>
    <div class="above-section">
      <div class="item">
        <h3 style="font-weight: normal;"><strong>No Peminjaman:</strong>
          {{ $pengembalian->peminjaman->nomor_peminjaman }}</h3>
        <h3 style="font-weight: normal;"><strong>Kode Pengembalian:</strong> {{ $pengembalian->kode_pengembalian }}</h3>
      </div>
    </div>


    <div class="info-section">
      <div class="item">
        <p><strong>Peminjam:</strong> {{ $pengembalian->peminjaman?->peminjam ?? ($pengembalian->peminjam ?? '-') }} </p>
        <p><strong>NIP:</strong> {{ Auth::user()?->nip ?? '-' }}</p>
        <p><strong>No HP:</strong> {{ Auth::user()?->nomor_hp ?? '-' }}</p>
        <p><strong>Jabatan:</strong> {{ Auth::user()?->jabatan?->jabatan ?? '-' }}</p>
      </div>
      <div class="item">
        <p><strong>Surat Tugas:</strong> {{ $pengembalian->peminjaman?->nomor_surat ?? '-' }} </p>
        <p><strong>Peruntukan:</strong> {{ $pengembalian->peminjaman?->peruntukan?->peruntukan ?? '-' }} </p>
        <p><strong>Tgl. Penggunaan:</strong>
          {{ !empty($pengembalian->peminjaman?->tanggal_penggunaan) ? Carbon::parse($pengembalian->peminjaman->tanggal_penggunaan)->locale('id')->translatedFormat('d F Y') : '-' }}
        </p>
        <p><strong>Batas Pengembalian:</strong>
          {{ !empty($pengembalian->peminjaman?->tanggal_kembali) ? Carbon::parse($pengembalian->peminjaman->tanggal_kembali)->locale('id')->translatedFormat('d F Y') : '-' }}
        </p>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>NO</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Merk</th>
          <th>No Seri</th>
          <th>Kondisi</th>
          <th>Penjelasan</th>
        </tr>
      </thead>
      <tbody>
        {{--      Barang Kembali --}}
        @foreach ($barangKembali as $key => $item)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item['kode_barang'] ?? '-' }}</td>
            <td>{{ $item['nama_barang'] }}</td>
            <td>{{ $item['merk'] }}</td>
            <td>{{ $item['nomor_seri'] }}</td>
            <td>{{ $item['kondisi'] }}</td>
            <td>
              @if ($item['kondisi'] !== 'baik')
                <input
                  type="hidden"
                  class="input-field barang-uuid"
                  value="{{ $item['uuid'] }}"
                >
                <input
                  type="text"
                  class="input-field barang-desc"
                  value="{{ (!empty($item['deskripsi']) && $item['deskripsi'] !== 'Barang Telah Dikembalikan') ? $item['deskripsi'] : '' }}"
                  placeholder="Isi penjelasan kerusakan!"
                  oninput="validateDescription(this)"
                  required
                >
              @else
                <span>-</span> <!-- Tampilkan simbol jika tidak ada kolom input -->
              @endif
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    @if (!empty($barangHilang) && count($barangHilang) > 0)
    <p>Barang belum dikembalikan</p>

    <table>
      <thead>
        <tr>
          <th class="blm">NO</th>
          <th class="blm">Kode Barang</th>
          <th class="blm">Nama Barang</th>
          <th class="blm">Merk</th>
          <th class="blm">No Seri</th>
          <th class="blm">Penjelasan</th>
        </tr>
      </thead>
      <tbody>
        {{--      Barang Tak Kembali --}}
        @foreach ($barangHilang as $key => $item)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item['kode_barang'] ?? '-' }}</td>
            <td>{{ $item['nama_barang'] }} </td>
            <td>{{ $item['merk'] }}</td>
            <td>{{ $item['nomor_seri'] }}</td>
            <td>
              @if(!empty($item['is_unreturned']))
                <span style="color: #b45309; font-weight: 500;">Masih Dipinjam</span>
              @else
              <input
                type="hidden"
                class="input-field barang-uuid"
                value="{{ $item['uuid'] }}"
              >
              <input
                type="text"
                class="input-field barang-desc"
                value="{{ (!empty($item['deskripsi']) && $item['deskripsi'] !== 'Barang Telah Dikembalikan') ? $item['deskripsi'] : '' }}"
                placeholder="Isi penjelasan !"
                oninput="validateDescription(this)"
                required
              >
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    <div class="btn-group">
      <button
        id="printpdf"
        type="button"
        target="_blank"
        class="btn"
      >Download PDF</button>
      <button
        id="clear"
        type="button"
        class="btn"
      >Selesai</button>
    </div>
  </div>
  <script>
    // Fungsi validasi deskripsi agar aman saat event inline maupun listener
    function validateDescription(input) {
      if (!input) return true;
      const isValid = input.value.trim() !== '';
      input.classList.toggle('is-invalid', !isValid);
      if (!isValid) {
        input.setCustomValidity('Deskripsi barang harus diisi!');
      } else {
        input.setCustomValidity('');
      }
      return isValid;
    }

    document.addEventListener('DOMContentLoaded', function() {
      const printPdfButton = document.getElementById('printpdf');
      const clearButton = document.getElementById('clear');
      const inputs = document.querySelectorAll('.input-field');

      inputs.forEach(input => {
        if (input.disabled) {
          input.placeholder = '';
        }
        if (input.classList.contains('barang-desc')) {
          input.addEventListener('input', () => validateDescription(input));
          input.addEventListener('blur', () => validateDescription(input));
        }
      });

      class ReturnReportManager {
        async sendToAPI(redirect_route) {
          const descInputs = document.querySelectorAll('.barang-desc');

          // Jika tidak ada input penjelasan barang, langsung arahkan
          if (descInputs.length === 0) {
            this.redirectBasedOnRoute(redirect_route);
            return;
          }

          const itemsToUpdate = [];
          let allValid = true;

          descInputs.forEach(input => {
            const row = input.closest('tr');
            const uuidInput = row ? row.querySelector('.barang-uuid') : null;
            const desc = input.value.trim();

            if (!desc) {
              validateDescription(input);
              input.reportValidity();
              allValid = false;
            } else {
              validateDescription(input);
              if (uuidInput && uuidInput.value) {
                itemsToUpdate.push({
                  uuid: uuidInput.value,
                  description: desc
                });
              }
            }
          });

          if (!allValid) {
            return;
          }

          if (itemsToUpdate.length > 0) {
            try {
              const response = await fetch("{{ route('user.pengembalian.update_desc') }}", {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ barang: itemsToUpdate })
              });

              if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
              }
            } catch (error) {
              console.error('Error saat menyimpan penjelasan:', error);
              alert('Terjadi kesalahan saat menyimpan penjelasan: ' + error.message);
              return;
            }
          }

          this.redirectBasedOnRoute(redirect_route);
        }

        redirectBasedOnRoute(redirect_route) {
          if (redirect_route === 'printpdf') {
            window.location.href = "{{ route('user.pengembalian.pdf', ['kode_pengembalian' => $pengembalian->kode_pengembalian, 'kode_peminjaman' => $pengembalian->kode_peminjaman]) }}";
          } else if (redirect_route === 'clear') {
            window.location.href = "{{ route('user.option') }}";
          }
        }
      }

      const reportManager = new ReturnReportManager();

      if (printPdfButton) {
        printPdfButton.addEventListener('click', () => reportManager.sendToAPI('printpdf'));
      }

      if (clearButton) {
        clearButton.addEventListener('click', () => reportManager.sendToAPI('clear'));
      }
    });
  </script>
</body>

</html>
