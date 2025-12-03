@extends('layouts.app')

@section('content')
<div class="tw-max-w-4xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6 relative">

    {{-- Tombol Kembali + Tutup Deadline --}}
    <div class="tw-grid tw-grid-cols-2 tw-items-center tw-mb-6">

        {{-- Kiri: Kembali ke Dashboard --}}
        <div class="tw-text-left">
            <a href="{{ route('dashboard') }}" 
               class="tw-bg-red-500 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-gray-600">
                <i class="fa fa-angle-left"></i>Kembali
            </a>
        </div>

        {{-- Kanan: Tutup Deadline --}}
        <div class="tw-text-right">
            <div class="tw-text-black tw-px-3 tw-py-1 tw-rounded">
                Batas Melamar {{ $vacancy->close_date ? \Carbon\Carbon::parse($vacancy->close_date)->format('d M Y') : '-' }}
            </div>
        </div>

    </div>

    {{-- Judul Course --}}
    <div class="tw-flex tw-items-center tw-gap-2 tw-mb-6">
        <img src="{{ asset('images/document.png') }}" alt="Course" class="tw-h-8">
        <h2 class="tw-text-red-600 tw-text-2xl tw-font-bold">{{ $vacancy->course->course_name }}</h2>
    </div>

    {{-- Info Grid --}}
    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4 tw-mb-6">

        {{-- Dosen --}}
        <div class="tw-p-4 tw-bg-gray-100 tw-rounded">
            <p class="tw-font-semibold tw-mb-2">
                <img src="{{ asset('images/people.png') }}" class="tw-inline tw-h-5 tw-mr-1" alt="Dosen"> Dosen Pengampu:
            </p>
            @if($vacancy->course->lecturers->isNotEmpty())
                @foreach($vacancy->course->lecturers as $lec)
                    <p>[<b>{{ $lec->nidn }}</b>] {{ $lec->name }}</p>
                @endforeach
            @else
                <p class="tw-text-gray-500">Belum ada dosen</p>
            @endif
        </div>

        {{-- Slot / Quota --}}
        <div class="tw-p-4 tw-bg-gray-100 tw-rounded">
            <p class="tw-font-semibold tw-mb-2">
                <img src="{{ asset('images/people.png') }}" class="tw-inline tw-h-5 tw-mr-1" alt="Slot"> Slot / Quota:
            </p>
            <p>{{ $vacancy->quota }} mahasiswa</p>
        </div>

        {{-- Program Studi --}}
        <div class="tw-p-4 tw-bg-gray-100 tw-rounded">
            <p class="tw-font-semibold tw-mb-2">
                <img src="{{ asset('images/toga.png') }}" class="tw-inline tw-h-5 tw-mr-1" alt="Program Studi"> Program Studi:
            </p>
            <p>{{ $vacancy->course->major ?? '-' }}</p>
        </div>

        {{-- Jadwal --}}
        <div class="tw-p-4 tw-bg-gray-100 tw-rounded">
            <p class="tw-font-semibold tw-mb-2">
                <img src="{{ asset('images/schedule.png') }}" class="tw-inline tw-h-5 tw-mr-1" alt="Jadwal"> Jadwal Mata Kuliah:
            </p>
            @if($vacancy->course->schedules->isNotEmpty())
                <ul class="tw-list-disc tw-ml-5 tw-text-gray-700">
                    @foreach($vacancy->course->schedules as $sch)
                        <li>{{ $sch->day }} | {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}</li>
                    @endforeach
                </ul>
            @else
                <p class="tw-text-gray-500">Belum ada jadwal</p>
            @endif
        </div>

    </div>

    {{-- Tombol Apply --}}
    @auth
        @if(auth()->user()->role === 'student')
            @php
                $applied = \App\Models\ApplyVacancy::where('vacancy_id', $vacancy->id)
                    ->where('student_id', auth()->user()->student->id)
                    ->exists();
            @endphp

            <div class="tw-text-center tw-mb-6">
                @if($applied)
                    <button class="tw-bg-gray-400 tw-text-white tw-px-6 tw-py-2 tw-rounded" disabled>
                        Sudah Apply
                    </button>
                @else
                    <form action="{{ route('vacancy.apply', $vacancy->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-6 tw-py-2 tw-rounded hover:tw-bg-red-700">
                            Tambahkan Lamaran
                        </button>
                    </form>
                @endif
            </div>
        @endif
    @endauth

    {{-- Deskripsi, Requirement & Benefit --}}
    <div class="tw-space-y-6">

        <div>
            <h3 class="tw-font-semibold tw-mb-2">Deskripsi Lowongan</h3>
            <p class="tw-text-gray-700 tw-whitespace-pre-line">{{ $vacancy->description ?? '-' }}</p>
        </div>

        <div>
            <h3 class="tw-font-semibold tw-mb-2">Requirement</h3>
            <p class="tw-text-gray-700 tw-whitespace-pre-line">{{ $vacancy->requirement ?? '-' }}</p>
        </div>

        <div>
            <h3 class="tw-font-semibold tw-mb-2">Benefit</h3>
            <p class="tw-text-gray-700 tw-whitespace-pre-line">{{ $vacancy->benefit ?? '-' }}</p>
        </div>

    </div>
</div>
@endsection
