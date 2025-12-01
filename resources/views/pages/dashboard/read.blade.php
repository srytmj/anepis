@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="tw-max-w-7xl tw-mx-auto tw-px-6 tw-py-20 tw-grid md:tw-grid-cols-2 tw-gap-10 tw-items-center">

        {{-- Left text --}}
        <div>
            <h1 class="tw-text-6xl tw-font-extrabold tw-leading-tight tw-mb-4">
                Selamat Datang di
                <span class="tw-text-red-600">Sipena!</span>
            </h1>

            <p class="tw-text-gray-700 tw-text-lg tw-leading-relaxed">
                Tingkatkan peluangmu dengan mencari posisi asisten praktikum yang sesuai dengan minatmu dan manfaatkan
                kemudahan dalam proses pendaftaran untuk menjadi asisten praktikum yang kamu inginkan.
            </p>

            {{-- Search Bar --}}
            <div class="tw-mt-10 tw-max-w-2xl tw-w-full">

                {{-- Input Search --}}
                <div class="tw-flex tw-items-center tw-bg-white tw-rounded-full tw-shadow tw-px-4 tw-w-full">
                    <i class="fa-solid fa-magnifying-glass tw-text-gray-500"></i>
                    <input type="text" class="tw-w-full tw-ml-2 tw-py-3 tw-outline-none tw-border-none"
                        placeholder="Mau daftar AsPrak mata kuliah apa?">
                </div>

                {{-- Dropdown + Button --}}
                <div class="tw-flex tw-items-center tw-gap-3 tw-mt-4">

                    {{-- Dropdown --}}
                    <div class="tw-bg-white tw-rounded-full tw-shadow tw-flex tw-items-center tw-px-4 tw-w-full md:tw-w-40">
                        <select
                            class="tw-w-full tw-bg-transparent tw-text-gray-600 tw-outline-none tw-border-none tw-appearance-none tw-py-2.5 focus:tw-ring-0">
                            <option selected disabled>Semester</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>


                    {{-- Button Cari --}}
                    <button
                        class="tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-font-semibold tw-px-8 tw-py-2.5 tw-rounded-full tw-shadow tw-whitespace-nowrap">
                        Cari
                    </button>
                </div>

            </div>

        </div>

        {{-- Illustration --}}
        <div class="tw-flex tw-justify-center">
            <img src="/images/hero.png" class="tw-w-[90%] md:tw-w-full tw-border-[2px]">
        </div>

    </section>


    {{-- Title --}}
    <div class="tw-text-center tw-mt-20">
        <h2 class="tw-text-3xl tw-font-bold">Lowongan Asprak Untuk Kamu</h2>
        <p class="tw-text-gray-500 tw-mt-2">Temukan lowongan asprak yang kamu minati!</p>
    </div>


    {{-- Card Grid --}}
    <div
        class="tw-max-w-7xl tw-mx-auto tw-px-6 tw-mt-12 tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">

        @foreach (range(1, 9) as $item)
            <div class="tw-bg-white tw-rounded-2xl tw-shadow tw-p-6 hover:tw-shadow-lg tw-transition">

                {{-- Title + Icon --}}
                <div class="tw-flex tw-gap-3 tw-items-center">
                    <img src="/images/document.png" class="tw-h-10" alt="Mata Kuliah">
                    <h3 class="tw-font-bold tw-text-red-500 tw-leading-tight">
                        Analisis Perancangan Sistem Informasi
                    </h3>
                </div>

                <hr class="tw-border-gray-200 tw-my-3">

                {{-- Asprak --}}
                <div class="tw-flex tw-items-center tw-gap-3">
                    <img src="/images/people.png" class="tw-h-8 tw-w-8 tw-rounded-full tw-object-cover" alt="Asprak">

                    <div>
                        <p class="tw-font-medium tw-text-gray-800">AAG</p>
                        <p class="tw-text-sm tw-text-gray-500">Anak Agung Gde Agung</p>
                    </div>
                </div>

                {{-- Jadwal --}}
                <div class="tw-flex tw-items-center tw-gap-3 tw-mt-4 tw-text-gray-600">
                    <img src="/images/schedule.png" class="tw-h-8 tw-w-8 tw-object-cover" alt="Jadwal">
                    <div>
                        <p class="tw-font-medium tw-text-gray-800">Senin, Rabu, Jumat</p>
                        <p class="tw-text-sm tw-text-gray-500">13.00 - 15.00 WIB</p>
                    </div>
                </div>

                <button
                    class="tw-w-full tw-bg-red-400 tw-text-white tw-py-2 tw-rounded-full tw-mt-5 hover:tw-bg-red-500 tw-duration-200">
                    Detail
                </button>
            </div>
        @endforeach

    </div>
@endsection
