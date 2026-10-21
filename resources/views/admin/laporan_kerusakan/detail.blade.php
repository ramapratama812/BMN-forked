
@extends('layouts.admin.main')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                    Detail Laporan
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Informasi lengkap mengenai kerusakan aset barang.
                </p>
            </div>

            <a href="{{ url()->previous() }}"
               class="group inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-full shadow-sm hover:bg-slate-50 hover:text-slate-900 transition">
                <span>←</span>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8">

                {{-- Informasi dan foto --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="space-y-6">

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Nama Barang
                            </label>
                            <p class="text-lg font-medium text-slate-800">
                                {{ $laporan->barang->nama_barang ?? 'Tidak diketahui' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Tanggal Laporan
                            </label>
                            <p class="text-sm font-medium text-slate-700">
                                {{ $laporan->created_at?->translatedFormat('d F Y') }}
                                <span class="text-slate-400 font-normal">
                                    ({{ $laporan->created_at?->format('H:i') }})
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Jenis Kerusakan
                            </label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                {{ $laporan->jenis_kerusakan }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Status Laporan
                            </label>

                            @if (strtolower($laporan->status) === 'ditolak')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                    Ditolak
                                </span>
                            @elseif (strtolower($laporan->status) === 'disetujui')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-700">
                                    Menunggu Verifikasi
                                </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Deskripsi Masalah
                            </label>
                            <p class="text-slate-600 leading-relaxed text-sm bg-slate-50 p-4 rounded-xl border border-slate-100">
                                {{ $laporan->deskripsi }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                Nama Pelapor
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                    {{ strtoupper(substr($laporan->user->nama_lengkap ?? 'A', 0, 1)) }}
                                </div>
                                <p class="text-sm font-medium text-slate-800">
                                    {{ $laporan->user->nama_lengkap ?? 'Tidak diketahui' }}
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Bukti Foto --}}
                    <div class="flex flex-col items-center justify-center">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 self-start">
                            Bukti Foto
                        </label>

                        @if ($laporan->foto)
                            <div class="overflow-hidden rounded-2xl ring-1 ring-slate-200 shadow-sm w-full">
                                <img
                                    src="{{ asset('storage/' . $laporan->foto) }}"
                                    class="w-full h-64 object-cover"
                                    alt="Foto Kerusakan">
                            </div>
                        @else
                            <div class="w-full h-64 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                                <p class="text-sm">Tidak ada foto terlampir</p>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Dokumen Pendukung --}}
                <div class="mt-8">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3">
                        Dokumen Pendukung
                    </label>

                    @if ($laporan->dokumen_bukti)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 bg-slate-50 border border-slate-200 rounded-xl">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    Dokumen Bukti Kerusakan
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Lampiran dari pelapor
                                </p>
                            </div>

                            <a href="{{ asset('storage/' . $laporan->dokumen_bukti) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                                Lihat Dokumen
                            </a>
                        </div>
                    @else
                        <div class="p-5 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-sm text-slate-500">
                            Tidak ada dokumen pendukung yang dilampirkan.
                        </div>
                    @endif
                </div>

                <hr class="my-8 border-slate-100">

                {{-- Tombol tindakan hanya untuk laporan pending --}}
                @if (strtolower($laporan->status) === 'pending')
                    <div class="flex items-center justify-end gap-4">

                        <form action="{{ route('admin.laporan-kerusakan.tolak', $laporan->uuid) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menolak laporan ini?')">
                            @csrf

                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-semibold text-rose-600 bg-white border border-rose-200 rounded-full hover:bg-rose-50 transition">
                                Tolak Laporan
                            </button>
                        </form>

                        <form action="{{ route('admin.laporan-kerusakan.setujui', $laporan->uuid) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menyetujui laporan ini?')">
                            @csrf

                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-bold text-white bg-slate-800 rounded-full hover:bg-emerald-600 transition">
                                Setujui &amp; Proses
                            </button>
                        </form>

                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
