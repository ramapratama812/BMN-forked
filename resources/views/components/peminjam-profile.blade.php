<div class="w-full p-3.5 sm:p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-4 transition-all">
  <div class="flex items-center gap-3.5 sm:gap-4">
    {{-- Avatar Sisi Kiri (48px mobile, 52px desktop) --}}
    <div class="relative shrink-0">
      <img class="w-12 h-12 sm:w-[52px] sm:h-[52px] rounded-full object-cover border-2 border-blue-600/20 shadow-sm"
        src="{{ Auth::user()->foto ? asset('storage/uploads/foto_user/' . Auth::user()->foto) : Avatar::create(Auth::user()->nama_lengkap)->toBase64() }}"
        alt="{{ Auth::user()->nama_lengkap }}" />
    </div>

    {{-- Informasi Petugas Sisi Kanan --}}
    <div class="flex-1 min-w-0">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 sm:gap-2">
        <div class="min-w-0">
          <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white truncate leading-snug">
            {{ Auth::user()->nama_lengkap }}
          </h3>
          <p class="text-xs sm:text-sm font-medium text-blue-600 dark:text-blue-400 truncate">
            {{ Auth::user()->jabatan?->jabatan ?? 'Petugas' }}
          </p>
        </div>

        {{-- Metadata Sekunder: NIP & Nomor HP --}}
        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400">
          <span class="inline-flex items-center gap-1.5" title="Nomor Induk Pegawai">
            <i class="fa-solid fa-id-badge text-gray-400 dark:text-gray-500"></i>
            <span class="font-mono font-medium">{{ Auth::user()->nip }}</span>
          </span>
          <span class="inline-flex items-center gap-1.5" title="Nomor Telepon">
            <i class="fa-solid fa-phone text-gray-400 dark:text-gray-500"></i>
            <span>{{ Auth::user()->nomor_hp }}</span>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
