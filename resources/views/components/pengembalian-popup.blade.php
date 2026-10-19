{{-- Modal Konfirmasi Pengembalian --}}
<div id="save-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-4 md:p-5 text-center flex flex-col items-center">
                <svg class="mx-auto mb-2 text-gray-400 w-6 h-6 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                    Simpan Pengembalian Barang?
                </h3>
                <p class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                    Pastikan kondisi barang yang dikembalikan sudah benar.
                </p>

                <div class="flex justify-center gap-3">
                    <button id="savePengembalian" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya, Simpan
                    </button>

                    <button id="cancelPengembalian" type="button" data-modal-hide="save-modal"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Pengembalian Berhasil --}}
<div id="successModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- Modal content --}}
        <div class="text-center">
            <div
                class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Success</span>
            </div>
            <p class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pengembalian Berhasil</p>
            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                Data pengembalian barang berhasil disimpan.
            </p>
            <button id="successButton" type="button"
                class="py-2 px-3 text-sm font-medium text-white bg-blue-900 hover:bg-blue-700 rounded-lg focus:ring-4 focus:outline-none dark:focus:ring-primary-900">
                Lihat Laporan
            </button>
        </div>
    </div>
</div>
