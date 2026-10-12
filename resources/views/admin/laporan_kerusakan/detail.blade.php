@extends('layouts.admin.main')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Detail Laporan</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi lengkap mengenai kerusakan aset barang.</p>
            </div>
            <a href="{{ route('admin.laporan-kerusakan.index') }}"
               class="group inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-full shadow-sm hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 hover:shadow-md transition-all duration-300 ease-out">
                <span class="transform transition-transform duration-300 group-hover:-translate-x-1">←</span>
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="space-y-6">
                      <div>
                          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nama Barang</label>
                          <p class="text-lg font-medium text-slate-800">{{ $laporan->barang->nama_barang }}</p>
                      </div>

                      <div>
                          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Tanggal Laporan</label>
                          <p class="text-sm font-medium text-slate-700">
                              <span class="flex items-center gap-1.5">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                  </svg>
                                  {{ $laporan->created_at->translatedFormat('d F Y') }}
                                  <span class="text-slate-400 font-normal ml-1">({{ $laporan->created_at->format('H:i') }} WIB)</span>
                              </span>
                          </p>
                      </div>
                      <div>
                          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Jenis Kerusakan</label>
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-50 text-amber-700 border border-amber-100">
                              {{ $laporan->jenis_kerusakan }}
                          </span>
                      </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Deskripsi Masalah</label>
                            <p class="text-slate-600 leading-relaxed text-sm bg-slate-50 p-4 rounded-xl border border-slate-100 italic">
                                "{{ $laporan->deskripsi }}"
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nama Pelapor</label>
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-xs">
                                    {{ strtoupper(substr($laporan->user->nama_lengkap ?? 'A', 0, 1)) }}
                                </div>
                                <p class="text-sm font-medium text-slate-800">{{ $laporan->user->nama_lengkap ?? 'Tidak diketahui' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-start">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 self-start">Bukti Foto</label>
                        
                        @if (isset($laporan->fotos) && $laporan->fotos->count() > 0)
                            <div class="grid grid-cols-2 gap-4 w-full">
                                @foreach ($laporan->fotos as $f)
                                    <div class="group relative overflow-hidden rounded-xl ring-1 ring-slate-200 transition-all hover:ring-indigo-300 shadow-sm aspect-square cursor-pointer"
                                         onclick="openModal('{{ asset('storage/'.$f->foto) }}')">
                                        <img src="{{ asset('storage/'.$f->foto) }}"
                                             class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110"
                                             alt="Foto Kerusakan">
                                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif ($laporan->foto)
                            <div class="group relative overflow-hidden rounded-2xl ring-1 ring-slate-200 transition-all hover:ring-indigo-300 shadow-sm w-full cursor-pointer"
                                 onclick="openModal('{{ asset('storage/'.$laporan->foto) }}')">
                                <img src="{{ asset('storage/'.$laporan->foto) }}"
                                     class="w-full h-64 object-cover transform transition-transform duration-700 group-hover:scale-110"
                                     alt="Foto Kerusakan">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        @else
                            <div class="w-full h-64 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-xs">Tidak ada foto terlampir</p>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-8 border-slate-100">

                <div class="flex items-center justify-end gap-4">

                    <form action="{{ route('admin.laporan-kerusakan.tolak', $laporan->uuid) }}" method="POST">
                        @csrf
                        <button class="px-6 py-2.5 text-sm font-semibold text-rose-600 bg-white border border-rose-200 rounded-full shadow-sm hover:bg-rose-50 hover:border-rose-300 hover:text-rose-700 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 ease-out focus:ring-4 focus:ring-rose-100">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Tolak Laporan
                            </span>
                        </button>
                    </form>

                    <form action="{{ route('admin.laporan-kerusakan.setujui', $laporan->uuid) }}" method="POST">
                        @csrf
                        <button class="px-8 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-slate-800 to-slate-900 rounded-full shadow-lg shadow-slate-300 hover:from-emerald-500 hover:to-emerald-600 hover:shadow-emerald-300 hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 ease-out focus:ring-4 focus:ring-slate-200">
                            <span class="flex items-center gap-2">
                                Setujui & Proses
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
                </div>
        </div>
    </div>
</div>

<!-- Modal Fullscreen Image -->
<div id="imageModal" class="fixed inset-0 z-[100] hidden bg-slate-900/95 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0" onclick="closeModal()">
    <button class="absolute top-6 right-6 text-white hover:text-rose-400 transition-colors bg-slate-800/50 rounded-full p-2" onclick="closeModal()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="modalImage" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300" alt="Full Image" onclick="event.stopPropagation()">
</div>

<script>
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        
        modalImg.src = imageSrc;
        modal.classList.remove('hidden');
        
        // Trigger animation
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalImg.classList.remove('scale-95');
            modalImg.classList.add('scale-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        
        modal.classList.add('opacity-0');
        modalImg.classList.remove('scale-100');
        modalImg.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modalImg.src = '';
        }, 300);
    }
</script>
@endsection
