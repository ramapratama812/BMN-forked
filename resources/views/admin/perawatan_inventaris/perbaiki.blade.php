@extends('layouts.admin.main')

@section('content')
<div class="px-6 py-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-700 p-8 sm:p-12">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fa-solid fa-clipboard-question"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tulis Keluhan Aset</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Deskripsikan masalah sebelum mengirimkannya ke Tim Perbaikan  .</p>
            </div>
        </div>

        <div class="mb-8 p-5 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700 flex items-center gap-4">
            <img src="{{ $data->barang->foto ? asset('storage/'.$data->barang->foto) : asset('img/no-image.png') }}" class="w-16 h-16 rounded-xl object-cover shadow-sm">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aset Terpilih</p>
                <h3 class="font-bold text-gray-800 dark:text-white text-lg">{{ $data->barang->nama_barang }}</h3>
            </div>
        </div>

        {{-- Tambahkan enctype multipart/form-data di sini --}}
        <form action="{{ route('perawatan_inventaris.perbaikiSubmit', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Apa yang perlu diperbaiki?</label>
                <textarea name="keluhan" rows="5" required
                          class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-2xl p-5 text-gray-700 dark:text-gray-200 focus:ring-4 focus:ring-[#1b365d]/20 transition-all resize-none shadow-inner"
                          placeholder="Contoh: AC meneteskan air dan kurang dingin pada bagian kompresor..."></textarea>
            </div>

            {{-- Tambahan Input File Foto --}}
            <div class="mb-10">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Lampiran Foto Bukti (Opsional)</label>
                <div class="relative">
                    <input type="file" name="foto[]" multiple id="foto" accept="image/*"
                           class="block w-full text-sm text-slate-500 dark:text-slate-400
                                  file:mr-4 file:py-3 file:px-6
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-bold
                                  file:bg-[#1b365d] file:text-white hover:file:bg-blue-900
                                  transition-all cursor-pointer bg-slate-50 dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-700 focus:outline-none focus:ring-4 focus:ring-[#1b365d]/20">
                    <p class="mt-3 text-[10px] text-slate-400 uppercase tracking-wider font-semibold">Format: JPG, PNG, JPEG. Maksimal ukuran 4MB.</p>
                </div>
                <div id="file-error" class="text-red-500 text-xs mt-2 hidden bg-red-50 p-2 rounded border border-red-100"></div>
                <div id="image-preview-container" class="mt-4 grid grid-cols-3 sm:grid-cols-4 gap-4"></div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('perawatan_inventaris.index') }}"
                   class="px-8 py-3.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all text-sm">
                   Batal
                </a>
                <button type="submit"
                        class="flex-1 px-8 py-3.5 bg-[#1b365d] text-white rounded-xl font-bold hover:bg-blue-900 shadow-xl shadow-blue-900/20 transition-all text-sm flex justify-center items-center gap-2">
                    Teruskan ke Tim Perbaikan <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const fileUpload = document.getElementById('foto');
    const previewContainer = document.getElementById('image-preview-container');
    const fileError = document.getElementById('file-error');
    
    let dt = new DataTransfer(); 

    fileUpload.addEventListener('change', function(e) {
        fileError.classList.add('hidden');
        fileError.innerHTML = '';
        
        let files = e.target.files;
        let errors = [];
        
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            
            if (file.size > 4 * 1024 * 1024) {
                errors.push(`File "<b>${file.name}</b>" terlalu besar (Maksimal 4 MB).`);
                continue;
            }
            
            if (!file.type.startsWith('image/')) {
                errors.push(`File "<b>${file.name}</b>" bukan gambar.`);
                continue;
            }
            
            dt.items.add(file);
        }
        
        if (errors.length > 0) {
            fileError.innerHTML = errors.join('<br>');
            fileError.classList.remove('hidden');
        }
        
        updateInputAndPreviews();
    });

    function updateInputAndPreviews() {
        fileUpload.files = dt.files;
        previewContainer.innerHTML = '';
        
        for (let i = 0; i < dt.files.length; i++) {
            let file = dt.files[i];
            let reader = new FileReader();
            
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                let div = document.createElement('div');
                div.className = 'relative group rounded-xl overflow-hidden border border-slate-200 shadow-sm aspect-square bg-slate-50';
                
                let img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                let btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '×';
                btn.className = 'absolute top-1.5 right-1.5 bg-red-500/90 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity focus:opacity-100 shadow-sm hover:bg-red-600 z-20';
                
                btn.onclick = function(event) {
                    event.preventDefault(); 
                    event.stopPropagation();
                    removeFile(i);
                };
                
                div.appendChild(img);
                div.appendChild(btn);
                previewContainer.appendChild(div);
            };
        }
    }
    
    function removeFile(indexToRemove) {
        let newDt = new DataTransfer();
        for (let i = 0; i < dt.files.length; i++) {
            if (i !== indexToRemove) {
                newDt.items.add(dt.files[i]);
            }
        }
        dt = newDt;
        updateInputAndPreviews();
    }
</script>
@endsection
