@extends('layouts.app')

@section('content')
<div class="tw-max-w-2xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6">

    <h2 class="tw-text-xl tw-font-semibold tw-mb-6 text-center">Tambah Vacancy</h2>

    <form action="{{ route('vacancy.store') }}" method="POST">
        @csrf

        {{-- Course --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Mata Kuliah</label>
            <select name="course_id" class="tw-w-full tw-border tw-p-2 tw-rounded @error('course_id') tw-border-red-500 @enderror" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Quota --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Kuota</label>
            <input type="number" name="quota" value="{{ old('quota') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('quota') tw-border-red-500 @enderror" required>
            @error('quota')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Status</label>
            <select name="status_vac" class="tw-w-full tw-border tw-p-2 tw-rounded @error('status_vac') tw-border-red-500 @enderror" required>
                <option value="open" {{ old('status_vac')=='open'?'selected':'' }}>Buka</option>
                <option value="closed" {{ old('status_vac')=='closed'?'selected':'' }}>Tutup</option>
            </select>
            @error('status_vac')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Close Date --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Tanggal Penutupan</label>
            <input type="date" name="close_date" value="{{ old('close_date') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('close_date') tw-border-red-500 @enderror" required>
            @error('close_date')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Deskripsi</label>
            <textarea name="description" class="tw-w-full tw-border tw-p-2 tw-rounded @error('description') tw-border-red-500 @enderror" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Requirement --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Persyaratan</label>
            <textarea name="requirement" class="tw-w-full tw-border tw-p-2 tw-rounded @error('requirement') tw-border-red-500 @enderror" rows="3">{{ old('requirement') }}</textarea>
            @error('requirement')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- {{-- Benefit --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Benefit</label>
            <textarea name="benefit" class="tw-w-full tw-border tw-p-2 tw-rounded @error('benefit') tw-border-red-500 @enderror" rows="3">{{ old('benefit') }}</textarea>
            @error('benefit')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div> -->

        {{-- Durasi --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Durasi</label>
            <input type="text" name="duration" value="{{ old('duration') }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('duration') tw-border-red-500 @enderror" required>
            @error('duration')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="tw-text-end">
            <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
                Simpan Lowongan
            </button>
        </div>
    </form>
</div>
@endsection
