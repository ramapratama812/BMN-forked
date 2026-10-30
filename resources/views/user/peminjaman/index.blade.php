@extends('layouts.user.main')

@section('title', 'Peminjaman')

@section('content')
@php
  use Carbon\Carbon;
  Carbon::setLocale('id');
  $activeTab = request('tab', 'peminjaman');
  if (request()->has('search_riwayat') || request()->has('status_riwayat') || request()->has('peruntukan_riwayat') || request()->has('page')) {
      $activeTab = 'riwayat';
  }
@endphp

  <div class="mt-2">

    {{-- profil --}}
    <x-peminjam-profile></x-peminjam-profile>

    {{-- Tab Navigation Bar --}}
    <div class="mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-1.5 flex flex-wrap gap-2">
      <button type="button" id="tab-btn-peminjaman" onclick="TabManager.showTab('peminjaman')"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none {{ $activeTab === 'peminjaman' ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-700' }}">
        <i class="fa-solid fa-file-signature mr-2"></i> Peminjaman Barang
      </button>
      <button type="button" id="tab-btn-riwayat" onclick="TabManager.showTab('riwayat')"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none {{ $activeTab === 'riwayat' ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-700' }}">
        <i class="fa-solid fa-clock-rotate-left mr-2"></i> Riwayat Peminjaman
        @if (isset($totalRiwayatCount) && $totalRiwayatCount > 0)
          <span id="badge-total-riwayat" class="ms-2 px-2 py-0.5 text-xs font-semibold rounded-full {{ $activeTab === 'riwayat' ? 'bg-white text-blue-800' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }}">
            {{ $totalRiwayatCount }}
          </span>
        @endif
      </button>
    </div>

    {{-- PANEL 1: Formulir Peminjaman Barang --}}
    <div id="tab-panel-peminjaman" class="{{ $activeTab === 'peminjaman' ? '' : 'hidden' }}">
      <div class="overflow-x-auto shadow-md sm:rounded-lg">

        {{-- input data --}}
        <div class="relative overflow-auto bg-white dark:bg-gray-800 sm:rounded-lg">
      <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
        <div class="w-full md:w-1/2">
          <form class="col-span-1" id="form">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-400"></i>
              </div>
              <input type="text" id="nomor-surat" name="nomor_surat"
                class="w-full pl-10 p-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-70 dark:text-white"
                placeholder="Masukkan Surat Tugas">
              @error('nomor_surat')
                <small class="text-red-500 text-sm"> {{ $message }}</small>
              @enderror
            </div>
          </form>
        </div>
        <div
          class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
          <div class="flex items-center w-full space-x-3 md:w-auto">
            <div id="date-range-picker" class="flex items-center">
              <small class="mx-4 text-gray-500">Dari</small>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </div>
                <input id="tanggal-penggunaan" name="start" type="date" readonly
                  class="w-full pl-10 p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                  placeholder="Tanggal peminjaman" />
              </div>
              <small class="mx-4 text-gray-500">Sampai</small>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </div>
                <input id="tanggal-kembali" name="end" type="date"
                  class="w-full pl-10 p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                  placeholder="Tanggal pengembalian" onclick="this.showPicker();" />
              </div>
            </div>

            {{-- peruntukan --}}
            <div>
              <select id="peruntukan" name="peruntukan"
                class="w-full p-2 text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                <option value="" selected>-- Pilih Peruntukan --</option>
                @foreach ($peruntukanData as $peruntukan)
                  <option value="{{ $peruntukan->id }}">{{ $peruntukan->peruntukan }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Pencarian & Pemilihan Barang Inventaris --}}
    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t border-b border-gray-200 dark:border-gray-700">
      <div class="mb-2">
        <label for="search-barang-input" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-1">
          <i class="fa-solid fa-boxes-stacked mr-1 text-blue-600"></i> Cari & Pilih Barang dari Database
        </label>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="text" id="search-barang-input"
              class="w-full pl-10 p-2.5 text-sm border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
              placeholder="Ketik nama barang, kode barang, nomor seri, merk, atau ruangan..." autocomplete="off">
          </div>
          <div class="flex gap-2">
            <button type="button" id="btn-search-barang"
              class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
              <i class="fa-solid fa-search mr-2"></i> Cari
            </button>
            <button type="button" id="btn-reset-search"
              class="inline-flex items-center justify-center px-3 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 focus:outline-none">
              Reset
            </button>
          </div>
        </div>
      </div>

      {{-- Kontainer Hasil Pencarian --}}
      <div id="search-results-container" class="hidden mt-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700/60 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center text-xs text-gray-600 dark:text-gray-300 font-medium">
          <span>Hasil Pencarian</span>
          <span id="search-results-count"></span>
        </div>
        <div id="search-results-list" class="max-h-64 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
          {{-- Item diisi via JavaScript --}}
        </div>
      </div>
    </div>

    {{-- list barang peminjaman --}}
    <div class="p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 flex items-center">
        <i class="fa-solid fa-cart-flatbed mr-2 text-blue-600"></i> Daftar Barang yang Dipilih untuk Dipinjam
      </h3>
    </div>
    <div class="max-h-72 overflow-y-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="p-4">
              No
            </th>
            <th scope="col" class="px-6 py-3">
              Nama Barang
            </th>
            <th scope="col" class="px-6 py-3">
              Merk
            </th>
            <th scope="col" class="px-6 py-3">
              No Seri
            </th>
            <th scope="col" class="px-6 py-3">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          @if (session('borrowed_items'))
            @foreach (session('borrowed_items') as $index => $item)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                data-item-id="{{ $item['uuid'] }}" id="item-{{ $item['uuid'] }}">
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <p>{{ $index + 1 }}</p>
                  </div>
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                  <div class="ps-2">
                    <div class="text-base font-semibold">{{ $item['name'] }}</div>
                  </div>
                </th>
                <td class="px-6 py-4">
                  {{ $item['merk'] }}
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center">
                    {{ $item['serial_number'] }}
                  </div>
                </td>
                <td class="px-6 py-4">
                  <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-uuid="{{ $item['uuid'] }}"
                    class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:underline">
                    <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>

      </div>

      {{-- button peminjaman --}}
      <div class="flex justify-center space-x-2 mt-4 mb-16">
        <a href="{{ route('user.option') }}">
          <button type="button"
            class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Kembali
          </button>
        </a>
        <button data-modal-target="save-modal" data-modal-toggle="save-modal" type="button"
          class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          Simpan
        </button>
      </div>
    </div>

    {{-- PANEL 2: Riwayat Peminjaman Barang --}}
    <div id="tab-panel-riwayat" class="{{ $activeTab === 'riwayat' ? '' : 'hidden' }}">
      <div class="overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-gray-800 mb-16">

        {{-- Ringkasan Metrik Riwayat --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 p-4 bg-gray-50 dark:bg-gray-700/40 border-b border-gray-200 dark:border-gray-700">
          <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm flex items-center justify-between">
            <div>
              <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Transaksi</p>
              <p class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">{{ $totalRiwayatCount ?? 0 }}</p>
            </div>
            <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300 flex items-center justify-center">
              <i class="fa-solid fa-list-check"></i>
            </div>
          </div>

          <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm flex items-center justify-between">
            <div>
              <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Masih Dipinjam</p>
              <p class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">{{ $aktifCount ?? 0 }}</p>
            </div>
            <div class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 flex items-center justify-center">
              <i class="fa-solid fa-clock"></i>
            </div>
          </div>

          <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm flex items-center justify-between">
            <div>
              <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">Kembali Sebagian</p>
              <p class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">{{ $sebagianCount ?? 0 }}</p>
            </div>
            <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300 flex items-center justify-center">
              <i class="fa-solid fa-hourglass-half"></i>
            </div>
          </div>

          <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm flex items-center justify-between">
            <div>
              <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Selesai</p>
              <p class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">{{ $selesaiCount ?? 0 }}</p>
            </div>
            <div class="w-9 h-9 rounded-lg bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-300 flex items-center justify-center">
              <i class="fa-solid fa-circle-check"></i>
            </div>
          </div>
        </div>

        {{-- Filter & Pencarian Riwayat --}}
        <div class="p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
          <form method="GET" action="{{ route('user.peminjaman.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
            <input type="hidden" name="tab" value="riwayat">

            <div class="relative flex-1">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
              </div>
              <input type="text" name="search_riwayat" value="{{ request('search_riwayat') }}"
                class="w-full pl-10 p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Cari nomor surat, kode transaksi, nomor peminjaman, atau nama barang...">
            </div>

            <div class="w-full md:w-48">
              <select name="status_riwayat"
                class="w-full p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">-- Semua Status --</option>
                <option value="Masih Dipinjam" {{ request('status_riwayat') === 'Masih Dipinjam' ? 'selected' : '' }}>Masih Dipinjam</option>
                <option value="Dikembalikan Sebagian" {{ request('status_riwayat') === 'Dikembalikan Sebagian' ? 'selected' : '' }}>Dikembalikan Sebagian</option>
                <option value="Selesai" {{ request('status_riwayat') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
              </select>
            </div>

            <div class="w-full md:w-48">
              <select name="peruntukan_riwayat"
                class="w-full p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">-- Semua Peruntukan --</option>
                @foreach ($peruntukanData as $prt)
                  <option value="{{ $prt->id }}" {{ request('peruntukan_riwayat') == $prt->id ? 'selected' : '' }}>
                    {{ $prt->peruntukan }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="flex flex-wrap items-center gap-2">
              <button type="submit"
                class="px-4 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-filter"></i> Filter
              </button>
              @if (request()->has('search_riwayat') || request()->has('status_riwayat') || request()->has('peruntukan_riwayat'))
                <a href="{{ route('user.peminjaman.index', ['tab' => 'riwayat']) }}"
                  class="px-3 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600 flex items-center justify-center"
                  title="Reset Filter">
                  <i class="fa-solid fa-rotate-left"></i>
                </a>
              @endif
              <a href="{{ route('user.peminjaman.riwayat.pdf', request()->only(['search_riwayat', 'status_riwayat', 'peruntukan_riwayat'])) }}" target="_blank"
                id="btn-unduh-semua-riwayat"
                class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg focus:ring-4 focus:ring-emerald-300 dark:bg-emerald-600 dark:hover:bg-emerald-700 flex items-center justify-center gap-1.5 whitespace-nowrap shadow-sm"
                title="Unduh seluruh riwayat peminjaman dalam format PDF (sesuai filter aktif)">
                <i class="fa-solid fa-file-pdf"></i> Unduh Semua Riwayat
              </a>
            </div>
          </form>
        </div>

        {{-- Tabel Riwayat Peminjaman --}}
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-4 py-3 text-center w-12">No</th>
                <th scope="col" class="px-4 py-3">Transaksi / Surat</th>
                <th scope="col" class="px-4 py-3">Waktu</th>
                <th scope="col" class="px-4 py-3">Barang Dipinjam</th>
                <th scope="col" class="px-4 py-3 text-center">Status Transaksi</th>
                <th scope="col" class="px-4 py-3">Status Pengembalian</th>
                <th scope="col" class="px-4 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse ($riwayatPeminjaman as $index => $row)
                @php
                  $statusReal = $row->computed_status;
                  $returnMap = $row->return_details_map;
                  $totalItems = $row->detailPeminjaman->count();
                  $totalReturned = count($returnMap);

                  // Deteksi kondisi barang yang sudah kembali
                  $hasDamaged = false;
                  $hasLost = false;
                  foreach ($returnMap as $retInfo) {
                      if (($retInfo['status'] ?? '') === 'rusak') $hasDamaged = true;
                      if (($retInfo['status'] ?? '') === 'hilang') $hasLost = true;
                  }
                @endphp
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                  <td class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white">
                    {{ $riwayatPeminjaman->firstItem() + $index }}
                  </td>

                  <td class="px-4 py-3">
                    <div class="font-semibold text-gray-900 dark:text-white text-sm">
                      {{ $row->nomor_surat ?: '-' }}
                    </div>
                    <div class="text-xs font-mono text-blue-600 dark:text-blue-400 mt-0.5">
                      {{ $row->kode_peminjaman }}
                    </div>
                    <div class="text-[11px] text-gray-500 dark:text-gray-400 flex items-center gap-2 mt-0.5">
                      <span>{{ $row->nomor_peminjaman }}</span>
                      <span>•</span>
                      <span class="font-medium text-gray-700 dark:text-gray-300">{{ $row->peruntukan->peruntukan ?? '-' }}</span>
                    </div>
                  </td>

                  <td class="px-4 py-3 whitespace-nowrap">
                    <div class="text-xs text-gray-900 dark:text-white">
                      <span class="text-gray-500 dark:text-gray-400 font-medium">Pinjam:</span> {{ !empty($row->tanggal_peminjaman) ? Carbon::parse($row->tanggal_peminjaman)->locale('id')->translatedFormat('d M Y') : '-' }}
                    </div>
                    <div class="text-xs text-gray-900 dark:text-white mt-1">
                      <span class="text-gray-500 dark:text-gray-400 font-medium">Batas Kembali:</span> {{ !empty($row->tanggal_kembali) ? Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d M Y') : '-' }}
                    </div>
                  </td>

                  <td class="px-4 py-3">
                    <div class="flex items-center gap-1.5 mb-1">
                      <span class="px-2 py-0.5 text-xs font-bold rounded bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300">
                        {{ $totalItems }} Barang
                      </span>
                    </div>
                    <div class="text-xs text-gray-700 dark:text-gray-300 space-y-0.5">
                      @foreach ($row->detailPeminjaman->take(2) as $det)
                        <div class="truncate max-w-xs" title="{{ $det->barang->nama_barang ?? $det->kode_barang }}">
                          • {{ $det->barang->nama_barang ?? $det->kode_barang }}
                        </div>
                      @endforeach
                      @if ($totalItems > 2)
                        <div class="text-[11px] text-gray-500 dark:text-gray-400 italic">
                          +{{ $totalItems - 2 }} barang lainnya...
                        </div>
                      @endif
                    </div>
                  </td>

                  <td class="px-4 py-3 text-center whitespace-nowrap">
                    @if ($statusReal === 'Selesai')
                      <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700">
                        <i class="fa-solid fa-circle-check mr-1.5"></i> Selesai
                      </span>
                    @elseif ($statusReal === 'Dikembalikan Sebagian')
                      <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-300 dark:border-blue-700">
                        <i class="fa-solid fa-hourglass-half mr-1.5"></i> Dikembalikan Sebagian
                      </span>
                    @else
                      <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-300 dark:border-amber-700">
                        <i class="fa-solid fa-clock mr-1.5"></i> Masih Dipinjam
                      </span>
                    @endif
                  </td>

                  <td class="px-4 py-3">
                    @if ($totalReturned === 0)
                      <span class="text-xs text-gray-400 italic flex items-center gap-1">
                        <i class="fa-solid fa-circle-minus text-gray-300"></i> Belum ada pengembalian
                      </span>
                    @else
                      <div class="text-xs font-medium text-gray-900 dark:text-white">
                        {{ $totalReturned }} dari {{ $totalItems }} kembali
                      </div>
                      <div class="flex flex-wrap items-center gap-1.5 mt-1">
                        @if ($hasDamaged)
                          <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Ada Rusak
                          </span>
                        @endif
                        @if ($hasLost)
                          <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                            <i class="fa-solid fa-circle-question mr-1"></i> Ada Hilang
                          </span>
                        @endif
                        @if (!$hasDamaged && !$hasLost)
                          <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                            <i class="fa-solid fa-check mr-1"></i> Kondisi Baik
                          </span>
                        @endif
                      </div>
                    @endif
                  </td>

                  <td class="px-4 py-3 text-center whitespace-nowrap">
                    <div class="flex items-center justify-center gap-1.5">
                      <button type="button" data-modal-target="modal-detail-{{ $row->uuid }}" data-modal-toggle="modal-detail-{{ $row->uuid }}"
                        class="px-2.5 py-1.5 text-xs font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 inline-flex items-center gap-1"
                        title="Lihat Detail Transaksi">
                        <i class="fa-solid fa-circle-info"></i> Detail
                      </button>

                      <a href="{{ route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $row->kode_peminjaman]) }}" target="_blank"
                        class="px-2.5 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg dark:bg-red-600 dark:hover:bg-red-700 inline-flex items-center gap-1 shadow-sm"
                        title="Unduh PDF Riwayat Transaksi {{ $row->kode_peminjaman }}">
                        <i class="fa-solid fa-file-pdf"></i> Unduh PDF
                      </a>

                      <a href="{{ route('user.peminjaman.pdf', ['kode_peminjaman' => $row->kode_peminjaman]) }}" target="_blank"
                        class="px-2.5 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 inline-flex items-center gap-1"
                        title="Unduh PDF Dokumen Peminjaman">
                        <i class="fa-solid fa-file-lines text-blue-600"></i> Surat
                      </a>

                      @if ($totalReturned > 0)
                        @php
                          $latestPengembalian = $row->pengembalian->sortByDesc('created_at')->first();
                        @endphp
                        <a href="{{ route('user.pengembalian.report', ['kode_pengembalian' => $latestPengembalian?->kode_pengembalian, 'kode_peminjaman' => $row->kode_peminjaman]) }}"
                          class="px-2.5 py-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 rounded-lg dark:bg-emerald-900/30 dark:text-emerald-300 dark:border-emerald-700 dark:hover:bg-emerald-900/50 inline-flex items-center gap-1"
                          title="Lihat Bukti Pengembalian E20">
                          <i class="fa-solid fa-receipt"></i> Bukti
                        </a>
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                    <div class="max-w-sm mx-auto flex flex-col items-center">
                      <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 mb-3">
                        <i class="fa-solid fa-box-open text-2xl"></i>
                      </div>
                      <h4 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Belum Ada Riwayat Peminjaman</h4>
                      <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                        {{ request()->has('search_riwayat') || request()->has('status_riwayat') || request()->has('peruntukan_riwayat') ? 'Tidak ada transaksi peminjaman yang cocok dengan kriteria pencarian.' : 'Anda belum memiliki transaksi peminjaman barang di sistem.' }}
                      </p>
                      @if (request()->has('search_riwayat') || request()->has('status_riwayat') || request()->has('peruntukan_riwayat'))
                        <a href="{{ route('user.peminjaman.index', ['tab' => 'riwayat']) }}"
                          class="px-4 py-2 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200">
                          Reset Filter Pencarian
                        </a>
                      @else
                        <button type="button" onclick="TabManager.showTab('peminjaman')"
                          class="px-4 py-2 text-xs font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg">
                          <i class="fa-solid fa-plus mr-1"></i> Mulai Peminjaman Barang
                        </button>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Navigasi Paginasi --}}
        @if ($riwayatPeminjaman->hasPages())
          <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            {{ $riwayatPeminjaman->links() }}
          </div>
        @endif

      </div>

      {{-- Tombol Bawah Riwayat --}}
      <div class="flex justify-center space-x-2 mt-4 mb-16">
        <a href="{{ route('user.option') }}">
          <button type="button"
            class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Kembali ke Menu
          </button>
        </a>
        <button type="button" onclick="TabManager.showTab('peminjaman')"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
          <i class="fa-solid fa-plus mr-1"></i> Peminjaman Baru
        </button>
      </div>
    </div>

    {{-- MODAL DETAIL SETIAP TRANSAKSI RIWAYAT --}}
    @foreach ($riwayatPeminjaman as $row)
      @php
        $statusReal = $row->computed_status;
        $returnMap = $row->return_details_map;
        $totalItems = $row->detailPeminjaman->count();
        $totalReturned = count($returnMap);
      @endphp
      <div id="modal-detail-{{ $row->uuid }}" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-black bg-opacity-50">
        <div class="relative w-full max-w-4xl max-h-full">
          <div class="relative bg-white rounded-xl shadow-xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 flex items-center justify-center text-lg">
                  <i class="fa-solid fa-receipt"></i>
                </div>
                <div>
                  <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    Detail Peminjaman {{ $row->nomor_peminjaman }}
                    @if ($statusReal === 'Selesai')
                      <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-300">
                        Selesai
                      </span>
                    @elseif ($statusReal === 'Dikembalikan Sebagian')
                      <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-300">
                        Dikembalikan Sebagian
                      </span>
                    @else
                      <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-300">
                        Masih Dipinjam
                      </span>
                    @endif
                  </h3>
                  <p class="text-xs font-mono text-gray-500 dark:text-gray-400 mt-0.5">
                    Kode Transaksi: {{ $row->kode_peminjaman }}
                  </p>
                </div>
              </div>
              <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="modal-detail-{{ $row->uuid }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Tutup</span>
              </button>
            </div>

            {{-- Body --}}
            <div class="p-4 md:p-6 space-y-4 max-h-[70vh] overflow-y-auto">
              {{-- Info Utama --}}
              <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3.5 bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-200 dark:border-gray-700 text-xs">
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Surat Tugas:</span>
                  <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ $row->nomor_surat }}</span>
                </div>
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Peruntukan:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ $row->peruntukan->peruntukan ?? '-' }}</span>
                </div>
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Peminjam:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ $row->peminjam }}</span>
                </div>
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Tgl. Penggunaan:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ !empty($row->tanggal_penggunaan) ? Carbon::parse($row->tanggal_penggunaan)->locale('id')->translatedFormat('d F Y') : '-' }}</span>
                </div>
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Tanggal Peminjaman:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ !empty($row->tanggal_peminjaman) ? Carbon::parse($row->tanggal_peminjaman)->locale('id')->translatedFormat('d F Y H:i') : '-' }}</span>
                </div>
                <div>
                  <span class="text-gray-500 dark:text-gray-400 block font-medium">Batas Pengembalian:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ !empty($row->tanggal_kembali) ? Carbon::parse($row->tanggal_kembali)->locale('id')->translatedFormat('d F Y') : '-' }}</span>
                </div>
              </div>

              {{-- Rincian Barang --}}
              <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                  <i class="fa-solid fa-boxes-stacked text-blue-600"></i> Rincian Barang & Status Pengembalian
                </h4>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                  <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-[11px] text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                      <tr>
                        <th scope="col" class="px-3 py-2.5 text-center w-8">No</th>
                        <th scope="col" class="px-3 py-2.5">Nama & Kode Barang</th>
                        <th scope="col" class="px-3 py-2.5">Merk / Nomor Seri</th>
                        <th scope="col" class="px-3 py-2.5 text-center">Status Pengembalian</th>
                        <th scope="col" class="px-3 py-2.5">Keterangan / Kondisi</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                      @foreach ($row->detailPeminjaman as $idx => $detail)
                        @php
                          $ret = $returnMap[$detail->kode_barang] ?? null;
                          $bmnItem = $detail->barang->bmnBarang ?? null;
                        @endphp
                        <tr class="bg-white dark:bg-gray-800">
                          <td class="px-3 py-2.5 text-center font-medium">{{ $idx + 1 }}</td>
                          <td class="px-3 py-2.5">
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $detail->barang->nama_barang ?? '-' }}</div>
                            <div class="font-mono text-gray-500 text-[11px]">{{ $detail->kode_barang }}</div>
                          </td>
                          <td class="px-3 py-2.5">
                            <div>{{ $detail->barang->merk ?? '-' }}</div>
                            <div class="text-[11px] text-gray-500 font-mono">{{ $detail->barang->nomor_seri ?? '-' }}</div>
                          </td>
                          <td class="px-3 py-2.5 text-center whitespace-nowrap">
                            @if ($ret)
                              <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                <i class="fa-solid fa-check mr-1"></i> Sudah Kembali
                              </span>
                              <div class="text-[10px] text-gray-500 mt-0.5">
                                {{ !empty($ret['tanggal_kembali']) ? Carbon::parse($ret['tanggal_kembali'])->locale('id')->translatedFormat('d M Y') : '-' }}
                              </div>
                            @else
                              <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                <i class="fa-solid fa-clock mr-1"></i> Belum Kembali
                              </span>
                            @endif
                          </td>
                          <td class="px-3 py-2.5">
                            @if ($ret)
                              <div class="flex items-center gap-1.5">
                                @if ($ret['status'] === 'rusak')
                                  <span class="px-1.5 py-0.5 text-[11px] font-bold rounded bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">
                                    <i class="fa-solid fa-triangle-exclamation mr-1"></i> Rusak
                                  </span>
                                @elseif ($ret['status'] === 'hilang')
                                  <span class="px-1.5 py-0.5 text-[11px] font-bold rounded bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                    <i class="fa-solid fa-circle-question mr-1"></i> Hilang
                                  </span>
                                @else
                                  <span class="px-1.5 py-0.5 text-[11px] font-bold rounded bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                    <i class="fa-solid fa-circle-check mr-1"></i> Baik
                                  </span>
                                @endif
                              </div>
                              @if (!empty($ret['deskripsi']))
                                <div class="text-[11px] text-gray-600 dark:text-gray-300 mt-1 italic">
                                  "{{ $ret['deskripsi'] }}"
                                </div>
                              @endif

                              {{-- Trace Riwayat Kerusakan & Perawatan Inventaris --}}
                              @if ($ret['status'] === 'rusak' && $bmnItem)
                                @if ($bmnItem->perawatanAktif)
                                  <div class="mt-1.5 p-1.5 rounded bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-[11px] text-blue-800 dark:text-blue-300">
                                    <i class="fa-solid fa-wrench mr-1"></i> <strong>Antrean Perawatan:</strong> Status <em>{{ ucfirst($bmnItem->perawatanAktif->status) }}</em> ({{ $bmnItem->perawatanAktif->jenis_perawatan }})
                                  </div>
                                @elseif ($bmnItem->perawatanInventaris && $bmnItem->perawatanInventaris->isNotEmpty())
                                  @php $lastPerawatan = $bmnItem->perawatanInventaris->last(); @endphp
                                  <div class="mt-1.5 p-1.5 rounded bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-[11px] text-emerald-800 dark:text-emerald-300">
                                    <i class="fa-solid fa-circle-check mr-1"></i> <strong>Perawatan Selesai:</strong> {{ ucfirst($lastPerawatan->status) }} (Terverifikasi Superadmin)
                                  </div>
                                @elseif ($bmnItem->laporanKerusakan && $bmnItem->laporanKerusakan->isNotEmpty())
                                  @php $lastLaporan = $bmnItem->laporanKerusakan->last(); @endphp
                                  <div class="mt-1.5 p-1.5 rounded bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 text-[11px] text-amber-800 dark:text-amber-300">
                                    <i class="fa-solid fa-file-circle-exclamation mr-1"></i> <strong>Laporan Kerusakan:</strong> Status <em>{{ ucfirst($lastLaporan->status) }}</em>
                                  </div>
                                @endif
                              @endif
                            @else
                              <span class="text-gray-400 italic">Sedang dalam penggunaan</span>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
              <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('user.peminjaman.riwayat.pdf', ['kode_peminjaman' => $row->kode_peminjaman]) }}" target="_blank"
                  class="px-4 py-2 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg inline-flex items-center gap-1.5 shadow-sm">
                  <i class="fa-solid fa-file-pdf"></i> Unduh PDF Riwayat
                </a>
                <a href="{{ route('user.peminjaman.pdf', ['kode_peminjaman' => $row->kode_peminjaman]) }}" target="_blank"
                  class="px-3 py-2 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg inline-flex items-center gap-1.5">
                  <i class="fa-solid fa-file-lines text-blue-600"></i> Surat Peminjaman
                </a>
                @if ($totalReturned > 0)
                  @php
                    $latestPengembalianModal = $row->pengembalian->sortByDesc('created_at')->first();
                  @endphp
                  <a href="{{ route('user.pengembalian.pdf', ['kode_pengembalian' => $latestPengembalianModal?->kode_pengembalian, 'kode_peminjaman' => $row->kode_peminjaman]) }}" target="_blank"
                    class="px-4 py-2 text-xs font-medium text-emerald-700 bg-white hover:bg-emerald-50 border border-emerald-300 rounded-lg inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-file-pdf"></i> Unduh PDF Pengembalian
                  </a>
                  <a href="{{ route('user.pengembalian.report', ['kode_pengembalian' => $latestPengembalianModal?->kode_pengembalian, 'kode_peminjaman' => $row->kode_peminjaman]) }}"
                    class="px-3 py-2 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-receipt"></i> Bukti Pengembalian E20
                  </a>
                @endif
              </div>
              <button type="button" data-modal-hide="modal-detail-{{ $row->uuid }}"
                class="py-2 px-4 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Tutup
              </button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <x-peminjaman-popup></x-peminjaman-popup>
  </div>

  <style>
    #loadingScreen {
      backdrop-filter: blur(4px);
      transition: opacity 0.3s ease-in-out;
    }
  </style>

  {{-- Loading Screen --}}
  <div id="loadingScreen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="text-center">
      <div class="w-16 h-16 border-4 border-t-blue-500 border-gray-300 rounded-full animate-spin mx-auto"></div>
      <p class="text-white mt-4 text-sm font-medium">Menyimpan data penggunaan...</p>
    </div>
  </div>

  <script>
    // Constants and Configuration
    const CONFIG = {
      API_ENDPOINTS: {
        SEARCH_ITEM: '/user/peminjaman/search-barang',
        ADD_ITEM: '/user/peminjaman/add-item',
        REMOVE_ITEM: '/user/peminjaman/remove/',
        STORE_LOAN: '/user/peminjaman/store'
      },
      TIMEOUT_DURATION: 2500
    };


    // Utility Functions
    const Utils = {
      getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      },
      formatDate(date) {
        return date.toISOString().split('T')[0];
      },
      escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;');
      },
      showToast(toastId, message) {
        const toast = document.getElementById(toastId);
        if (!toast) return;

        const textEl = toast.querySelector('.text-sm');
        if (textEl) {
          textEl.textContent = message;
        }
        toast.style.display = 'flex';
        toast.classList.remove('hidden');

        setTimeout(() => {
          toast.style.display = 'none';
          toast.classList.add('hidden');
        }, CONFIG.TIMEOUT_DURATION);
      }
    };

    // Modal Handling
    const ModalHandler = {
      init() {
        document.addEventListener('click', (e) => {
          const trigger = e.target.closest('[data-modal-toggle="popup-modal"]');
          if (trigger) {
            e.preventDefault();
            const uuid = trigger.getAttribute('data-uuid');
            const modalUuid = document.getElementById('modal-uuid');
            if (modalUuid && uuid) {
              modalUuid.value = uuid;
            }
            const modal = document.getElementById('popup-modal');
            if (modal) {
              modal.classList.remove('hidden');
              modal.classList.add('flex');
            }
          }

          const hideTrigger = e.target.closest('[data-modal-hide="popup-modal"]');
          if (hideTrigger) {
            const modal = document.getElementById('popup-modal');
            if (modal) {
              modal.classList.add('hidden');
              modal.classList.remove('flex');
            }
          }
        });
      },
      confirmDelete() {
        const uuid = document.getElementById('modal-uuid')?.value;
        if (uuid) {
          ItemManager.removeItem(uuid);
        }
        const modal = document.getElementById('popup-modal');
        if (modal) {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }
      }
    };

    // Item Management
    const ItemManager = {
      addItemToTable(item) {
        const tbody = document.querySelector('table tbody');
        const rowCount = tbody.children.length + 1;
        const tr = document.createElement('tr');

        const safeUuid = Utils.escapeHtml(item.uuid);
        const safeName = Utils.escapeHtml(item.name);
        const safeKode = Utils.escapeHtml(item.kode_barang || '');
        const safeMerk = Utils.escapeHtml(item.merk || '-');
        const safeSerial = Utils.escapeHtml(item.serial_number || '-');

        tr.className =
          'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
        tr.dataset.itemId = safeUuid;
        tr.id = `item-${safeUuid}`;
        tr.innerHTML = `
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <p>${rowCount}</p>
                        </div>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="ps-2">
                            <div class="text-base font-semibold">${safeName}</div>
                            <div class="font-normal text-xs text-gray-500">${safeKode}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">${safeMerk}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            ${safeSerial}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-uuid="${safeUuid}"
                            class="text-blue-600 dark:text-blue-500 hover:text-red-600 hover:underline">
                            <i class="fa-regular fa-trash-can fa-lg ml-3"></i>
                        </a>
                    </td>
                `;

        tbody.appendChild(tr);
        this.updateRowNumbers();
      },

      removeItem(uuid) {
        fetch(`${CONFIG.API_ENDPOINTS.REMOVE_ITEM}${uuid}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': Utils.getCsrfToken()
          }
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const tbody = document.querySelector('table tbody');
              const row = tbody.querySelector(`tr[data-item-id="${uuid}"]`);
              if (row) {
                tbody.removeChild(row);
                this.updateRowNumbers();
              }
              SearchManager.updateItemStateAfterRemoval(uuid);
            }
          })
          .catch(console.error);
      },
      updateRowNumbers() {
        const tbody = document.querySelector('table tbody');
        Array.from(tbody.children).forEach((row, index) => {
          row.querySelector('td p').textContent = index + 1;
        });
      }
    };

    // Search & Inventory Selection Manager
    const SearchManager = {
      debounceTimer: null,

      init() {
        const input = document.getElementById('search-barang-input');
        const btnSearch = document.getElementById('btn-search-barang');
        const btnReset = document.getElementById('btn-reset-search');

        if (!input) return;

        input.addEventListener('input', (e) => {
          clearTimeout(this.debounceTimer);
          const q = e.target.value.trim();
          if (q.length === 0) {
            this.hideResults();
            return;
          }
          this.debounceTimer = setTimeout(() => {
            this.performSearch(q);
          }, 350);
        });

        input.addEventListener('keydown', (e) => {
          if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(this.debounceTimer);
            const q = input.value.trim();
            if (q.length > 0) {
              this.performSearch(q);
            }
          }
        });

        if (btnSearch) {
          btnSearch.addEventListener('click', () => {
            clearTimeout(this.debounceTimer);
            const q = input.value.trim();
            if (q.length > 0) {
              this.performSearch(q);
            } else {
              input.focus();
            }
          });
        }

        if (btnReset) {
          btnReset.addEventListener('click', () => {
            input.value = '';
            this.hideResults();
          });
        }
      },

      hideResults() {
        const container = document.getElementById('search-results-container');
        if (container) container.classList.add('hidden');
      },

      showLoading() {
        const container = document.getElementById('search-results-container');
        const list = document.getElementById('search-results-list');
        const count = document.getElementById('search-results-count');

        if (container) container.classList.remove('hidden');
        if (count) count.textContent = 'Mencari...';
        if (list) {
          list.innerHTML = `
            <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center">
              <div class="w-4 h-4 border-2 border-t-blue-500 border-gray-300 rounded-full animate-spin mr-2"></div>
              Memuat data barang dari database...
            </div>
          `;
        }
      },

      async performSearch(query) {
        this.showLoading();

        try {
          const response = await fetch(`${CONFIG.API_ENDPOINTS.SEARCH_ITEM}?q=${encodeURIComponent(query)}`, {
            headers: {
              'Accept': 'application/json',
              'X-CSRF-TOKEN': Utils.getCsrfToken()
            }
          });

          if (!response.ok) {
            throw new Error('Gagal mengambil data pencarian');
          }

          const result = await response.json();
          this.renderResults(result.data || []);

        } catch (error) {
          console.error('Search error:', error);
          const list = document.getElementById('search-results-list');
          const count = document.getElementById('search-results-count');
          if (count) count.textContent = 'Error';
          if (list) {
            list.innerHTML = `
              <div class="p-4 text-center text-sm text-red-500">
                Terjadi kesalahan saat mencari barang. Silakan coba lagi.
              </div>
            `;
          }
        }
      },

      renderResults(items) {
        const container = document.getElementById('search-results-container');
        const list = document.getElementById('search-results-list');
        const count = document.getElementById('search-results-count');

        if (!container || !list) return;

        container.classList.remove('hidden');

        if (items.length === 0) {
          if (count) count.textContent = '0 barang';
          list.innerHTML = `
            <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
              Tidak ada barang ditemukan untuk kata kunci tersebut.
            </div>
          `;
          return;
        }

        if (count) count.textContent = `${items.length} barang ditemukan`;

        // Ambil daftar UUID yang saat ini sudah ada di tabel HTML
        const selectedUuids = Array.from(document.querySelectorAll('table tbody tr[data-item-id]'))
          .map(tr => tr.getAttribute('data-item-id'));

        let html = '';
        items.forEach(item => {
          const safeUuid = Utils.escapeHtml(item.uuid);
          const safeName = Utils.escapeHtml(item.nama_barang);
          const safeKode = Utils.escapeHtml(item.kode_barang);
          const safeMerk = Utils.escapeHtml(item.merk || '-');
          const safeSerial = Utils.escapeHtml(item.nomor_seri || '-');
          const safeRuangan = Utils.escapeHtml(item.ruangan || '-');

          const isSelected = selectedUuids.includes(item.uuid) || item.is_already_selected;
          const isAvailable = Boolean(item.is_available);

          let badgeStatus = '';
          if (!isAvailable) {
            badgeStatus = `<span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Tidak Tersedia</span>`;
          } else {
            const limitText = item.sisa_limit !== null && item.sisa_limit !== undefined ? ` (${Utils.escapeHtml(item.sisa_limit)})` : '';
            badgeStatus = `<span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Tersedia${limitText}</span>`;
          }

          let actionBtn = '';
          if (isSelected) {
            actionBtn = `
              <button type="button" disabled
                class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-400">
                <i class="fa-solid fa-check mr-1"></i> Sudah Dipilih
              </button>
            `;
          } else if (!isAvailable) {
            actionBtn = `
              <button type="button" disabled
                class="px-3 py-1.5 text-xs font-medium text-red-400 bg-red-50 border border-red-200 rounded-lg cursor-not-allowed dark:bg-gray-700">
                Tidak Dapat Dipinjam
              </button>
            `;
          } else {
            actionBtn = `
              <button type="button" onclick="SearchManager.selectItem('${safeUuid}')" id="btn-select-${safeUuid}"
                class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700">
                <i class="fa-solid fa-plus mr-1"></i> Pilih
              </button>
            `;
          }

          let unavailableNotice = '';
          if (!isAvailable && item.unavailable_reason) {
            let noticeColorClass = 'bg-amber-50 border-amber-200 text-amber-800 dark:bg-amber-900/30 dark:border-amber-800 dark:text-amber-300';
            let noticeIcon = 'fa-circle-exclamation';

            if (item.reason_type === 'damaged') {
              noticeColorClass = 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/30 dark:border-red-800 dark:text-red-300';
              noticeIcon = 'fa-triangle-exclamation';
            } else if (item.reason_type === 'maintenance') {
              noticeColorClass = 'bg-orange-50 border-orange-200 text-orange-800 dark:bg-orange-900/30 dark:border-orange-800 dark:text-orange-300';
              noticeIcon = 'fa-wrench';
            } else if (item.reason_type === 'all_borrowed') {
              noticeColorClass = 'bg-amber-50 border-amber-200 text-amber-800 dark:bg-amber-900/30 dark:border-amber-800 dark:text-amber-300';
              noticeIcon = 'fa-clock-rotate-left';
            } else if (item.reason_type === 'return_pending') {
              noticeColorClass = 'bg-amber-50 border-amber-200 text-amber-800 dark:bg-amber-900/30 dark:border-amber-800 dark:text-amber-300';
              noticeIcon = 'fa-hourglass-half';
            } else if (item.reason_type === 'out_of_stock') {
              noticeColorClass = 'bg-gray-100 border-gray-300 text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300';
              noticeIcon = 'fa-box-open';
            }

            unavailableNotice = `
              <div class="mt-2.5 flex items-start gap-2 p-2.5 rounded-lg border text-xs font-medium ${noticeColorClass}">
                <i class="fa-solid ${noticeIcon} mt-0.5 shrink-0"></i>
                <div class="flex-1">
                  <span>${Utils.escapeHtml(item.unavailable_reason)}</span>
                </div>
              </div>
            `;
          }

          html += `
            <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 flex flex-col justify-between gap-1" id="search-item-${safeUuid}">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex-1">
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <span class="font-semibold text-gray-900 dark:text-white text-sm">${safeName}</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">${safeKode}</span>
                    ${badgeStatus}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 flex flex-wrap gap-x-4">
                    <span><strong>Merk:</strong> ${safeMerk}</span>
                    <span><strong>No Seri:</strong> ${safeSerial}</span>
                    ${item.ruangan && item.ruangan !== '-' ? `<span><strong>Ruangan:</strong> ${safeRuangan}</span>` : ''}
                  </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                  ${actionBtn}
                </div>
              </div>
              ${unavailableNotice}
            </div>
          `;
        });

        list.innerHTML = html;
      },

      async selectItem(uuid) {
        const btn = document.getElementById(`btn-select-${uuid}`);
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memproses...`;
        }

        try {
          const response = await fetch(CONFIG.API_ENDPOINTS.ADD_ITEM, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': Utils.getCsrfToken()
            },
            body: JSON.stringify({ uuid })
          });

          const result = await response.json();

          if (response.ok && result.success) {
            ItemManager.addItemToTable(result.item);
            Utils.showToast('toast-success-add', result.message || 'Barang berhasil ditambahkan.');

            if (btn) {
              btn.className = 'px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-400';
              btn.innerHTML = `<i class="fa-solid fa-check mr-1"></i> Sudah Dipilih`;
              btn.disabled = true;
              btn.removeAttribute('onclick');
            }
          } else {
            Utils.showToast('toast-danger-2', result.message || 'Gagal menambahkan barang.');
            if (btn) {
              btn.disabled = false;
              btn.innerHTML = `<i class="fa-solid fa-plus mr-1"></i> Pilih`;
            }
          }

        } catch (error) {
          console.error('Select item error:', error);
          Utils.showToast('toast-danger-2', 'Terjadi kesalahan saat menambahkan barang.');
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = `<i class="fa-solid fa-plus mr-1"></i> Pilih`;
          }
        }
      },

      updateItemStateAfterRemoval(uuid) {
        const safeUuid = Utils.escapeHtml(uuid);
        const itemEl = document.getElementById(`search-item-${safeUuid}`);
        if (!itemEl) return;
        const btnContainer = itemEl.querySelector('.shrink-0');
        if (btnContainer) {
          btnContainer.innerHTML = `
            <button type="button" onclick="SearchManager.selectItem('${safeUuid}')" id="btn-select-${safeUuid}"
              class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700">
              <i class="fa-solid fa-plus mr-1"></i> Pilih
            </button>
          `;
        }
      }
    };

    // Tab Management
    const TabManager = {
      showTab(tabName) {
        const panelForm = document.getElementById('tab-panel-peminjaman');
        const panelHistory = document.getElementById('tab-panel-riwayat');
        const btnForm = document.getElementById('tab-btn-peminjaman');
        const btnHistory = document.getElementById('tab-btn-riwayat');

        if (!panelForm || !panelHistory) return;

        if (tabName === 'riwayat') {
          panelForm.classList.add('hidden');
          panelHistory.classList.remove('hidden');

          if (btnForm) btnForm.className = 'inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-700';
          if (btnHistory) btnHistory.className = 'inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none bg-blue-700 text-white shadow-sm';

          try {
            history.replaceState(null, '', '#riwayat');
          } catch (e) {}
        } else {
          panelHistory.classList.add('hidden');
          panelForm.classList.remove('hidden');

          if (btnForm) btnForm.className = 'inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none bg-blue-700 text-white shadow-sm';
          if (btnHistory) btnHistory.className = 'inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-700';

          try {
            history.replaceState(null, '', window.location.pathname);
          } catch (e) {}
        }
      },

      init() {
        const urlParams = new URLSearchParams(window.location.search);
        if (window.location.hash === '#riwayat' || urlParams.get('tab') === 'riwayat' || urlParams.has('search_riwayat') || urlParams.has('status_riwayat') || urlParams.has('peruntukan_riwayat') || urlParams.has('page')) {
          this.showTab('riwayat');
        }
      }
    };

    // Draft Management: preserves form inputs across tab switching and reloads
    const DraftManager = {
      STORAGE_KEY: 'esimba_draft_peminjaman',
      init() {
        this.restoreDraft();
        this.bindEvents();
      },
      saveDraft() {
        const draft = {
          nomorSurat: document.getElementById('nomor-surat')?.value || '',
          tanggalPenggunaan: document.getElementById('tanggal-penggunaan')?.value || '',
          tanggalKembali: document.getElementById('tanggal-kembali')?.value || '',
          peruntukanId: document.getElementById('peruntukan')?.value || ''
        };
        try {
          sessionStorage.setItem(this.STORAGE_KEY, JSON.stringify(draft));
        } catch (e) {}
      },
      restoreDraft() {
        try {
          const saved = sessionStorage.getItem(this.STORAGE_KEY);
          if (saved) {
            const draft = JSON.parse(saved);
            const nomorSurat = document.getElementById('nomor-surat');
            const tanggalPenggunaan = document.getElementById('tanggal-penggunaan');
            const tanggalKembali = document.getElementById('tanggal-kembali');
            const peruntukan = document.getElementById('peruntukan');

            if (nomorSurat && !nomorSurat.value && draft.nomorSurat) nomorSurat.value = draft.nomorSurat;
            if (tanggalPenggunaan && !tanggalPenggunaan.value && draft.tanggalPenggunaan) tanggalPenggunaan.value = draft.tanggalPenggunaan;
            if (tanggalKembali && !tanggalKembali.value && draft.tanggalKembali) tanggalKembali.value = draft.tanggalKembali;
            if (peruntukan && !peruntukan.value && draft.peruntukanId) peruntukan.value = draft.peruntukanId;
          }
        } catch (e) {}
      },
      clearDraft() {
        try {
          sessionStorage.removeItem(this.STORAGE_KEY);
        } catch (e) {}
      },
      bindEvents() {
        ['nomor-surat', 'tanggal-penggunaan', 'tanggal-kembali', 'peruntukan'].forEach(id => {
          const el = document.getElementById(id);
          if (el) {
            el.addEventListener('input', () => this.saveDraft());
            el.addEventListener('change', () => this.saveDraft());
          }
        });
      }
    };

    // Loan Management
    const LoanManager = {
      async savePeminjaman() {
        // Validasi daftar barang
        const items = document.querySelectorAll('table tbody tr[data-item-id]');
        if (items.length === 0) {
          Utils.showToast('toast-danger-2', 'Tidak ada barang yang dipilih untuk dipinjam.');
          return;
        }

        const inputs = {
          suratTugas: document.getElementById('nomor-surat').value,
          tanggalPenggunaan: document.getElementById('tanggal-penggunaan').value,
          tanggalPengembalian: document.getElementById('tanggal-kembali').value,
          peruntukanId: document.getElementById('peruntukan').value
        };

        // Validasi input
        if (Object.values(inputs).some(value => !value)) {
          Utils.showToast('toast-danger-2', 'Mohon lengkapi semua data.');
          return;
        }

        // 🔥 Tampilkan loading screen
        const loadingScreen = document.getElementById('loadingScreen');
        loadingScreen.classList.remove('hidden');

        try {
          const response = await fetch(CONFIG.API_ENDPOINTS.STORE_LOAN, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': Utils.getCsrfToken(),
              'Accept': 'application/json'
            },
            body: JSON.stringify({
              nomor_surat: inputs.suratTugas,
              peruntukan_id: inputs.peruntukanId,
              tanggal_penggunaan: inputs.tanggalPenggunaan,
              tanggal_kembali: inputs.tanggalPengembalian
            })
          });

          const result = await response.json();

          if (result.success) {
            DraftManager.clearDraft();
            this.showSuccessModal();
          } else {
            Utils.showToast('toast-danger-2', result.message || 'Tidak ada barang yang dipilih untuk dipinjam.');
          }

        } catch (error) {
          console.error('Error:', error);
          Utils.showToast('toast-danger-2', 'Terjadi kesalahan saat menyimpan data.');
        } finally {
          // 🔥 Pastikan loading screen selalu disembunyikan
          loadingScreen.classList.add('hidden');
        }
      },

      initSaveValidation() {
        const openSaveBtn = document.querySelector('[data-modal-target="save-modal"]');
        if (openSaveBtn) {
          openSaveBtn.addEventListener('click', (e) => {
            const items = document.querySelectorAll('table tbody tr[data-item-id]');
            if (items.length === 0) {
              e.stopPropagation();
              e.preventDefault();
              Utils.showToast('toast-danger-2', 'Tidak ada barang yang dipilih untuk dipinjam.');
              return;
            }

            const inputs = {
              suratTugas: document.getElementById('nomor-surat')?.value,
              tanggalPenggunaan: document.getElementById('tanggal-penggunaan')?.value,
              tanggalPengembalian: document.getElementById('tanggal-kembali')?.value,
              peruntukanId: document.getElementById('peruntukan')?.value
            };

            if (Object.values(inputs).some(value => !value)) {
              e.stopPropagation();
              e.preventDefault();
              Utils.showToast('toast-danger-2', 'Mohon lengkapi semua data.');
              return;
            }
          }, true);
        }
      },

      showSuccessModal() {
        const successModal = document.getElementById('successModal');
        if (successModal) {
          successModal.classList.remove('hidden');
          successModal.classList.add('flex');
        }

        const selesaiButton = document.getElementById('successButton');
        if (selesaiButton) {
          selesaiButton.onclick = () => {
            window.location.href = '/user/peminjaman/report';
          };
        }
      },

      initDateInputs() {
        const today = Utils.formatDate(new Date());
        const tanggalPinjam = document.getElementById('tanggal-penggunaan');
        const tanggalKembali = document.getElementById('tanggal-kembali');

        if (!tanggalPinjam.value) {
          tanggalPinjam.min = today;
          tanggalPinjam.value = today;
        }
        tanggalKembali.min = tanggalPinjam.value;

        tanggalPinjam.addEventListener('change', function () {
          tanggalKembali.min = this.value;
        });
      }
    };

    // Initialize on DOM Load
    document.addEventListener('DOMContentLoaded', () => {
      ModalHandler.init();
      SearchManager.init();
      TabManager.init();
      DraftManager.init();
      LoanManager.initDateInputs();
      LoanManager.initSaveValidation();

      // Global helper untuk memicu modal buka/tutup
      document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
          const targetId = this.getAttribute('data-modal-target');
          if (targetId) {
            const targetModal = document.getElementById(targetId);
            if (targetModal) {
              targetModal.classList.remove('hidden');
              targetModal.classList.add('flex');
            }
          }
        });
      });

      document.querySelectorAll('[data-modal-hide]').forEach(closer => {
        closer.addEventListener('click', function (e) {
          const targetId = this.getAttribute('data-modal-hide');
          if (targetId) {
            const targetModal = document.getElementById(targetId);
            if (targetModal) {
              targetModal.classList.add('hidden');
              targetModal.classList.remove('flex');
            }
          }
        });
      });

      // Bind save button
      document.getElementById('saveButton')?.addEventListener('click', (e) => {
        e.preventDefault();
        LoanManager.savePeminjaman();
      });

      // Optional: Datepicker initialization if Flowbite is used
      const datepickerInput = document.getElementById('datepicker');
      if (datepickerInput && typeof Datepicker !== 'undefined') {
        new Datepicker(datepickerInput, {
          minDate: new Date(),
          todayHighlight: true
        });
      }
    });

    document.getElementById('peruntukan')?.addEventListener('change', function () {
      this.blur();
    });

    document.addEventListener('DOMContentLoaded', function () {
      const newItem = document.querySelector('[data-item-id]');
      if (newItem) {
        newItem.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      }
    });
  </script>
@endsection