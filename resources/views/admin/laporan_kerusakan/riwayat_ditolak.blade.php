@extends('layouts.admin.main')

@section('content')
<div class="px-6 py-6">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                Riwayat Laporan Ditolak
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Daftar laporan kerusakan aset yang telah ditolak oleh admin.
            </p>
        </div>

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('admin.laporan-kerusakan.index') }}"
           style="background-color: #334155; color: #ffffff;"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl shadow-md hover:opacity-90 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Laporan
        </a>
    </div>

    {{-- JIKA BELUM ADA LAPORAN DITOLAK --}}
    @if ($laporan->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-12 h-12 text-gray-400 mb-3"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <h3 class="text-lg font-semibold text-gray-700">
                Belum Ada Laporan Ditolak
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Laporan yang ditolak akan muncul di halaman ini.
            </p>
        </div>

    @else

        {{-- TABEL RIWAYAT PENOLAKAN --}}
        <div class="overflow-x-auto bg-white rounded-2xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm text-left text-gray-600">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4">No.</th>
                        <th class="px-5 py-4">Nama Barang</th>
                        <th class="px-5 py-4">Pelapor</th>
                        <th class="px-5 py-4">Jenis Kerusakan</th>
                        <th class="px-5 py-4">Tanggal Pembaruan</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($laporan as $item)
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">

                            {{-- NOMOR --}}
                            <td class="px-5 py-4">
                                {{ $laporan->firstItem() + $loop->index }}
                            </td>

                            {{-- NAMA BARANG --}}
                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                            </td>

                            {{-- NAMA PELAPOR --}}
                            <td class="px-5 py-4">
                                {{ $item->user->nama_lengkap ?? 'Tidak diketahui' }}
                            </td>

                            {{-- JENIS KERUSAKAN --}}
                            <td class="px-5 py-4">
                                {{ $item->jenis_kerusakan ?? '-' }}
                            </td>

                            {{-- TANGGAL PEMBARUAN --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $item->updated_at?->format('d-m-Y H:i') ?? '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-5 py-4">
                                <span style="background-color: #fee2e2; color: #b91c1c;"
                                      class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            {{-- AKSI DETAIL --}}
                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('admin.laporan-kerusakan.detail', $item->uuid) }}"
                                   class="inline-flex items-center justify-center gap-1 text-blue-600 hover:text-blue-800 hover:underline font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-4 h-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $laporan->links() }}
        </div>

    @endif

</div>
@endsection