<x-guest-layout>
    <div class="tw-flex tw-min-h-screen tw-bg-white" x-data="{ showPassword: false, showConfirm: false }">

        {{-- Illustration --}}
        <div class="tw-hidden lg:tw-flex lg:tw-w-1/2 tw-items-center tw-justify-center tw-p-10">
            <img src="{{ asset('images/hero-login.png') }}" alt="Login Illustration"
                class="tw-max-w-[80%] tw-h-auto tw-object-contain">
        </div>

        {{-- Form --}}
        <div class="tw-w-full lg:tw-w-1/2 tw-flex tw-flex-col tw-justify-center tw-px-10 md:tw-px-24 tw-py-14">

            {{-- Logo --}}
            <div class="tw-flex tw-items-center tw-gap-3 tw-mb-6">
                <img src="{{ asset('images/telu.jpg') }}" class="tw-h-10">
                <img src="{{ asset('images/sipena.png') }}" class="tw-h-10">
            </div>

            {{-- Heading --}}
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-900 tw-mb-1">
                Daftar Akun <span class="tw-text-[#bd0000]">Sipena</span>
            </h2>
            <p class="tw-text-sm tw-text-gray-600 tw-mb-8">
                Silahkan isi data dengan benar
            </p>

            <form method="POST" action="{{ route('register') }}" class="tw-space-y-4">
                @csrf

                {{-- Role --}}
                <div>
                    <x-input-label for="role" value="Role" class="tw-font-semibold" />
                    <select id="role" name="role"
                        class="tw-block tw-w-full tw-mt-1 tw-rounded-full tw-border tw-border-gray-300 tw-text-sm tw-py-3 tw-px-4 
                               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]">
                        <option disabled selected role="alert">Pilih Role</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Foreign ID --}}
                <div>
                    <x-input-label for="foreignid" value="NIM / Kode Dosen" class="tw-font-semibold" />
                    <x-text-input id="foreignid"
                        class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4
                               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                        type="number" name="foreignid" :value="old('foreignid')" placeholder="Masukkan NIM / Kode Dosen" required />
                    <x-input-error :messages="$errors->get('foreignid')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- name --}}
                <div>
                    <x-input-label for="name" value="Username" class="tw-font-semibold" />
                    <x-text-input id="name"
                        class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4
                               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                        type="text" name="name" :value="old('name')" placeholder="Masukkan username" required />
                    <x-input-error :messages="$errors->get('name')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" value="Email" class="tw-font-semibold" />
                    <x-text-input id="email"
                        class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4
                               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                        type="email" name="email" :value="old('email')" placeholder="Masukkan email" required />
                    <x-input-error :messages="$errors->get('email')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" value="Password" class="tw-font-semibold" />
                    <div class="tw-relative tw-mt-1">
                        <x-text-input id="password" x-bind:type="showPassword ? 'text' : 'password'" name="password"
                            required
                            class="tw-block tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-pl-4 tw-pr-10
                                   focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                            placeholder="Minimal 8 karakter" />

                        <button type="button" @click="showPassword = ! showPassword"
                            class="tw-absolute tw-inset-y-0 tw-right-4 tw-flex tw-items-center tw-text-gray-400 hover:tw-text-gray-600">
                            <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" class="tw-font-semibold" />
                    <div class="tw-relative tw-mt-1">
                        <x-text-input id="password_confirmation" x-bind:type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation" required
                            class="tw-block tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-pl-4 tw-pr-10
                                   focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                            placeholder="Ulangi password" />

                        <button type="button" @click="showConfirm = ! showConfirm"
                            class="tw-absolute tw-inset-y-0 tw-right-4 tw-flex tw-items-center tw-text-gray-400 hover:tw-text-gray-600">
                            <i class="fa-solid" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="tw-w-full tw-bg-[#bd0000] hover:tw-bg-[#9f0000] tw-text-white tw-font-semibold
                           tw-py-3 tw-rounded-full tw-shadow-md tw-transition">
                    Buat Akun
                </button>

                <p class="tw-text-center tw-text-sm tw-text-gray-600 tw-mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="tw-text-[#bd0000] tw-font-semibold hover:tw-underline">
                        Login disini
                    </a>
                </p>

            </form>

        </div>

    </div>
</x-guest-layout>
