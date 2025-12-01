<nav class="tw-w-full tw-bg-white tw-shadow-sm tw-fixed tw-top-0 tw-z-50">
    <div class="tw-max-w-7xl tw-mx-auto tw-px-6 tw-py-4 tw-flex tw-justify-between tw-items-center">

        {{-- Logo --}}
        <a href="/" class="tw-flex tw-gap-3 tw-items-center">
            <img src="/images/telu.jpg" class="tw-h-8">
            <img src="/images/sipena.png" class="tw-h-7">
        </a>

        {{-- Menu Desktop --}}
        <ul class="tw-hidden md:tw-flex tw-gap-8 tw-font-medium">
            <li><a href="#" class="hover:tw-text-red-600 tw-transition">Status Saya</a></li>
            <li><a href="#" class="hover:tw-text-red-600 tw-transition">Kontak Kami</a></li>
        </ul>

        {{-- User Menu --}}
        <div class="tw-flex tw-items-center tw-gap-4 tw-text-red-600 tw-font-semibold">

            {{-- Nama User --}}
            <div class="tw-flex tw-items-center tw-gap-2">
                <i class="fa-solid fa-user"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="tw-text-red-600 hover:tw-text-red-700 tw-transition" title="Logout">
                    <i class="fa-solid fa-right-from-bracket tw-text-lg"></i>
                </button>
            </form>

        </div>


        {{-- Mobile Button --}}
        <button id="navToggle" class="md:tw-hidden tw-text-red-600">
            <i class="fa-solid fa-bars tw-text-2xl"></i>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="tw-hidden tw-bg-white tw-shadow-inner tw-px-6 tw-pb-4 md:tw-hidden">
        <ul class="tw-flex tw-flex-col tw-gap-4 tw-font-medium">
            <li><a href="#" class="hover:tw-text-red-600 tw-transition">Status Saya</a></li>
            <li><a href="#" class="hover:tw-text-red-600 tw-transition">Kontak Kami</a></li>

            {{-- User Mobile --}}
            <li class="tw-text-red-600 tw-font-semibold tw-flex tw-items-center tw-gap-2">
                <i class="fa-solid fa-user"></i>
                {{ Auth::check() ? Auth::user()->name : 'Guest' }}
            </li>
        </ul>
    </div>
</nav>
