@extends('layouts.admin.main')

@section('content')
    <div class="m-1.5 overflow-x-auto ml-5 mr-3">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700">
                <div class="container mx-auto p-4">
                    <form action="{{ route('users.update', $user->uuid) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sw-full">
                                <label for="nama_lengkap"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan nama lengkap" />
                                @error('nama_lengkap')
                                    <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label for="nip"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                <input type="text" name="nip" id="nip" value="{{ old('nip', $user->nip) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    autocomplete="off" placeholder="Masukkan NIP">
                                @error('nip')
                                    <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                @enderror
                            </div>

                            <div class="w-full flex space-x-4">
                                <div class="w-1/2">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        autocomplete="off" placeholder="Contoh. user@gmail.com">
                                    @error('email')
                                        <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-1/2">
                                    <label for="nomor_hp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                        HP</label>
                                    <input type="nomor_hp" name="nomor_hp" id="nomor_hp"
                                        value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        autocomplete="off" placeholder="Contoh. 0813XXXXXX">
                                    @error('nomor_hp')
                                        <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="jabatan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                                <select id="jabatan" name="jabatan_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled>Pilih jabatan</option>
                                    @foreach ($jabatan as $j)
                                        <option value="{{ $j->id }}"
                                            {{ old('jabatan_id', $user->jabatan_id) == $j->id ? 'selected' : '' }}>
                                            {{ $j->jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan')
                                    <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select id="role" name="role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="{!! $user->role !!}" {{ old('role') == '' ? 'selected' : '' }}
                                        disabled>{!! $user->role !!}</option>
                                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                        Superadmin</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="tim_perbaikan" {{ old('role') == 'tim_perbaikan' ? 'selected' : '' }}>
                                        Tim Perbaikan</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Form Password: muncul hanya saat role Superadmin / Admin dipilih --}}
                            <div id="field-password" class="{{ in_array(old('role'), ['superadmin','admin']) ? '' : 'hidden' }}">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password Akun
                                    <span class="text-red-500">*</span>
                                    <span class="ml-1 text-xs font-normal text-gray-500">(wajib diisi untuk role Superadmin / Admin)</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        value="{{ old('password', 'E5imbaAdmin') }}"
                                        autocomplete="new-password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan password">
                                    {{-- Toggle show/hide password --}}
                                    <button type="button" onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.973 9.973 0 012.08-3.42M6.343 6.343A9.965 9.965 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411M3 3l18 18"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <small class="text-red-500 text-sm mt-1"> {{ $message }}</small>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Password default: <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">E5imbaAdmin</code></p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('users.index') }}"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</a>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script inline: layout tidak memiliki @stack('scripts') --}}
    <script>
        const roleSelect     = document.getElementById('role');
        const fieldPassword  = document.getElementById('field-password');
        const passwordInput  = document.getElementById('password');
        const ADMIN_ROLES    = ['superadmin', 'admin'];

        function togglePasswordField(role) {
            const isAdminRole = ADMIN_ROLES.includes(role);
            fieldPassword.classList.toggle('hidden', !isAdminRole);

            if (isAdminRole) {
                passwordInput.setAttribute('required', 'required');
                if (!passwordInput.value) {
                    passwordInput.value = 'E5imbaAdmin';
                }
            } else {
                passwordInput.removeAttribute('required');
                passwordInput.value = '';
            }
        }

        // Jalankan saat halaman load
        togglePasswordField(roleSelect.value);

        // Jalankan setiap kali role berubah
        roleSelect.addEventListener('change', function () {
            togglePasswordField(this.value);
        });

        function togglePassword() {
            const input      = document.getElementById('password');
            const iconEye    = document.getElementById('icon-eye');
            const iconEyeOff = document.getElementById('icon-eye-off');
            const isHidden   = input.type === 'password';
            input.type       = isHidden ? 'text' : 'password';
            iconEye.classList.toggle('hidden', isHidden);
            iconEyeOff.classList.toggle('hidden', !isHidden);
        }
    </script>
@endsection
