<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('img/assets/esimprod_logo_bg.png') }}" type="image/x-icon">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
  <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet">
  <title>User Options</title>

  {{-- CSS Animasi Logo Premium --}}
  <style>
    /* Definisi animasi gerakan cahaya */
    @keyframes sheenAnimation {
      0% {
        /* Mulai dari posisi jauh di kiri */
        transform: translateX(-200%) skewX(-25deg);
      }
      /* Selesai bergerak ke kanan pada 50% durasi */
      50%, 100% {
        /* Berakhir di posisi jauh di kanan */
        transform: translateX(200%) skewX(-25deg);
      }
    }

    /* Wrapper logo */
    .premium-sheen-wrapper {
      position: relative;
      overflow: hidden; /* Cahaya tidak keluar area */
      display: inline-block;
      /* Border radius akan mengikuti class tailwind di elemen ini */
    }

    /* Elemen cahaya (pseudo-element) */
    .premium-sheen-wrapper::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* Gradien putih transparan */
      background: linear-gradient(
        120deg,
        rgba(255, 255, 255, 0) 30%,
        rgba(255, 255, 255, 0.6) 50%, /* Sedikit lebih terang (0.6) agar terlihat jelas saat cepat */
        rgba(255, 255, 255, 0) 70%
      );
      /* UPDATE: Durasi diubah menjadi 3s (lebih cepat dari 5s) */
      animation: sheenAnimation 3s infinite cubic-bezier(0.4, 0.0, 0.2, 1);
      pointer-events: none;
    }
  </style>

  @notifyCss
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
  class="bg-cover bg-center bg-[url('../../public/img/assets/option-bg-1.png')] bg-opacity-40 bg-blend-multiply flex flex-col min-h-screen">

  <div id="toast-success"
    class="hidden flex items-center fixed top-9 right-14 w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
    role="alert">
    <div
      class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
      </svg>
      <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">Kode di Temukan.</div>
    <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      data-dismiss-target="#toast-success" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  </div>

  {{-- Navbar --}}
  <nav class="fixed top-0 z-50 w-full dark:bg-gray-800 dark:border-gray-700 font-sans">
    <div class="px-4 py-3 lg:px-6">
      <div class="flex items-center justify-between">
        
        {{-- BAGIAN KIRI: LOGO --}}
        <div class="flex items-center justify-start">
            <div class="flex items-center gap-3">
              {{-- Wrapper Logo dengan Efek Kilauan --}}
              <div class="premium-sheen-wrapper h-8 bg-blue-900 p-1 rounded-lg">
                 <img src="{{ asset('img/assets/esimprod_logo.png') }}" class="h-full w-auto object-contain"
                   alt="ESIMPROD" />
              </div>
  
              <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                <small class="text-xs text-white font-thin">Version 3.0</small>
              </span>
            </div>
        </div>

        {{-- BAGIAN KANAN: USER PROFILE --}}
        <div class="flex items-center">
          <div>
            <button type="button"
              class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
              aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full"
                src="{{ Auth::user()->foto ? asset('storage/uploads/foto_user/' . Auth::user()->foto) : Avatar::create(Auth::user()->nama_lengkap)->toBase64() }}"
                alt="user photo">
            </button>
          </div>
          <div
            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
            id="dropdown-user">
            <ul class="py-1" role="none">
              <li>
                  <a href="{{ route('user.profil', ['from' => 'options']) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <span class="font-semibold">Profil Saya</span>
                  </a>
              </li>
              <div class="my-2 border-t border-gray-200 dark:border-gray-600"></div>
              @if($guidebook)
              <li>
                  <a href="{{ asset('storage/uploads/guidebook/' . $guidebook->file) }}" target="_blank"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">
                    <span class="font-semibold">Panduan Penggunaan</span>
                  </a>
              </li>
              @endif
              <div class="my-2 border-t border-gray-200 dark:border-gray-600"></div>
              <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                  role="menuitem">
                  <span class="font-semibold">Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>

      </div>

    </div>
  </nav>

  <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
  </form>

  <section
    class="flex flex-1 justify-center items-center sm:justify-start sm:items-start pt-10 bg-transparent lg:mt-16">
    <div class="lg:ml-32 md:ml-16 sm:ml-8 px-4 w-full lg:w-auto">
      <div class="mr-auto place-self-center lg:col-span-7 w-full" data-aos="fade-right" data-aos-duration="1500">
        <h1
          class="text-white max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none sm:text-5xl md:text-6xl xl:text-6xl dark:text-white text-left">
          Selamat Datang
        </h1>
        <h3
          class="text-white max-w-2xl mb-4 text-3xl font-extrabold tracking-tight leading-none sm:text-4xl md:text-5xl xl:text-5xl dark:text-white text-left">
          {{ Auth::user()->nama_lengkap }}
        </h3>
        <h3 class="max-w-2xl font-light text-white text-2xl mb-4 dark:text-gray-400 text-left">
          {{ Auth::user()->jabatan->jabatan }} <br>
          {{ Auth::user()->nip }}
        </h3>

        <div
          class="bg-white rounded-lg p-2 shadow-lg flex flex-col sm:flex-row gap-2 items-center justify-center lg:mt-36">
          <a href="{{ route('user.peminjaman.index') }}"
            class="text-white bg-blue-950 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base sm:text-lg px-10 sm:px-24 py-3 w-full sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Penggunaan Barang
          </a>
          <button type="button" data-modal-target="scan-modal" data-modal-toggle="scan-modal"
            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base sm:text-lg px-10 sm:px-24 py-3 w-full sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Pengembalian Barang
          </button>
        </div>
      </div>
    </div>
  </section>

  {{-- scan modal --}}
  <div id="scan-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl text-center font-semibold text-gray-900 dark:text-white">
            Scan QR Penggunaan
          </h3>
          <button type="button"
            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="scan-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/1500/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d=" m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <div class="p-4 md:p-5">
          {{-- Area Kamera Scanner --}}
          <div id="camera-section" class="mb-4">
            <div id="reader-container" class="relative w-full aspect-square max-h-56 bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-600 flex items-center justify-center">
              <div id="reader-transaction" class="w-full h-full"></div>
              <div id="camera-placeholder" class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center bg-gray-50 dark:bg-gray-800 z-0">
                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Klik "Mulai Kamera" untuk memindai QR transaksi (PMB-...).</p>
              </div>
            </div>

            <div id="camera-status" class="text-xs text-center text-gray-500 dark:text-gray-400 mt-2 min-h-[1rem]"></div>

            {{-- Tombol Kontrol Kamera --}}
            <div class="flex gap-2 mt-3">
              <button type="button" id="btn-start-camera"
                class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg shadow-sm transition dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Mulai Kamera
              </button>
              <button type="button" id="btn-stop-camera"
                class="hidden flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:ring-4 focus:ring-rose-300 rounded-lg shadow-sm transition dark:bg-rose-600 dark:hover:bg-rose-700 focus:outline-none">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                </svg>
                Hentikan Kamera
              </button>
            </div>
          </div>

          {{-- Divider pemisah manual --}}
          <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-gray-200 dark:border-gray-600"></div>
            <span class="flex-shrink mx-3 text-xs text-gray-400 dark:text-gray-400 uppercase font-semibold">atau masukkan manual</span>
            <div class="flex-grow border-t border-gray-200 dark:border-gray-600"></div>
          </div>

          {{-- Input Manual dan Tombol Lanjut (Dipertahankan) --}}
          <div class="mt-1">
            <input type="text" name="code" id="code"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
              placeholder="Kode Penggunaan (PMB-...)" />
            <span id="error-message" class="text-red-600 text-sm mt-2 block hidden"></span>

            {{-- Pilihan Lihat Bukti Pengembalian jika transaksi sudah selesai --}}
            <div id="already-returned-actions" class="hidden mt-3 p-3 bg-amber-50 border border-amber-200 rounded-lg dark:bg-amber-900/20 dark:border-amber-700/50">
              <p class="text-xs text-amber-800 dark:text-amber-300 font-medium mb-2.5">
                <i class="fa-solid fa-circle-check mr-1 text-green-600 dark:text-green-400"></i>
                Transaksi ini telah selesai dikembalikan. Anda dapat melihat kembali atau mencetak bukti pengembalian:
              </p>
              <div class="flex flex-col sm:flex-row gap-2">
                <a id="btn-view-proof" href="#"
                  class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-white bg-blue-700 hover:bg-blue-800 rounded-lg shadow-sm transition">
                  <i class="fa-solid fa-file-lines mr-1.5"></i> Lihat Bukti Pengembalian
                </a>
                <a id="btn-print-proof" href="#" target="_blank"
                  class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-gray-800 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg shadow-sm transition dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                  <i class="fa-solid fa-print mr-1.5"></i> Cetak Ulang Bukti
                </a>
              </div>
            </div>
          </div>
          <button type="button" id="confirm"
            class="w-full mt-4 text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Lanjut</button>
        </div>
      </div>
    </div>
  </div>

  <div class="absolute top-0 left-0 right-0 z-50">
    <x-notify::notify />
  </div>

  @notifyJs

  {{-- Library html5-qrcode untuk pemindai kamera QR transaksi --}}
  <script src="https://unpkg.com/html5-qrcode"></script>

  <style>
    #reader-transaction video {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
    }
  </style>
