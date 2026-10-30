
@extends('layouts.admin.main')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Log Aktivitas
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Riwayat aktivitas pengguna dalam sistem ESIMBA.
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Aktivitas</p>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalAktivitas ?? 0 }}
                    </h2>
                </div>
                <i class="fas fa-history text-2xl text-blue-600 bg-blue-50 p-3 rounded-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Aktivitas Ditampilkan</p>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $logs->count() }}
                    </h2>
                </div>
                <i class="fas fa-list text-2xl text-green-600 bg-green-50 p-3 rounded-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Modul</p>
                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $totalModul ?? 0 }}
                    </h2>
                </div>
                <i class="fas fa-layer-group text-2xl text-purple-600 bg-purple-50 p-3 rounded-lg"></i>
            </div>
        </div>

    </div>

    {{-- TABEL DAN FILTER --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- FORM FILTER --}}
            <form action="{{ route('admin.log-aktivitas.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari aktivitas..."
                        class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                    >

                    <select name="aksi"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 outline-none">

                        <option value="">Semua Aksi</option>
                        <option value="Tambah" {{ request('aksi') == 'Tambah' ? 'selected' : '' }}>Tambah</option>
                        <option value="Edit" {{ request('aksi') == 'Edit' ? 'selected' : '' }}>Edit</option>
                        <option value="Hapus" {{ request('aksi') == 'Hapus' ? 'selected' : '' }}>Hapus</option>
                    </select>

                    <select name="modul"
                        class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 outline-none">

                        <option value="">Semua Modul</option>
                        @foreach($moduls as $modul)
                            <option value="{{ $modul }}"
                                {{ request('modul') == $modul ? 'selected' : '' }}>
                                {{ $modul }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-blue-700 hover:bg-blue-800 text-white rounded-lg px-4 py-2.5 text-sm font-medium">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>

                        <a href="{{ route('admin.log-aktivitas.index') }}"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg px-4 py-2.5 text-sm font-medium">
                            <i class="fas fa-rotate-left mr-1"></i> Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- TABEL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-5 py-4">No</th>
                        <th class="px-5 py-4">Waktu</th>
                        <th class="px-5 py-4">Pengguna</th>
                        <th class="px-5 py-4">Aksi</th>
                        <th class="px-5 py-4">Modul</th>
                        <th class="px-5 py-4">Deskripsi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($logs as $log)
                    <tr class="hover:bg-blue-50 transition">

                        <td class="px-5 py-4 text-gray-500">
                            {{ $logs->firstItem() + $loop->index }}
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap text-gray-600">
                            {{ $log->created_at?->format('d-m-Y H:i') ?? '-' }}
                        </td>

                        <td class="px-5 py-4 font-medium text-gray-700">
                            {{ $log->user?->kode_user ?? '-' }}
                        </td>

                        <td class="px-5 py-4">
                            @php
                                $warna = match(strtolower($log->aksi)) {
                                    'tambah' => 'bg-green-100 text-green-700',
                                    'edit' => 'bg-blue-100 text-blue-700',
                                    'hapus' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp

                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $warna }}">
                                {{ $log->aksi }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-gray-700">
                            {{ $log->modul }}
                        </td>

                        <td class="px-5 py-4 text-gray-600 min-w-[250px]">
                            {{ $log->deskripsi }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-gray-500">
                            <i class="fas fa-inbox text-3xl text-gray-300 mb-3"></i>
                            <p>Belum ada aktivitas yang ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3">

            <p class="text-sm text-gray-500">
                Menampilkan {{ $logs->firstItem() ?? 0 }}
                sampai {{ $logs->lastItem() ?? 0 }}
                dari {{ $logs->total() }} aktivitas
            </p>

            <div>
                {{ $logs->withQueryString()->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
