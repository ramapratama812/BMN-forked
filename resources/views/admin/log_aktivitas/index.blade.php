
@extends('layouts.admin.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Log Aktivitas
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Riwayat aktivitas pengguna dalam sistem ESIMBA.
        </p>
    </div>

    <div class="rounded-lg bg-white p-4 shadow">
        <form method="GET"
            action="{{ route('admin.log-aktivitas.index') }}"
            class="mb-5 flex flex-wrap gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari aktivitas atau pengguna..."
                class="rounded-lg border px-3 py-2"
            >

            <select name="aksi"
                    class="rounded-lg border px-3 py-2">
                <option value="">Semua aktivitas</option>
                <option value="Menambahkan"
                    @selected(request('aksi') === 'Menambahkan')>
                    Menambahkan
                </option>
                <option value="Mengubah"
                    @selected(request('aksi') === 'Mengubah')>
                    Mengubah
                </option>
                <option value="Menghapus"
                    @selected(request('aksi') === 'Menghapus')>
                    Menghapus
                </option>
            </select>

            <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-white">
                Cari
            </button>

            <a href="{{ route('admin.log-aktivitas.index') }}"
             class="rounded-lg border px-4 py-2">
                Reset
            </a>
        
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">No.</th>
                        <th class="border p-3">Waktu</th>
                        <th class="border p-3">Pengguna</th>
                        <th class="border p-3">Aktivitas</th>
                        <th class="border p-3">Modul</th>
                        <th class="border p-3">Keterangan</th>
                        <th class="border p-3">IP Address</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($logs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3">
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            <td class="border p-3 whitespace-nowrap">
                                {{ $log->created_at?->format('d-m-Y H:i:s') }}
                            </td>

                            <td class="border p-3">
                                {{ $log->user?->kode_user
                                    ?? $log->user?->name
                                    ?? 'Pengguna tidak tersedia' }}
                            </td>

                            <td class="border p-3">
                                {{ $log->aksi }}
                            </td>

                            <td class="border p-3">
                                {{ $log->modul }}
                            </td>

                            <td class="border p-3">
                                {{ $log->deskripsi }}
                            </td>

                            <td class="border p-3">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="border p-6 text-center text-gray-500">
                                Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
