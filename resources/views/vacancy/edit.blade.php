@extends('layouts.app')

@section('content')
<div class="tw-max-w-2xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6">

    <h2 class="tw-text-xl tw-font-semibold tw-mb-6 text-center">Edit Vacancy</h2>

    <form action="{{ route('vacancy.update', $vacancy->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Course --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Course</label>
            <select name="course_id" class="tw-w-full tw-border tw-p-2 tw-rounded @error('course_id') tw-border-red-500 @enderror" required>
                <option value="">Pilih Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $vacancy->course_id == $course->id ? 'selected' : '' }}>
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
            <label class="tw-block tw-mb-2">Quota</label>
            <input type="number" name="quota" value="{{ $vacancy->quota }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('quota') tw-border-red-500 @enderror" required>
            @error('quota')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Status</label>
            <select name="status_vac" class="tw-w-full tw-border tw-p-2 tw-rounded @error('status_vac') tw-border-red-500 @enderror" required>
                <option value="open" {{ $vacancy->status_vac=='open'?'selected':'' }}>Open</option>
                <option value="closed" {{ $vacancy->status_vac=='closed'?'selected':'' }}>Closed</option>
            </select>
            @error('status_vac')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Close Date --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Close Date</label>
            <input type="date" name="close_date" value="{{ $vacancy->close_date }}" class="tw-w-full tw-border tw-p-2 tw-rounded @error('close_date') tw-border-red-500 @enderror" required>
            @error('close_date')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Description</label>
            <textarea name="description" class="tw-w-full tw-border tw-p-2 tw-rounded @error('description') tw-border-red-500 @enderror" rows="3">{{ $vacancy->description }}</textarea>
            @error('description')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Requirement --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Requirement</label>
            <textarea name="requirement" class="tw-w-full tw-border tw-p-2 tw-rounded @error('requirement') tw-border-red-500 @enderror" rows="3">{{ $vacancy->requirement }}</textarea>
            @error('requirement')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- {{-- Benefit --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-mb-2">Benefit</label>
            <textarea name="benefit" class="tw-w-full tw-border tw-p-2 tw-rounded @error('benefit') tw-border-red-500 @enderror" rows="3">{{ $vacancy->benefit }}</textarea>
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
            <button type="submit" class="tw-bg-yellow-500 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-yellow-600">
                Update Vacancy
            </button>
        </div>
    </form>
</div>
@endsection
