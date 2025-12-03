<nav class="tw-w-full tw-bg-white tw-shadow-sm tw-fixed tw-top-0 tw-z-50" x-data="{ mobileOpen: false }">
    <div class="tw-max-w-7xl tw-mx-auto tw-px-6 tw-py-4 tw-flex tw-justify-between tw-items-center">

        {{-- Logo --}}
        <a href="/" class="tw-flex tw-gap-3 tw-items-center">
            <img src="/images/telu.jpg" class="tw-h-8" alt="Logo Telkom">
            <img src="/images/sipena.png" class="tw-h-7" alt="Logo Sipena">
        </a>

        {{-- Menu Desktop --}}
        <ul class="tw-hidden md:tw-flex tw-gap-8 tw-font-medium tw-items-center">

            @auth

                {{-- Menu Mahasiswa --}}
                @if (auth()->user()->role === 'mahasiswa')
                    <li><a href="#" class="hover:tw-text-red-600 tw-transition">Status Asprak</a></li>
                @endif

                {{-- Menu Dosen --}}
                @if (auth()->user()->role === 'lecture')
                    <li><a href="#" class="hover:tw-text-red-600 tw-transition">Lihat Pengajuan</a></li>
                    <li><a href="#" class="hover:tw-text-red-600 tw-transition">Validasi</a></li>
                @endif

                {{-- Menu Admin --}}
                @if (auth()->user()->role === 'admin')
                    <li class="tw-relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="tw-flex tw-items-center tw-gap-1 hover:tw-text-red-600 tw-transition">
                            Master Data
                            <i class="fa-solid fa-caret-down"></i>
                        </button>

                        <ul x-show="open" @click.outside="open = false" x-transition
                            class="tw-absolute tw-left-0 tw-mt-2 tw-bg-white tw-rounded-md tw-shadow-md tw-min-w-[160px] tw-py-2 tw-z-50">
                            <li><a href="{{ route('lecture.index') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Data Dosen</a></li>
                            <li><a href="{{ route('course.index') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Data Mata Kuliah</a></li>
                            <li><a href="{{ route('student.index') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Data Asprak</a></li>
                            <li><a href="{{ route('vacancy.index') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Data Lowongan</a></li>
                        </ul>
                    </li>
                @endif

            @endauth

            <li><a href="#" class="hover:tw-text-red-600 tw-transition">Kontak Kami</a></li>
        </ul>

        {{-- User Menu Desktop --}}
        <div class="tw-hidden md:tw-flex tw-items-center tw-gap-4 tw-relative" x-data="{ userOpen: false }">

            <button @click="userOpen = !userOpen"
                class="tw-flex tw-items-center tw-gap-2 tw-text-red-600 tw-font-semibold hover:tw-text-red-700 tw-transition">
                <i class="fa-solid fa-user"></i>
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <i class="fa-solid fa-caret-down"></i>
            </button>

            {{-- Dropdown --}}
            <ul x-show="userOpen" @click.outside="userOpen = false" x-transition
                class="tw-absolute tw-right-0 tw-top-full tw-mt-2 tw-bg-white tw-rounded-md tw-shadow-md tw-min-w-[170px] tw-z-50 tw-py-2">
                <li><a href="#" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Account Settings</a></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="tw-w-full tw-text-left tw-px-4 tw-py-2 hover:tw-bg-gray-100">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>

        </div>


        {{-- Mobile Toggle --}}
        <button @click="mobileOpen = !mobileOpen" class="md:tw-hidden tw-text-red-600">
            <i class="fa-solid fa-bars tw-text-2xl"></i>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" @click.outside="mobileOpen = false" x-transition
        class="tw-bg-white tw-shadow-inner tw-px-6 tw-pb-4 md:tw-hidden">

        <ul class="tw-flex tw-flex-col tw-gap-4 tw-font-medium">

            @auth

                @if (auth()->user()->role === 'mahasiswa')
                    <li><a href="#" class="hover:tw-text-red-600">Status Asprak</a></li>
                @endif

                @if (auth()->user()->role === 'lecture')
                    <li><a href="#" class="hover:tw-text-red-600">Lihat Pengajuan</a></li>
                    <li><a href="#" class="hover:tw-text-red-600">Validasi</a></li>
                @endif

                @if (auth()->user()->role === 'admin')
                    <li x-data="{ openSub: false }">
                        <button @click="openSub = !openSub"
                            class="tw-flex tw-justify-between tw-w-full hover:tw-text-red-600">
                            Master Data
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <ul x-show="openSub" x-transition class="tw-ml-4 tw-flex tw-flex-col tw-gap-2 tw-mt-2">
                            <li><a href="#" class="hover:tw-text-red-600">Data Asprak</a></li>
                            <li><a href="#" class="hover:tw-text-red-600">Data Mata Kuliah</a></li>
                            <li><a href="#" class="hover:tw-text-red-600">Data Dosen</a></li>
                        </ul>
                    </li>
                @endif

                <li class="tw-flex tw-items-center tw-gap-2 tw-text-red-600 tw-font-semibold">
                    <i class="fa-solid fa-user"></i>
                    {{ auth()->user()->name }}
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="hover:tw-text-red-700 tw-text-red-600">Logout</button>
                    </form>
                </li>

            @endauth

            <li><a href="#" class="hover:tw-text-red-600">Kontak Kami</a></li>
        </ul>
    </div>
</nav>
