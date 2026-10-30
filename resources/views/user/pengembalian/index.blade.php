@extends('layouts.user.main')

@section('title', 'ESIMPROD | PENGEMBALIAN')

@section('content')

  {{-- profil --}}
  <x-peminjam-profile></x-peminjam-profile>

  <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mt-3">
    <div class="p-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <div class="w-full">
          <div class="relative flex items-center">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-file-lines text-gray-500"></i>
            </div>
            <input type="text"
              class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              placeholder="{{ $peminjaman->nomor_surat }}" disabled>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-2">
          <small class="flex items-center text-gray-500 font-medium">Tgl. Penggunaan</small>

          <div class="flex-1">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="{{ !empty($peminjaman->tanggal_penggunaan) ? \Carbon\Carbon::parse($peminjaman->tanggal_penggunaan)->locale('id')->translatedFormat('d F Y') : '-' }}" disabled>
            </div>
          </div>

          <small class="flex items-center text-gray-500 font-medium">Batas Pengembalian</small>

          <div class="flex-1">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="{{ !empty($peminjaman->tanggal_kembali) ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->locale('id')->translatedFormat('d F Y') : '-' }}" disabled>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center">
          <small class="text-gray-500 mr-3">Peruntukan</small>
          <input type="text"
            class="bg-gray-50 border border-gray-400 text-center text-gray-500 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
            value="{{ $peminjaman->peruntukan->peruntukan ?? '-' }}" disabled>
        </div>

        {{-- Indikator Counter Pemindaian --}}
        <div id="scan-counter-badge"
          class="inline-flex items-center px-3.5 py-1.5 text-xs sm:text-sm font-semibold rounded-full transition-all duration-300 {{ ($scannedCount ?? 0) === count($barang) ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300' }}">
          <i class="fa-solid fa-qrcode mr-2"></i>
          <span>Dipindai: <strong id="scanned-count">{{ $scannedCount ?? 0 }}</strong> / <strong id="total-count">{{ count($barang) }}</strong> barang</span>
        </div>
      </div>

      {{-- Action Bar: Tombol Pindai QR Barang --}}
      <div class="mt-4 flex items-center justify-start border-t pt-3 dark:border-gray-700">
        <button type="button" id="btn-open-scanner"
          class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg shadow-sm transition dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
          <i class="fa-solid fa-camera mr-2"></i> Pindai QR Barang
        </button>
      </div>
    </div>

    <div class="max-h-72 overflow-y-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="p-4">No</th>
            <th scope="col" class="px-6 py-3">Nama Barang</th>
            <th scope="col" class="px-6 py-3">Merk</th>
            <th scope="col" class="px-6 py-3">No Seri</th>
            <th scope="col" class="px-6 py-3">Kondisi</th>
            <th scope="col" class="px-6 py-3 text-center">Status Scan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barang as $key => $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors {{ $item['isChecked'] ? 'bg-green-50 dark:bg-green-950/20' : '' }}"
                data-item-row="{{ $item['kode_barang'] }}">
              <td class="w-4 p-4">
                <div class="flex items-center">
                  <p>{{ $key + 1 }}</p>
                </div>
              </td>
              <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="ps-2">
                  <div class="text-base font-semibold">{{ $item['nama_barang'] }}</div>
                  <small class="text-xs text-gray-400">{{ $item['kode_barang'] }}</small>
                </div>
              </th>
              <td>{{ $item['merk'] }}</td>
              <td class="px-6 py-4">
                <div class="flex items-center">
                  {{ $item['nomor_seri'] }}
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="max-w-sm mx-auto">
                  <select
                    class="item-condition bg-gray-50 border border-gray-400 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    {{ $item['isChecked'] ? '' : 'disabled' }}>
                    @if ($item['isChecked'])
                      <option value="baik" selected>Baik</option>
                      <option value="rusak">Rusak</option>
                    @else
                      <option selected value="belum_dipindai">Belum Dipindai</option>
                      <option value="baik">Baik</option>
                      <option value="rusak">Rusak</option>
                    @endif
                  </select>
                </div>
              </td>
              <td class="px-6 py-4 text-center">
                <input type="hidden" name="uuid" value="{{ $item['uuid'] }}" class="item-uuid">
                <input type="hidden" name="kodeBarang" value="{{ $item['kode_barang'] }}" class="item-code">
                <input type="checkbox" value="" name="bordered-checkbox"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-not-allowed"
                  data-code="{{ $item['kode_barang'] }}"
                  {{ $item['isChecked'] ? 'checked' : '' }} disabled>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- button  --}}
  <div class="flex justify-center space-x-2 mt-4 mb-16">
    <a href="{{ route('user.option') }}" type="button"
      class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
    <button type="button" id="btn-trigger-save"
      class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
  </div>

  {{-- Modal Scanner Kamera HP --}}
  <div id="scan-camera-modal" class="hidden fixed inset-0 z-50 bg-slate-900/80 flex justify-center items-center backdrop-blur-sm p-4">
    <div class="w-full max-w-sm bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-2xl relative">
      <button id="btn-close-scanner" type="button"
        class="absolute -top-3 -right-3 bg-rose-500 text-white w-8 h-8 rounded-full shadow-lg hover:bg-rose-600 flex items-center justify-center text-sm font-bold transition-transform hover:scale-110 z-10"
        title="Tutup Kamera">
        ✕
      </button>
      <div class="text-center mb-3">
        <h3 class="font-bold text-gray-900 dark:text-white text-base">Pindai QR Barang</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400">Posisikan QR code barang di dalam area pemindaian</p>
      </div>
      <div id="reader" class="w-full aspect-square bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-inner"></div>
      <div id="scanner-feedback" class="mt-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300">
        Menghubungkan ke kamera...
      </div>
    </div>
  </div>

  <x-pengembalian-popup></x-pengembalian-popup>

  {{-- CDN Pemindai QR yang konsisten dengan project --}}
  <script src="https://unpkg.com/html5-qrcode"></script>

  <style>
    #reader video {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      border-radius: 0.75rem;
    }
  </style>

  <script>
    // Configuration Constants
    const CONFIG = {
      API_ENDPOINTS: {
        VALIDATE_ITEM: '/user/pengembalian/validation',
        STORE_RETURN: '/user/pengembalian/store'
      },
      ANIMATION_DURATION: 1000
    };

    // Utility Functions
    const Utils = {
      getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').content;
      },
      showAlert(message) {
        alert(message);
      },
      logError(error) {
        console.error('Error:', error);
      }
    };

    // Return Item Management
    const ReturnItemManager = {
      cameraScanner: {
        html5QrCode: null,
        isScanning: false,
        isProcessing: false,
        modal: null,
        feedback: null,

        init() {
          this.modal = document.getElementById('scan-camera-modal');
          this.feedback = document.getElementById('scanner-feedback');

          const btnOpen = document.getElementById('btn-open-scanner');
          const btnClose = document.getElementById('btn-close-scanner');

          if (btnOpen) {
            btnOpen.addEventListener('click', () => this.openScanner());
          }

          if (btnClose) {
            btnClose.addEventListener('click', () => this.stopScanner());
          }

          // Pastikan kamera dihentikan jika user meninggalkan halaman
          window.addEventListener('beforeunload', () => {
            if (this.html5QrCode && this.isScanning) {
              try {
                this.html5QrCode.stop();
              } catch (e) {}
            }
          });
        },

        cleanScannedString(raw) {
          if (!raw || typeof raw !== 'string') return '';
          let cleaned = raw.trim().replace(/[\u0000-\u001F\u007F]+/g, '').replace(/\s+/g, ' ');
          // Jika isi QR adalah URL (contoh: http://.../user/scan-barang/BRG-0001)
          if (cleaned.includes('/')) {
            const parts = cleaned.split('/');
            cleaned = parts.pop() || parts.pop();
            if (cleaned && cleaned.includes('?')) {
              cleaned = cleaned.split('?')[0];
            }
          }
          // Normalisasi khusus jika hasil scan memuat prefix 'QR-' dari generator/label lama
          if (cleaned.startsWith('QR-')) {
            cleaned = cleaned.substring(3);
          }
          return cleaned ? decodeURIComponent(cleaned.trim()) : '';
        },

        showModal() {
          if (this.modal) {
            this.modal.classList.remove('hidden');
            this.modal.classList.add('flex');
          }
        },

        hideModal() {
          if (this.modal) {
            this.modal.classList.add('hidden');
            this.modal.classList.remove('flex');
          }
        },

        openScanner() {
          if (this.isScanning) return;

          this.showModal();
          if (this.feedback) {
            this.feedback.textContent = 'Membuka kamera HP...';
          }

          if (!this.html5QrCode) {
            const formats = (typeof Html5QrcodeSupportedFormats !== 'undefined')
              ? [Html5QrcodeSupportedFormats.QR_CODE]
              : [0];
            this.html5QrCode = new Html5Qrcode('reader', {
              formatsToSupport: formats,
              experimentalFeatures: {
                useBarCodeDetectorIfSupported: true
              },
              verbose: false
            });
          }

          this.isScanning = true;
          this.isProcessing = false;

          const qrConfig = {
            fps: 22,
            qrbox: (viewfinderWidth, viewfinderHeight) => {
              const minEdge = Math.min(viewfinderWidth, viewfinderHeight);
              const size = Math.max(180, Math.floor(minEdge * 0.75));
              return {
                width: Math.min(size, viewfinderWidth),
                height: Math.min(size, viewfinderHeight)
              };
            },
            aspectRatio: 1.0
          };

          // Prioritaskan kamera belakang HP
          this.html5QrCode.start(
            { facingMode: 'environment' },
            qrConfig,
            (decodedText) => {
              this.handleScanResult(decodedText);
            },
            (errorMessage) => {
              // Ignore background scan frame misses
            }
          ).then(() => {
            if (this.feedback) {
              this.feedback.textContent = 'Arahkan kamera ke QR code barang';
            }
          }).catch((err) => {
            Utils.logError(err);
            this.isScanning = false;
            this.isProcessing = false;
            this.hideModal();
            Utils.showAlert('Tidak dapat mengakses kamera belakang HP. Pastikan izin kamera telah diberikan.');
          });
        },

        stopScanner() {
          this.isProcessing = false;
          if (this.html5QrCode && this.isScanning) {
            return this.html5QrCode.stop().then(() => {
              try {
                this.html5QrCode.clear();
              } catch (e) {}
              this.isScanning = false;
              this.hideModal();
            }).catch((err) => {
              try {
                this.html5QrCode.clear();
              } catch (e) {}
              this.isScanning = false;
              this.hideModal();
            });
          } else {
            this.isScanning = false;
            this.hideModal();
            return Promise.resolve();
          }
        },

        async handleScanResult(rawMessage) {
          if (this.isProcessing) return;
          this.isProcessing = true;

          // Segera jeda pemindaian agar frame berikutnya tidak memicu proses ganda
          if (this.html5QrCode && this.isScanning) {
            try {
              this.html5QrCode.pause(true);
            } catch (_) {}
          }

          const itemCode = this.cleanScannedString(rawMessage);
          if (!itemCode) {
            this.isProcessing = false;
            if (this.html5QrCode && this.isScanning) {
              try { this.html5QrCode.resume(); } catch (_) {}
            }
            return;
          }

          // Hentikan kamera segera setelah QR terbaca tanpa navigasi halaman
          await this.stopScanner();

          // Kirim kode_barang ke endpoint validasi
          try {
            await this.processItemValidation(itemCode);
          } finally {
            this.isProcessing = false;
          }
        },

        async processItemValidation(itemCode) {
          try {
            const response = await fetch(CONFIG.API_ENDPOINTS.VALIDATE_ITEM, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': Utils.getCsrfToken()
              },
              body: JSON.stringify({
                itemCode: itemCode
              })
            });

            const data = await response.json();

            if (response.ok && data.success) {
              this.highlightValidatedItem(itemCode);
              ReturnItemManager.updateCounter();
              Utils.showAlert(data.message || `Barang (${itemCode}) berhasil divalidasi.`);
            } else if (response.status === 409 || data.already_scanned) {
              Utils.showAlert(data.message || `Barang (${itemCode}) sudah dipindai sebelumnya.`);
            } else {
              Utils.showAlert(data.message || `QR barang (${itemCode}) bukan bagian dari peminjaman aktif.`);
            }
          } catch (error) {
            Utils.logError(error);
            Utils.showAlert('Terjadi kesalahan saat memvalidasi QR barang.');
          }
        },

        highlightValidatedItem(itemCode) {
          const checkboxes = document.querySelectorAll('[data-code]');

          checkboxes.forEach((checkbox) => {
            if (checkbox.getAttribute('data-code') === itemCode) {
              checkbox.checked = true;
              const row = checkbox.closest('tr');

              if (row) {
                row.classList.add('bg-green-50');
                this.flashRowAnimation(row);

                // Aktifkan pilihan kondisi Baik / Rusak (default Baik)
                const conditionSelect = row.querySelector('.item-condition');
                if (conditionSelect) {
                  conditionSelect.disabled = false;
                  conditionSelect.innerHTML = `
                    <option value="baik" selected>Baik</option>
                    <option value="rusak">Rusak</option>
                  `;
                }
              }
            }
          });
        },

        flashRowAnimation(row) {
          row.classList.add('flash-animation');
          setTimeout(() => {
            row.classList.remove('flash-animation');
          }, CONFIG.ANIMATION_DURATION);
        }
      },

      updateCounter() {
        const checkboxes = document.querySelectorAll('[data-code]');
        const total = checkboxes.length;
        let scanned = 0;

        checkboxes.forEach((cb) => {
          if (cb.checked) scanned++;
        });

        const scannedEl = document.getElementById('scanned-count');
        const totalEl = document.getElementById('total-count');
        const badge = document.getElementById('scan-counter-badge');

        if (scannedEl) scannedEl.textContent = scanned;
        if (totalEl) totalEl.textContent = total;

        if (badge) {
          if (scanned === total && total > 0) {
            badge.classList.remove('bg-amber-100', 'text-amber-800', 'dark:bg-amber-900/40', 'dark:text-amber-300');
            badge.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900/40', 'dark:text-green-300');
          } else {
            badge.classList.remove('bg-green-100', 'text-green-800', 'dark:bg-green-900/40', 'dark:text-green-300');
            badge.classList.add('bg-amber-100', 'text-amber-800', 'dark:bg-amber-900/40', 'dark:text-amber-300');
          }
        }

        return { scanned, total };
      },

      returnSubmissionHandler: {
        init() {
          const btnTriggerSave = document.getElementById('btn-trigger-save');
          const saveButton = document.getElementById('savePengembalian');
          const cancelButton = document.getElementById('cancelPengembalian');
          const successButton = document.getElementById('successButton');

          // Tombol simpan di halaman utama
          if (btnTriggerSave) {
            btnTriggerSave.addEventListener('click', () => {
              this.handleSaveTrigger();
            });
          }

          // Tombol konfirmasi di modal konfirmasi
          if (saveButton) {
            saveButton.addEventListener('click', () => {
              this.prepareAndSubmitReturnData();
            });
          }

          // Tombol batal di modal konfirmasi
          if (cancelButton) {
            cancelButton.addEventListener('click', (e) => {
              e.preventDefault();
              this.hideSaveModal();
            });
          }

          // Dukung juga elemen penutup dengan atribut data-modal-hide="save-modal"
          const cancelModalButtons = document.querySelectorAll('[data-modal-hide="save-modal"]');
          cancelModalButtons.forEach((btn) => {
            if (btn !== cancelButton) {
              btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.hideSaveModal();
              });
            }
          });

          // Menutup modal jika klik di area latar belakang (backdrop)
          const saveModal = document.getElementById('save-modal');
          if (saveModal) {
            saveModal.addEventListener('click', (e) => {
              if (e.target === saveModal) {
                this.hideSaveModal();
              }
            });
          }

          // Menutup modal dengan tombol Escape pada keyboard
          document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
              const modal = document.getElementById('save-modal');
              if (modal && !modal.classList.contains('hidden')) {
                this.hideSaveModal();
              }
            }
          });

          // Tombol sukses lihat laporan
          if (successButton) {
            successButton.addEventListener('click', () => {
              this.redirectToReport();
            });
          }
        },

        handleSaveTrigger() {
          const { scanned, total } = ReturnItemManager.updateCounter();

          // Pastikan SELURUH barang dalam peminjaman aktif sudah dipindai dan divalidasi
          if (scanned < total || total === 0) {
            Utils.showAlert(
              `Seluruh barang dalam peminjaman aktif wajib dipindai terlebih dahulu sebelum pengembalian dapat disimpan. Baru ${scanned} dari ${total} barang yang dipindai.`
            );
            return;
          }

          // Jika semua barang sudah dipindai, buka modal konfirmasi
          this.showSaveModal();
        },

        showSaveModal() {
          const modal = document.getElementById('save-modal');
          if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
          }
        },

        hideSaveModal() {
          const modal = document.getElementById('save-modal');
          if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
          }
        },

        prepareAndSubmitReturnData() {
          const dataToSubmit = this.collectReturnData();
          const { scanned, total } = ReturnItemManager.updateCounter();

          if (scanned < total || total === 0) {
            Utils.showAlert('Semua barang wajib dipindai dan divalidasi terlebih dahulu.');
            this.hideSaveModal();
            return;
          }

          // Pastikan tidak ada barang yang belum divalidasi
          const unvalidated = dataToSubmit.filter(item => !item.isChecked || item.condition === 'belum_dipindai');
          if (unvalidated.length > 0) {
            Utils.showAlert('Masih ada barang yang belum dipindai.');
            this.hideSaveModal();
            return;
          }

          this.hideSaveModal();
          this.submitReturnData(dataToSubmit);
        },

        collectReturnData() {
          const rows = document.querySelectorAll('tr[data-item-row]');

          return Array.from(rows)
            .map(row => {
              const uuidInput = row.querySelector('.item-uuid');
              const codeInput = row.querySelector('.item-code');
              const conditionDropdown = row.querySelector('.item-condition');
              const checkbox = row.querySelector('input[type="checkbox"]');

              if (!uuidInput || !codeInput || !conditionDropdown || !checkbox) {
                return null;
              }

              return {
                item_uuid: uuidInput.value,
                item_code: codeInput.value,
                condition: conditionDropdown.value,
                isChecked: checkbox.checked
              };
            })
            .filter(item => item !== null);
        },

        async submitReturnData(data) {
          try {
            const response = await fetch(CONFIG.API_ENDPOINTS.STORE_RETURN, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': Utils.getCsrfToken()
              },
              body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok || result.status !== 'success') {
              Utils.showAlert(
                result.message || 'Pengembalian gagal disimpan. Silakan periksa kembali data.'
              );
              return;
            }

            this.handleSubmissionResponse(result);
          } catch (error) {
            Utils.logError(error);
            Utils.showAlert('Terjadi kesalahan saat mengirim data pengembalian.');
          }
        },

        handleSubmissionResponse(data) {
          const successModal = document.getElementById('successModal');

          if (successModal) {
            successModal.classList.remove('hidden');
            successModal.classList.add('flex');
          } else {
            Utils.showAlert(data.message || 'Pengembalian berhasil disimpan.');
            this.redirectToReport();
          }
        },

        redirectToReport() {
          window.location.href = '{{ route('user.pengembalian.report') }}';
        }
      }
    };

    document.addEventListener('DOMContentLoaded', () => {
      // Inisialisasi scanner kamera
      ReturnItemManager.cameraScanner.init();

      // Inisialisasi return submission handler
      ReturnItemManager.returnSubmissionHandler.init();

      // Hitung dan update status counter saat halaman pertama dimuat
      ReturnItemManager.updateCounter();
    });
  </script>

@endsection