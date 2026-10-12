<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="shortcut icon" href="{{ asset('img/assets/bg_esimba.png') }}" type="image/x-icon" />
    <title>Lapor Kondisi Barang - Report Damaged Item</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    },
                    colors: {
                        primary: {
                            50: "#eef2ff",
                            100: "#e0e7ff",
                            200: "#c7d2fe",
                            300: "#a5b4fc",
                            400: "#818cf8",
                            500: "#6366f1",
                            600: "#1B365D",
                            700: "#4338ca",
                            800: "#3730a3",
                            900: "#312e81",
                        },
                        slate: {
                            850: "#172033",
                        },
                    },
                    animation: {
                        "fade-in": "fadeIn 0.5s ease-out",
                        "slide-up": "slideUp 0.5s ease-out",
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": {
                                opacity: "0"
                            },
                            "100%": {
                                opacity: "1"
                            },
                        },
                        slideUp: {
                            "0%": {
                                transform: "translateY(10px)",
                                opacity: "0",
                            },
                            "100%": {
                                transform: "translateY(0)",
                                opacity: "1",
                            },
                        },
                    },
                },
            },
        };
    </script>
</head>


<body
    class="bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-900 dark:to-slate-800 min-h-screen flex items-center justify-center p-4 transition-colors duration-300 font-sans text-slate-900 dark:text-slate-100">
    <div class="w-full max-w-xl animate-slide-up">
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-white/50 dark:border-slate-700/50 backdrop-blur-sm transition-all duration-300">
            <div
                class="bg-primary-50 dark:bg-slate-800/50 p-6 sm:p-8 border-b border-primary-100 dark:border-slate-700">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        {{-- TOMBOL BACK BARU --}}
                        <a href="{{ url()->previous() }}"
                        class="flex items-center justify-center min-w-[40px] h-10 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 hover:text-primary-600 transition-all shadow-sm">
                            <span class="material-symbols-outlined">arrow_back</span>
                        </a>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">
                                Lapor Kondisi Barang
                            </h1>
                            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">
                                Submit a damage report ticket
                            </p>
                        </div>
                    </div>

                    <div class="hidden sm:flex h-12 w-12 bg-primary-100 dark:bg-primary-900/30 rounded-full items-center justify-center text-primary-600 dark:text-primary-400">
                        <span class="material-symbols-outlined text-2xl">assignment_late</span>
                    </div>
                </div>
                {{-- INFORMASI BARANG --}}
                <div
                    class="mt-6 flex items-center p-3 bg-white dark:bg-slate-900/50 rounded-lg border border-primary-100 dark:border-slate-700 shadow-sm">
                    <div
                        class="flex-shrink-0 h-10 w-10 rounded-md bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400">
                        <span class="material-symbols-outlined">
                            inventory_2
                        </span>
                    </div>

                    <div class="ml-3 flex-1">
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Item Details
                        </p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $barang->nama_barang }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span
                            class="inline-flex items-center rounded-full bg-green-50 dark:bg-green-900/30 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400 ring-1 ring-inset ring-green-600/20">
                            Active Asset
                        </span>
                    </div>
                </div>
            </div>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 sm:p-8 space-y-6 bg-white dark:bg-slate-800">

                <form action="{{ route('user.inventaris.lapor-kerusakan.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">

                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                    <input type="hidden" name="from" value="{{ request()->query('from') }}">

                    {{-- JENIS KERUSAKAN --}}
                    <div class="group">
                        <label for="jenis_kerusakan"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors group-focus-within:text-primary-600 dark:group-focus-within:text-primary-400">
                            Jenis Kerusakan
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="jenis_kerusakan" name="jenis_kerusakan" required
                                class="block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm py-3 px-4 transition-all duration-200 shadow-sm appearance-none">
                                <option value="" disabled selected>Pilih jenis kerusakan...</option>
                                @foreach ($jenis_kerusakan as $jk)
                                    <option value="{{ $jk->nama_jenis_kerusakan }}">{{ $jk->nama_jenis_kerusakan }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">
                                    expand_more
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="group">
                        <label for="deskripsi"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors group-focus-within:text-primary-600 dark:group-focus-within:text-primary-400">
                            Deskripsi Detail
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea id="deskripsi" name="deskripsi" rows="4" required
                            placeholder="Jelaskan kronologi dan kondisi kerusakan secara rinci..."
                            class="block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white placeholder-slate-400 focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-4 transition-all duration-200 resize-none shadow-sm"></textarea>
                    </div>

                    {{-- FOTO --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Foto Bukti
                        </label>

                        <div
                            class="mt-1 flex justify-center px-6 pt-6 pb-6 border-2 border-slate-300 dark:border-slate-600 border-dashed rounded-xl hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50/50 dark:hover:bg-slate-700/50 transition-all duration-200 relative group cursor-pointer">
                            <div class="space-y-2 text-center">
                                <div
                                    class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500 group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors duration-200 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700 group-hover:bg-white dark:group-hover:bg-slate-600 shadow-sm">
                                    <span class="material-symbols-outlined text-3xl">
                                        cloud_upload
                                    </span>
                                </div>

                                <div class="text-sm text-slate-600 dark:text-slate-400">
                                    <span
                                        class="font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-500 hover:underline">
                                        Click to upload
                                    </span>
                                    <span class="text-slate-500">
                                        or drag and drop
                                    </span>
                                </div>

                                <p class="text-xs text-slate-400 dark:text-slate-500">
                                    PNG, JPG up to 10MB
                                </p>

                                <p id="file-name"
                                    class="text-sm font-medium text-primary-600 dark:text-primary-400 mt-2 h-5 transition-all">
                                </p>
                            </div>

                            <input id="file-upload" name="foto[]" multiple accept="image/*" type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                        </div>
                        <div id="file-error" class="text-red-500 text-sm mt-2 hidden bg-red-50 p-2 rounded border border-red-100"></div>
                        <div id="image-preview-container" class="mt-4 grid grid-cols-3 sm:grid-cols-4 gap-4"></div>
                    </div>
                    <div class="pt-2 flex flex-col-reverse sm:flex-row gap-3">
                        <a class="w-full sm:w-auto px-6 py-3 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all text-center"
                            href="{{ url()->previous() }}">
                            Batal
                        </a>
                        <button
                            class="w-full flex-1 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform active:scale-[0.98]"
                            type="submit">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL PREVIEW FOTO --}}
    <div id="image-modal" class="fixed inset-0 z-[200] hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <button type="button" onclick="closeModal()" class="absolute top-6 right-6 text-white hover:text-red-400 transition-colors z-[210]">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        <img id="modal-image" src="" class="max-w-full max-h-full rounded-lg shadow-2xl object-contain relative z-[205]">
    </div>

    <script>
        const fileUpload = document.getElementById('file-upload');
        const previewContainer = document.getElementById('image-preview-container');
        const fileError = document.getElementById('file-error');
        const fileNameDisplay = document.getElementById('file-name');
        
        let dt = new DataTransfer(); 

        fileUpload.addEventListener('change', function(e) {
            fileError.classList.add('hidden');
            fileError.innerHTML = '';
            
            let files = e.target.files;
            let errors = [];
            
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                
                if (file.size > 4 * 1024 * 1024) {
                    errors.push(`File "<b>${file.name}</b>" gagal ditambahkan: Maksimal 4 MB.`);
                    continue;
                }
                
                if (!file.type.startsWith('image/')) {
                    errors.push(`File "<b>${file.name}</b>" gagal ditambahkan: Bukan format gambar.`);
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
            
            let count = dt.files.length;
            fileNameDisplay.textContent = count > 0 ? count + ' gambar dipilih' : '';
            
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

                    let openBtn = document.createElement('button');
                    openBtn.type = 'button';
                    openBtn.innerHTML = 'Buka';
                    openBtn.className = 'absolute inset-0 m-auto w-16 h-8 bg-black/60 text-white rounded-lg text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center hover:bg-black/80 z-10';
                    openBtn.onclick = function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        openModal(e.target.result);
                    };
                    
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
                    div.appendChild(openBtn);
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

        function openModal(src) {
            document.getElementById('modal-image').src = src;
            document.getElementById('image-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('image-modal').classList.add('hidden');
            document.getElementById('modal-image').src = '';
        }
    </script>
</body>

</html>