</body>

@if (session('error'))
  <script>
    alert("{{ session('error') }}");
  </script>
@endif

<script>
  window.onLoad = function() {
    var screenSize = window.innerWidth;

    fetch("/user/option", {
      method: "GET", // Bisa menggunakan POST jika perlu
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify({
        screen_size: screenSize
      })
    });
  }

  // Configuration Constants
  const CONFIG = {
    API_ENDPOINTS: {
      CHECK_CODE: '/user/pengembalian/check'
    },
    MODAL_FOCUS_DELAY: 200,
    ERROR_MESSAGES: {
      EMPTY_CODE: 'Kode peminjaman tidak boleh kosong!',
      SERVER_ERROR: 'Terjadi kesalahan: Tidak dapat terhubung ke server.',
      CAMERA_ERROR: 'Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan atau masukkan kode secara manual.'
    }
  };

  // Utility Functions
  const Utils = {
    getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
    showError(errorElement, message) {
      if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
      }
    },
    hideError(errorElement) {
      if (errorElement) {
        errorElement.textContent = '';
        errorElement.classList.add('hidden');
      }
      const actionsEl = document.getElementById('already-returned-actions');
      if (actionsEl) {
        actionsEl.classList.add('hidden');
      }
    }
  };

  // Scan Modal Management
  const ScanModalManager = {
    elements: {
      modal: null,
      input: null,
      errorMessage: null,
      confirmButton: null,
      modalToggleButton: null,
      toastsuccess: null,
      btnStartCamera: null,
      btnStopCamera: null,
      cameraPlaceholder: null,
      cameraStatus: null
    },

    html5QrCode: null,
    isScanning: false,
    isProcessing: false,

    init() {
      // Cache DOM elements
      this.elements.modal = document.getElementById('scan-modal');
      this.elements.input = document.getElementById('code');
      this.elements.errorMessage = document.getElementById('error-message');
      this.elements.confirmButton = document.getElementById('confirm');
      this.elements.modalToggleButton = document.querySelector('[data-modal-toggle="scan-modal"]');
      this.elements.toastsuccess = document.getElementById('toast-success');
      this.elements.btnStartCamera = document.getElementById('btn-start-camera');
      this.elements.btnStopCamera = document.getElementById('btn-stop-camera');
      this.elements.cameraPlaceholder = document.getElementById('camera-placeholder');
      this.elements.cameraStatus = document.getElementById('camera-status');

      // Initialize error message
      Utils.hideError(this.elements.errorMessage);

      // Set up event listeners
      this.setupModalListeners();
      this.setupConfirmButtonListener();
      this.setupCameraListeners();
      this.setupLifecycleListeners();
    },

    setupModalListeners() {
      // Fallback for modal toggle
      if (this.elements.modalToggleButton) {
        this.elements.modalToggleButton.addEventListener('click', () => {
          Utils.hideError(this.elements.errorMessage);
          setTimeout(() => {
            this.focusInput();
          }, CONFIG.MODAL_FOCUS_DELAY);
        });
      }

      // Close buttons on modal
      const closeButtons = document.querySelectorAll('[data-modal-hide="scan-modal"]');
      closeButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
          this.stopCamera();
          Utils.hideError(this.elements.errorMessage);
        });
      });

      // Observe modal visibility changes to cleanly stop camera when closed
      if (this.elements.modal && window.MutationObserver) {
        const observer = new MutationObserver((mutations) => {
          mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
              if (this.elements.modal.classList.contains('hidden')) {
                this.stopCamera();
              }
            }
          });
        });
        observer.observe(this.elements.modal, { attributes: true });
      }
    },

    setupCameraListeners() {
      if (this.elements.btnStartCamera) {
        this.elements.btnStartCamera.addEventListener('click', () => {
          this.startCamera();
        });
      }

      if (this.elements.btnStopCamera) {
        this.elements.btnStopCamera.addEventListener('click', () => {
          this.stopCamera();
        });
      }
    },

    setupLifecycleListeners() {
      window.addEventListener('beforeunload', () => {
        this.stopCameraSync();
      });

      window.addEventListener('pagehide', () => {
        this.stopCameraSync();
      });
    },

    focusInput() {
      if (this.elements.input) {
        this.elements.input.focus();
      }
    },

    setupConfirmButtonListener() {
      if (this.elements.confirmButton) {
        this.elements.confirmButton.addEventListener('click', () => {
          this.handleCodeConfirmation();
        });
      }

      if (this.elements.input) {
        this.elements.input.addEventListener('input', () => {
          Utils.hideError(this.elements.errorMessage);
        });

        this.elements.input.addEventListener('keydown', (e) => {
          if (e.key === 'Enter') {
            e.preventDefault();
            this.handleCodeConfirmation();
          }
        });
      }
    },

    cleanScannedString(raw) {
      if (!raw || typeof raw !== 'string') return '';
      let cleaned = raw.trim().replace(/[\u0000-\u001F\u007F]+/g, '').replace(/\s+/g, ' ');
      if (cleaned.includes('kode=')) {
        const match = cleaned.match(/kode=([^&]+)/);
        if (match && match[1]) {
          return decodeURIComponent(match[1].trim());
        }
      }
      if (cleaned.includes('/')) {
        const parts = cleaned.split('/');
        cleaned = parts.pop() || parts.pop();
        if (cleaned && cleaned.includes('?')) {
          cleaned = cleaned.split('?')[0];
        }
      }
      return cleaned ? decodeURIComponent(cleaned.trim()) : '';
    },

    setCameraStatus(text) {
      if (this.elements.cameraStatus) {
        this.elements.cameraStatus.textContent = text || '';
      }
    },

    async startCamera() {
      if (this.isScanning) return;

      Utils.hideError(this.elements.errorMessage);
      this.setCameraStatus('Menghubungkan ke kamera...');

      // Toggle tombol UI
      if (this.elements.btnStartCamera) this.elements.btnStartCamera.classList.add('hidden');
      if (this.elements.btnStopCamera) this.elements.btnStopCamera.classList.remove('hidden');
      if (this.elements.cameraPlaceholder) this.elements.cameraPlaceholder.classList.add('hidden');

      if (!this.html5QrCode) {
        const formats = (typeof Html5QrcodeSupportedFormats !== 'undefined')
          ? [Html5QrcodeSupportedFormats.QR_CODE]
          : [0];
        this.html5QrCode = new Html5Qrcode('reader-transaction', {
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
          const size = Math.max(160, Math.floor(minEdge * 0.75));
          return {
            width: Math.min(size, viewfinderWidth),
            height: Math.min(size, viewfinderHeight)
          };
        },
        aspectRatio: 1.0
      };

      try {
        await this.html5QrCode.start(
          { facingMode: 'environment' },
          qrConfig,
          (decodedText) => {
            this.handleScanSuccess(decodedText);
          },
          (errorMessage) => {
            // Abaikan frame miss
          }
        );
        this.setCameraStatus('Arahkan kamera ke QR transaksi (PMB-...)');
      } catch (err) {
        console.error('Gagal membuka kamera:', err);
        await this.stopCamera();
        Utils.showError(this.elements.errorMessage, CONFIG.ERROR_MESSAGES.CAMERA_ERROR);
      }
    },

    async stopCamera() {
      if (this.html5QrCode && this.isScanning) {
        try {
          await this.html5QrCode.stop();
          this.html5QrCode.clear();
        } catch (e) {
          console.warn('Gagal menghentikan scanner:', e);
          try { this.html5QrCode.clear(); } catch (_) {}
        }
      }
      this.isScanning = false;
      this.resetCameraUI();
    },

    stopCameraSync() {
      if (this.html5QrCode && this.isScanning) {
        try {
          this.html5QrCode.stop();
          this.html5QrCode.clear();
        } catch (_) {}
        this.isScanning = false;
      }
    },

    resetCameraUI() {
      if (this.elements.btnStartCamera) this.elements.btnStartCamera.classList.remove('hidden');
      if (this.elements.btnStopCamera) this.elements.btnStopCamera.classList.add('hidden');
      if (this.elements.cameraPlaceholder) this.elements.cameraPlaceholder.classList.remove('hidden');
      this.setCameraStatus('');
    },

    async handleScanSuccess(rawMessage) {
      // Pastikan satu hasil scan hanya memicu satu permintaan validasi
      if (this.isProcessing) return;
      this.isProcessing = true;

      // Jeda scanning secepat mungkin sebelum frame berikutnya di-decode
      if (this.html5QrCode && this.isScanning) {
        try {
          this.html5QrCode.pause(true);
        } catch (_) {}
      }

      const code = this.cleanScannedString(rawMessage);
      if (!code) {
        this.isProcessing = false;
        if (this.html5QrCode && this.isScanning) {
          try { this.html5QrCode.resume(); } catch (_) {}
        }
        return;
      }

      this.setCameraStatus(`QR terbaca: ${code}. Memvalidasi...`);

      if (this.elements.input) {
        this.elements.input.value = code;
      }

      await this.validateCode(code, true);
    },

    handleCodeConfirmation() {
      Utils.hideError(this.elements.errorMessage);

      const code = this.elements.input ? this.elements.input.value.trim() : '';

      if (!code) {
        Utils.showError(this.elements.errorMessage, CONFIG.ERROR_MESSAGES.EMPTY_CODE);
        return;
      }

      this.validateCode(code, false);
    },

    async validateCode(code, fromCamera = false) {
      try {
        const response = await fetch(CONFIG.API_ENDPOINTS.CHECK_CODE, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': Utils.getCsrfToken()
          },
          body: JSON.stringify({ code })
        });

        const data = await response.json();
        await this.handleValidationResponse(data, fromCamera);
      } catch (error) {
        this.handleValidationError(error);
      }
    },

    async handleValidationResponse(data, fromCamera = false) {
      if (data.success) {
        // Hentikan kamera sebelum navigasi
        await this.stopCamera();

        // Tampilkan toast success
        if (this.elements.toastsuccess) {
          this.elements.toastsuccess.classList.remove('hidden');
        }

        setTimeout(() => {
          window.location.href = "{{ route('user.pengembalian.index') }}";
        }, 1200);
      } else {
        // Validasi gagal
        Utils.showError(
          this.elements.errorMessage,
          data.message || 'Kode transaksi tidak ditemukan atau sudah selesai.'
        );

        const actionsEl = document.getElementById('already-returned-actions');
        const viewBtn = document.getElementById('btn-view-proof');
        const printBtn = document.getElementById('btn-print-proof');

        if (data.already_returned && data.data) {
          if (viewBtn && data.data.report_url) {
            viewBtn.href = data.data.report_url;
          }
          if (printBtn && data.data.pdf_url) {
            printBtn.href = data.data.pdf_url;
          }
          if (actionsEl) {
            actionsEl.classList.remove('hidden');
          }
        } else {
          if (actionsEl) {
            actionsEl.classList.add('hidden');
          }
        }

        if (fromCamera) {
          this.setCameraStatus(data.message || 'Validasi gagal. Coba lagi atau gunakan input manual.');
          if (data.already_returned) {
            this.stopCamera();
            this.isProcessing = false;
          } else {
            // Lanjutkan scanner jika masih aktif
            if (this.html5QrCode && this.isScanning) {
              try {
                this.html5QrCode.resume();
              } catch (_) {}
            }
            setTimeout(() => {
              this.isProcessing = false;
              if (this.isScanning) {
                this.setCameraStatus('Arahkan kamera ke QR transaksi (PMB-...)');
              }
            }, 1500);
          }
        } else {
          this.isProcessing = false;
        }
      }
    },

    handleValidationError(error) {
      console.error('Error validasi:', error);
      Utils.showError(this.elements.errorMessage, CONFIG.ERROR_MESSAGES.SERVER_ERROR);
      this.isProcessing = false;
      this.setCameraStatus('Terjadi kesalahan koneksi.');
      if (this.html5QrCode && this.isScanning) {
        try {
          this.html5QrCode.resume();
        } catch (_) {}
      }
    }
  };

  // Initialize on DOM Load
  document.addEventListener('DOMContentLoaded', () => {
    ScanModalManager.init();
  });
</script>

</html>