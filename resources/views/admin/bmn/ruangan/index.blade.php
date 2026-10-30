@extends('layouts.admin.main')

@section('content')
    <div class="flex p-3 ml-3 mr-3">
        @if (Route::currentRouteName() == 'bmn.ruangan.search')
            <a href="{{ route('bmn.ruangan.index') }}"
                class="mr-3 text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm px-4 py-2">Kembali</a>
        @endif

        <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="mr-3 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Ruangan
        </button>
    </div>

    {{-- Search Form --}}
    <form class="flex items-center max-w-sm mx-auto p-3 ml-3" action="{{ route('bmn.ruangan.search') }}" method="GET">
        <div class="w-full relative">
            <input type="text" id="search" name="search" autocomplete="off"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10"
                placeholder="Cari ruangan...">
            <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
    </form>

    @if ($ruangan->isEmpty())
        <x-empty-data></x-empty-data>
    @else
        <div class="flex flex-col p-3 ml-3">
            <div class="relative overflow-x-auto sm:rounded-lg border">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-bold">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Gambar Ruangan</th>
                            <th class="px-6 py-3">Nama Ruangan</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangan as $row)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $ruangan->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4">
                                    @if ($row->gambar_ruangan)
                                        <img src="{{ asset('storage/' . $row->gambar_ruangan) }}"
                                            alt="Gambar {{ $row->nama_ruangan }}"
                                            class="h-16 w-24 object-cover rounded-lg border shadow-sm cursor-pointer hover:opacity-80 transition-opacity preview-thumb"
                                            onclick="openImagePreview(this.src, '{{ $row->nama_ruangan }}')">
                                    @else
                                        <div class="h-16 w-24 bg-gray-100 rounded-lg border flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $row->nama_ruangan }}</td>
                                <td class="px-6 py-4">
                                    <button type="button" data-uuid="{{ $row->uuid }}"
                                        class="edit-item text-blue-600 hover:underline">Edit</button>
                                    <button onclick="confirmDelete('{{ route('bmn.ruangan.destroy', $row->uuid) }}')"
                                        data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                        class="text-red-600 hover:underline ml-2">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-3 ml-6">{{ $ruangan->links() }}</div>
    @endif

    {{-- Modal Create --}}
    <div id="create-modal" tabindex="-1" aria-hidden="true"
        class="{{ session('showModal') || $errors->any() ? 'flex' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow border">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold">Tambah Ruangan</h3>
                    <button type="button" data-modal-hide="create-modal"
                        class="text-gray-400 hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">✕</button>
                </div>
                <form action="{{ route('bmn.ruangan.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_ruangan" class="block mb-2 text-sm font-medium">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" id="nama_ruangan"
                            class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                        @error('nama_ruangan')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium">Gambar Ruangan</label>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 transition-all text-center">
                            <input type="file" name="gambar_ruangan" id="create_gambar_ruangan" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="createGambarPreviewContainer" class="hidden mb-2 justify-center">
                                <img id="createGambarPreview" src="" class="h-32 w-48 object-cover rounded-lg shadow-md border" alt="Preview">
                            </div>
                            <div class="text-gray-500" id="createGambarLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm">Klik untuk pilih gambar ruangan</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan
                        Data</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="edit-modal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold">Edit Ruangan</h3>
                    <button type="button" class="close-modal text-gray-400">✕</button>
                </div>
                <form id="updateForm" class="p-4">
                    @csrf @method('PUT')
                    <input type="hidden" id="ruangan_uuid" name="uuid">
                    <div class="mb-4">
                        <label for="edit_nama_ruangan" class="block mb-2 text-sm font-medium">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" id="edit_nama_ruangan"
                            class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_ruangan"></div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium">Gambar Ruangan</label>
                        {{-- Preview gambar saat ini --}}
                        <div id="editGambarCurrentContainer" class="hidden mb-3">
                            <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                            <img id="editGambarCurrent" src="" class="h-32 w-48 object-cover rounded-lg shadow-md border" alt="Gambar Ruangan">
                        </div>
                        <div class="group relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-blue-400 transition-all text-center">
                            <input type="file" name="gambar_ruangan" id="edit_gambar_ruangan" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div id="editGambarPreviewContainer" class="hidden mb-2 justify-center">
                                <img id="editGambarPreview" src="" class="h-32 w-48 object-cover rounded-lg shadow-md border" alt="Preview Baru">
                            </div>
                            <div class="text-gray-500" id="editGambarLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm">Klik untuk ganti gambar</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="close-modal px-4 py-2 bg-gray-200 rounded-lg">Kembali</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar (Full Screen) --}}
    <div id="image-preview-modal" class="fixed inset-0 z-[60] hidden overflow-auto bg-black bg-opacity-80 backdrop-blur-sm cursor-pointer" onclick="closeImagePreview()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
                <button type="button" onclick="closeImagePreview()"
                    class="absolute -top-3 -right-3 z-10 bg-white text-gray-600 hover:text-red-500 rounded-full w-10 h-10 flex items-center justify-center shadow-lg text-xl font-bold transition-colors">✕</button>
                <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                    <div class="p-3 bg-gray-50 border-b">
                        <h4 id="previewModalTitle" class="text-sm font-semibold text-gray-700 text-center"></h4>
                    </div>
                    <div class="p-4 flex justify-center bg-gray-100">
                        <img id="previewModalImage" src="" alt="Preview Gambar Ruangan"
                            class="max-h-[70vh] object-contain rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    @include('components.modal-delete') {{-- Asumsi Anda punya komponen ini, atau gunakan manual seperti di bawah --}}

