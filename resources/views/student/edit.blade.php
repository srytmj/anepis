@extends('layouts.app')

@section('content')
<div class="tw-max-w-2xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6">

    <h2 class="tw-text-lg tw-font-semibold tw-mb-6 tw-text-center">
        {{ isset($student) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}
    </h2>

    <form action="{{ isset($student) ? route('student.update', $student->id) : route('student.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($student)) @method('PUT') @endif

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">NIM</label>
            <input type="text" name="studentid" value="{{ old('studentid', $student->studentid ?? '') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('studentid') tw-border-red-500 @enderror">
            @error('studentid') <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('name') tw-border-red-500 @enderror">
            @error('name') <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('email') tw-border-red-500 @enderror">
            @error('email') <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">No. Telp</label>
            <input type="text" name="phonenumber" value="{{ old('phonenumber', $student->phonenumber ?? '') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('phonenumber') tw-border-red-500 @enderror">
            @error('phonenumber') <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Transkrip (PDF)</label>
            <input type="file" name="transcript" accept="application/pdf" class="tw-w-full tw-border tw-p-2 tw-rounded">
            @if(isset($student) && $student->transcript)
                <a href="{{ asset('storage/' . $student->transcript) }}" target="_blank" class="tw-text-blue-500 tw-text-sm">View current transcript</a>
            @endif
        </div>

        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Foto Profile (Image)</label>
            <input type="file" name="profilephoto" accept="image/*" class="tw-w-full tw-border tw-p-2 tw-rounded">
            @if(isset($student) && $student->profilephoto)
                <img src="{{ asset('storage/' . $student->profilephoto) }}" class="tw-h-20 tw-w-20 tw-rounded-full tw-mt-2" alt="Profile Photo">
            @endif
        </div>

        <div class="tw-text-end tw-mt-4">
            <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
                {{ isset($student) ? 'Update' : 'Create' }}
            </button>
        </div>

    </form>
</div>
@endsection
