@extends('layouts.admin.main')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Log Aktivitas
    </h1>

    <div class="bg-white rounded-lg shadow overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Pengguna</th>
                    <th class="p-3">Aksi</th>
                    <th class="p-3">Modul</th>
                    <th class="p-3">Deskripsi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                <tr class="border-t">
                    <td class="p-3">{{ $logs->firstItem()+$loop->index }}</td>
                    <td class="p-3">{{ $log->created_at->format('d-m-Y H:i') }}</td>
                    <td class="p-3">{{ $log->user->kode_user ?? '-' }}</td>
                    <td class="p-3">{{ $log->aksi }}</td>
                    <td class="p-3">{{ $log->modul }}</td>
                    <td class="p-3">{{ $log->deskripsi }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center">
                        Belum ada aktivitas.
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
@endsection