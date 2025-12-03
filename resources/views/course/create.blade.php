@extends('layouts.app')

@section('content')
<div class="tw-max-w-2xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6">

    {{-- TITLE --}}
    <h2 class="tw-text-lg tw-font-semibold tw-mb-6 tw-text-center">Create Matakuliah</h2>

    <form action="{{ route('course.store') }}" method="POST">
        @csrf

        {{-- Course Code --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Kode Matakuliah</label>
            <input type="text" name="course_code" class="tw-w-full tw-border tw-p-2 tw-rounded @error('course_code') tw-border-red-500 @enderror" required>
            @error('course_code')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Course Name --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Matakuliah</label>
            <input type="text" name="course_name" class="tw-w-full tw-border tw-p-2 tw-rounded @error('course_name') tw-border-red-500 @enderror" required>
            @error('course_name')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Major --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1">Jurusan</label>
            <input type="text" name="major" class="tw-w-full tw-border tw-p-2 tw-rounded @error('major') tw-border-red-500 @enderror" required>
            @error('major')
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lecturers --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-2">Dosen</label>

            <input type="text" id="lecturerSearch"
                class="tw-w-full tw-border tw-p-2 tw-rounded tw-mb-2"
                placeholder="Search lecturers...">

            {{-- Search results --}}
            <div id="lecturerResults"
                class="tw-border tw-rounded tw-bg-white tw-shadow-sm tw-p-2 tw-mt-1"
                style="display:none; max-height:150px; overflow-y:auto;">
            </div>

            {{-- Selected badges --}}
            <div id="lecturerSelected" class="tw-mt-2"></div>

            {{-- Hidden --}}
            <div id="lecturerHidden"></div>
        </div>

        {{-- Schedules --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-2">Schedules</label>

            <div id="scheduleContainer"></div>

            <button type="button" id="addScheduleBtn"
                class="tw-bg-transparent tw-border tw-border-blue-500 tw-text-blue-500 tw-px-3 tw-py-1 tw-rounded hover:tw-bg-blue-500 hover:tw-text-white tw-text-sm tw-mt-2">
                + Add Schedule
            </button>
        </div>

        {{-- Template --}}
        <template id="scheduleTemplate">
            <div class="tw-border tw-rounded tw-bg-gray-100 tw-p-3 tw-mb-3 schedule-item">

                <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                    <strong>Schedule</strong>
                    <button type="button" class="removeScheduleBtn tw-bg-red-500 tw-text-white tw-text-xs tw-px-2 tw-py-1 tw-rounded hover:tw-bg-red-600">
                        Remove
                    </button>
                </div>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-3">
                    <div>
                        <label class="tw-block tw-text-sm tw-mb-1">Day</label>
                        <select name="schedule_day[]" class="tw-w-full tw-border tw-rounded tw-p-1 tw-text-sm" required>
                            <option value="">Select Day</option>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                        </select>
                    </div>
                    <div>
                        <label class="tw-block tw-text-sm tw-mb-1">Start</label>
                        <input type="time" name="schedule_start[]" class="tw-w-full tw-border tw-rounded tw-p-1 tw-text-sm" required>
                    </div>
                    <div>
                        <label class="tw-block tw-text-sm tw-mb-1">End</label>
                        <input type="time" name="schedule_end[]" class="tw-w-full tw-border tw-rounded tw-p-1 tw-text-sm" required>
                    </div>
                </div>
            </div>
        </template>

        {{-- Submit --}}
        <div class="tw-text-end tw-mt-4">
            <button type="submit" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
                Simpan
            </button>
        </div>
    </form>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@include('course.lecture')
@include('course.schedule')
@endsection
