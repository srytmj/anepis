<x-guest-layout>
    <div class="tw-flex tw-min-h-screen tw-bg-white">

        {{-- Illustration --}}
        <div class="tw-hidden lg:tw-flex lg:tw-w-1/2 tw-items-center tw-justify-center tw-p-10">
            <img src="{{ asset('images/hero-login.png') }}" alt="Login Illustration"
                class="tw-max-w-[80%] tw-h-auto tw-object-contain">
        </div>

        {{-- Form Wrapper --}}
        <div class="tw-w-full lg:tw-w-1/2 tw-flex tw-flex-col tw-justify-center tw-px-8 md:tw-px-20 tw-py-12">

            {{-- Logo --}}
            <div class="tw-flex tw-items-center tw-gap-3 tw-mb-6">
                <img src="{{ asset('images/telu.jpg') }}" alt="Logo Telkom" class="tw-h-10">
                <img src="{{ asset('images/sipena.png') }}" alt="Logo Sipena" class="tw-h-10">
            </div>

            {{-- Form Card --}}
            <div class="tw-bg-[#FFE4E9] tw-rounded-xl tw-shadow-lg tw-px-8 md:tw-px-12 tw-py-10">

                {{-- Heading --}}
                <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-mb-1">
                    Reset <span class="tw-text-[#bd0000]">Password</span>
                </h2>
                <p class="tw-text-sm tw-text-gray-600 tw-mb-6">
                    Link reset password akan dikirimkan melalui email Anda
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="tw-mb-3" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" value="Email" class="tw-font-semibold" />
                        <x-text-input id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus
                            class="tw-block tw-mt-1 tw-w-full tw-rounded-full tw-border tw-border-gray-300 tw-py-3 tw-px-4
                                   focus:tw-border-[#bd0000] focus:tw-ring-[#bd0000]"
                            placeholder="example@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="tw-mt-1" />
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="tw-w-full tw-bg-[#bd0000] hover:tw-bg-[#9f0000] tw-text-white tw-font-semibold
                               tw-py-3 tw-rounded-full tw-transition tw-mt-6">
                        Kirim Link Reset Password
                    </button>

                    {{-- Back To Login --}}
                    <div class="tw-text-center tw-text-sm tw-text-gray-700 tw-mt-6">
                        Kembali ke?
                        <a href="{{ route('login') }}" class="tw-font-semibold hover:tw-underline tw-text-[#bd0000]">
                            Halaman Login
                        </a>
                    </div>

                </form>
            </div>

        </div>

    </div>
</x-guest-layout>
