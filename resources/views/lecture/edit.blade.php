@extends('layouts.app')

@section('content')
    <div class="tw-max-w-md tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">
        <h2 class="tw-text-lg tw-font-semibold tw-mb-5">Tambah Dosen</h2>

        <form action="{{ route('lecture.update', $lecture->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="tw-mb-4">
                <label class="tw-block tw-mb-2">Nama Dosen</label>
                <input type="text" name="name" value="{{ old('name', $lecture->name) }}"
                    class="tw-w-full tw-border tw-p-2 tw-rounded @error('name') tw-border-red-500 @enderror">
                @error('name')
                    <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="tw-mb-4">
                <label class="tw-block tw-mb-2">Nomor Induk Dosen (NIDN)</label>
                <input type="text" name="nidn" value="{{ old('nidn', $lecture->nidn ?? '') }}"
                    class="tw-w-full tw-border tw-p-2 tw-rounded @error('nidn') tw-border-red-500 @enderror">
                @error('nidn')
                    <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
                Simpan
            </button>
        </form>
    </div>
@endsection
