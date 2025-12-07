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

                <h3 class="tw-text-lg tw-font-semibold tw-mb-3">Student Information</h3>

                {{-- STUDENT ID --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">Student ID</label>
                    <input type="text" class="tw-w-full tw-border tw-rounded tw-p-2 bg-gray-100"
                        value="{{ $user->student->studentid }}" readonly>
                </div>

                {{-- PHONE NUMBER --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">Phone Number</label>
                    <input type="text" name="phonenumber" class="tw-w-full tw-border tw-rounded tw-p-2"
                        value="{{ old('phonenumber', $user->student->phonenumber) }}">
                </div>

                {{-- TRANSCRIPT (FILE) --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">Transcript (PDF/DOC)</label><br>
                    <input type="file" name="transcript" class="tw-mt-2">

                    @if ($user->student->transcript)
                        <p class="tw-mt-2">
                            Current: <a href="{{ asset('storage/' . $user->student->transcript) }}" target="_blank"
                                class="tw-text-blue-600">View File</a>
                        </p>
                    @endif
                </div>

                {{-- PROFILE PHOTO --}}
                <div class="tw-mb-4">
                    <label class="tw-font-medium">Profile Photo</label><br>
                    <input type="file" name="profilephoto" class="tw-mt-2">

                    @if ($user->student->profilephoto)
                        <div class="tw-mt-3">
                            <img src="{{ asset('storage/' . $user->student->profilephoto) }}"
                                class="tw-w-32 tw-h-32 tw-rounded-full tw-object-cover">
                        </div>
                    @endif
                </div>
            @endif


            {{-- ROLE LECTURE --}}
            @if ($user->role === 'lecture' && $user->lecture)
                <hr class="tw-my-6">

                <h3 class="tw-text-lg tw-font-semibold tw-mb-3">Lecture Information</h3>

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
