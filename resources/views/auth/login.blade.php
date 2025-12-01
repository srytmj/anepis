<x-guest-layout>
    <div class="tw-flex tw-min-h-screen tw-bg-white" x-data="{ showPassword: false }">

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
                Selamat Datang di <span class="tw-text-[#bd0000]">Sipena!</span>
            </h2>
            <p class="tw-text-sm tw-text-gray-600 tw-mb-8">
                Silahkan login menggunakan email/username dan password
            </p>

            <x-auth-session-status class="tw-mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="tw-space-y-4">
                @csrf

                {{-- Email --}}
                {{-- <div>
                    <x-input-label for="email" value="Email atau Username" class="tw-font-semibold" />
                    <x-text-input id="email" type="text" name="email" :value="old('email')" required autofocus
                        class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4 
                               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                        placeholder="example@email.com / username" />
                    <x-input-error :messages="$errors->get('email')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div> --}}
                {{-- Email / Username --}}
                <div>
                    <x-input-label for="login" value="Email atau Username" class="tw-font-semibold" />
                    <x-text-input id="login" type="text" name="login" :value="old('login')" required autofocus
                        class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4 
               focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                        placeholder="example@email.com / name" />
                    <x-input-error :messages="$errors->get('login')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>


                {{-- Password --}}
                <div>
                    <x-input-label for="password" value="Password" class="tw-font-semibold" />

                    <div class="tw-relative tw-mt-1">
                        <x-text-input id="password" x-bind:type="showPassword ? 'text' : 'password'" name="password"
                            required
                            class="tw-block tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-pl-4 tw-pr-10 
                                   focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                            placeholder="Masukkan password" />

                        <button type="button" @click="showPassword = !showPassword"
                            class="tw-absolute tw-inset-y-0 tw-right-4 tw-flex tw-items-center tw-text-gray-400 hover:tw-text-gray-600">
                            <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="tw-text-red-500 tw-text-xs tw-mt-1" />
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="tw-w-full tw-bg-[#bd0000] hover:tw-bg-[#9f0000] tw-text-white tw-font-semibold
                           tw-py-3 tw-rounded-full tw-shadow-md tw-transition">
                    Login
                </button>

                {{-- Divider --}}
                <div class="tw-flex tw-items-center tw-my-6">
                    <div class="tw-flex-grow tw-border-t tw-border-gray-300"></div>
                    <span class="tw-mx-3 tw-text-gray-400 tw-text-xs">ATAU</span>
                    <div class="tw-flex-grow tw-border-t tw-border-gray-300"></div>
                </div>

                {{-- Links --}}
                <div class="tw-text-center tw-text-sm tw-text-gray-600 tw-space-y-1">

                    @if (Route::has('password.request'))
                        <div>
                            Lupa Password?
                            <a href="{{ route('password.request') }}"
                                class="tw-text-[#bd0000] tw-font-semibold hover:tw-underline">
                                Reset disini
                            </a>
                        </div>
                    @endif

                    @if (Route::has('register'))
                        <div>
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="tw-text-[#bd0000] tw-font-semibold hover:tw-underline">
                                Daftar sekarang
                            </a>
                        </div>
                    @endif

                </div>

            </form>

        </div>

    </div>
</x-guest-layout>