@endsection

@section('scripts')
    <script>
        // Helper: Setup preview untuk file input
        function setupImagePreview(inputId, previewImgId, containerId, labelId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const container = document.getElementById(containerId);
                    const label = document.getElementById(labelId);
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(previewImgId).src = e.target.result;
                            if (container) {
                                container.classList.remove('hidden');
                                container.classList.add('flex');
                            }
                            if (label) label.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        }

        // Full-screen image preview
        function openImagePreview(src, title) {
            const modal = document.getElementById('image-preview-modal');
            document.getElementById('previewModalImage').src = src;
            document.getElementById('previewModalTitle').textContent = 'Gambar Ruangan: ' + title;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImagePreview() {
            const modal = document.getElementById('image-preview-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('edit-modal');
            const updateForm = document.getElementById('updateForm');

            // Setup preview untuk modal create
            setupImagePreview('create_gambar_ruangan', 'createGambarPreview', 'createGambarPreviewContainer', 'createGambarLabel');

            // Setup preview untuk modal edit (gambar baru)
            setupImagePreview('edit_gambar_ruangan', 'editGambarPreview', 'editGambarPreviewContainer', 'editGambarLabel');

            // Logic Fetch Data untuk Edit
            document.querySelectorAll('.edit-item').forEach(button => {
                button.addEventListener('click', function() {
                    const uuid = this.getAttribute('data-uuid');
                    fetch(`/admin/bmn/ruangan/edit/${uuid}`)
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('ruangan_uuid').value = uuid;
                            document.getElementById('edit_nama_ruangan').value = data
                                .nama_ruangan;

                            // Reset preview gambar baru
                            document.getElementById('editGambarPreviewContainer').classList.add('hidden');
                            document.getElementById('editGambarPreviewContainer').classList.remove('flex');
                            document.getElementById('editGambarLabel').classList.remove('hidden');
                            document.getElementById('edit_gambar_ruangan').value = '';

                            // Tampilkan gambar saat ini jika ada
                            const currentContainer = document.getElementById('editGambarCurrentContainer');
                            const currentImg = document.getElementById('editGambarCurrent');
                            if (data.gambar_ruangan) {
                                currentImg.src = '/storage/' + data.gambar_ruangan;
                                currentContainer.classList.remove('hidden');
                            } else {
                                currentContainer.classList.add('hidden');
                            }

                            editModal.classList.remove('hidden');
                        });
                });
            });

            // Close Modal
            document.querySelectorAll('.close-modal, [data-modal-hide="create-modal"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    editModal.classList.add('hidden');
                    document.getElementById('create-modal').classList.add('hidden');
                });
            });

            // Submit Update via AJAX (multipart/form-data untuk upload gambar)
            updateForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Reset pesan error sebelumnya
                document.getElementById('error-nama_ruangan').textContent = '';

                const submitBtn = updateForm.querySelector('[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Menyimpan...';

                const uuid = document.getElementById('ruangan_uuid').value;

                // Gunakan FormData untuk multipart upload
                const formData = new FormData(updateForm);

                fetch(`/admin/bmn/ruangan/update/${uuid}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else if (data.errors) {
                            // Tampilkan pesan error validasi dari server
                            if (data.errors.nama_ruangan) {
                                document.getElementById('error-nama_ruangan').textContent = data.errors
                                    .nama_ruangan[0];
                            }
                        }
                    })
                    .catch(() => {
                        document.getElementById('error-nama_ruangan').textContent =
                            'Terjadi kesalahan, coba lagi.';
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Simpan Perubahan';
                    });
            });

            // Close preview modal dengan Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImagePreview();
                }
            });
        });

        function confirmDelete(url) {
            const form = document.getElementById('deleteForm');
            if (form) form.action = url;
        }
    </script>
@endsection
