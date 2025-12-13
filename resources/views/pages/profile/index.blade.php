@extends('layouts.app')

@section('content')

    <div class="tw-max-w-4xl tw-mx-auto tw-bg-white tw-rounded-lg tw-p-6 tw-mt-10 tw-shadow">

        <h2 class="tw-text-xl tw-font-semibold tw-mb-4">My Profile</h2>

        @if (session('success'))
            <div class="tw-bg-green-100 tw-text-green-700 tw-p-3 tw-rounded tw-mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- NAME (READONLY untuk student & lecture) --}}
            <div class="tw-mb-4">
                <label class="tw-font-medium">Name</label>
                <input type="text" name="name" class="tw-w-full tw-border tw-rounded tw-p-2 bg-gray-100"
                    value="{{ $user->name }}" readonly>
            </div>

            {{-- EMAIL --}}
            <div class="tw-mb-4">
                <label class="tw-font-medium">Email</label>
                <input type="email" name="email" class="tw-w-full tw-border tw-rounded tw-p-2"
                    value="{{ old('email', $user->email) }}">
            </div>

            {{-- ROLE STUDENT --}}
            @if ($user->role === 'student')
                <hr class="tw-my-6">

                <h3 class="tw-text-lg tw-font-semibold tw-mb-3">Informasi Mahasiswa</h3>

                {{-- STUDENT ID --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">NIM</label>
                    <input type="text" class="tw-w-full tw-border tw-rounded tw-p-2 bg-gray-100"
                        value="{{ $user->student->studentid }}" readonly>
                </div>

                {{-- PHONE NUMBER --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">Nomor Telepon</label>
                    <input type="text" name="phonenumber" class="tw-w-full tw-border tw-rounded tw-p-2"
                        value="{{ old('phonenumber', $user->student->phonenumber) }}">
                </div>

                {{-- TRANSCRIPT (FILE) --}}

                <div class="tw-mb-4">
                    <label class="tw-block tw-font-semibold tw-mb-1">Transkrip (PDF)</label>
                    <input type="file" name="transcript" accept="application/pdf" class="tw-w-full tw-border tw-p-2 tw-rounded">
                    @if(isset($user) && $user->student->transcript)
                        <a href="{{ asset('storage/' . $user->student->transcript) }}" target="_blank"
                            class="tw-text-blue-500 tw-text-sm">View current transcript</a>
                    @endif
                </div>

                <div class="tw-mb-4">
                    <label class="tw-block tw-font-semibold tw-mb-1">Foto Profil (Image)</label>
                    <input type="file" name="profilephoto" accept="image/*" class="tw-w-full tw-border tw-p-2 tw-rounded">
                    @if(isset($user) && $user->student->profilephoto)
                        <img src="{{ asset('storage/' . $user->student->profilephoto) }}" class="tw-h-20 tw-w-20 tw-rounded-full tw-mt-2"
                            alt="Profile Photo">
                    @endif
                </div>

            @endif


            {{-- ROLE LECTURE --}}
            @if ($user->role === 'lecture' && $user->lecture)
                <hr class="tw-my-6">

                <h3 class="tw-text-lg tw-font-semibold tw-mb-3">Informasi Dosen</h3>

                {{-- NIDN --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">NIDN</label>
                    <input type="text" class="tw-w-full tw-border tw-rounded tw-p-2 bg-gray-100"
                        value="{{ $user->lecture->nidn }}" readonly>
                </div>
            @endif


            <button type="submit" class="tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded">
                Save
            </button>

        </form>
    </div>

@endsection