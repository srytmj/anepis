@extends('layouts.app')

@section('content')
    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-p-5">

        {{-- Header --}}
        <div class="tw-mb-8">
            <h1 class="tw-text-2xl tw-font-bold tw-text-gray-800">Dashboard Asprak</h1>
            <p class="tw-text-gray-600">Halo, {{ $student->name }}. Kelola jadwal dan cek status lamaranmu disini.</p>
        </div>

        <div class="tw-grid tw-grid-cols-1 tw-gap-8">

            {{-- CARD 1: Input Jadwal --}}
            <div class="tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">
                <div class="tw-mb-5 tw-border-b tw-pb-3">
                    <h2 class="tw-text-xl tw-font-semibold">Input Jadwal Kesibukan</h2>
                    <p class="tw-text-sm tw-text-gray-500">Masukkan jadwal kuliah agar tidak bentrok.</p>
                </div>

                @if (session('success'))
                    <div class="tw-bg-green-100 tw-text-green-700 tw-p-3 tw-rounded tw-mb-4 tw-border tw-border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('asprak.schedule.store') }}" method="POST" class="tw-mb-6">
                    @csrf
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-5 tw-gap-4 tw-items-end">

                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Hari</label>
                            <select name="day"
                                class="tw-w-full tw-border tw-border-gray-300 tw-rounded tw-p-2 focus:tw-outline-none focus:tw-border-blue-500">
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                            </select>
                        </div>

                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Jam Mulai</label>
                            <input type="time" name="start_time"
                                class="tw-w-full tw-border tw-border-gray-300 tw-rounded tw-p-2 focus:tw-outline-none focus:tw-border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Jam Selesai</label>
                            <input type="time" name="end_time"
                                class="tw-w-full tw-border tw-border-gray-300 tw-rounded tw-p-2 focus:tw-outline-none focus:tw-border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">Kegiatan</label>
                            <input type="text" name="activity_name" placeholder="Contoh: Kuliah PBO"
                                class="tw-w-full tw-border tw-border-gray-300 tw-rounded tw-p-2 focus:tw-outline-none focus:tw-border-blue-500"
                                required>
                        </div>

                        <div>
                            <button type="submit"
                                class="tw-w-full tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-blue-700 tw-transition">
                                + Tambah
                            </button>
                        </div>
                    </div>
                </form>

                {{-- List Jadwal Tersimpan --}}
                {{-- List Jadwal Tersimpan --}}
                @if ($student->schedules->count() > 0)
                    <div class="tw-mt-6 tw-border-t tw-pt-4">
                        <h4 class="tw-text-xs tw-font-bold tw-text-gray-500 tw-uppercase tw-mb-3">Jadwal Terdaftar</h4>

                        <div class="tw-flex tw-flex-wrap tw-gap-3">
                            @foreach ($student->schedules as $schedule)
                                <div
                                    class="tw-inline-flex tw-items-center tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-700 tw-px-3 tw-py-2 tw-rounded-md tw-text-sm tw-shadow-sm">

                                    {{-- Info Jadwal --}}
                                    <div class="tw-flex tw-items-center">
                                        <span class="tw-font-bold tw-mr-2 tw-text-blue-600">{{ $schedule->day }}</span>
                                        <span class="tw-text-gray-600">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </span>
                                        <span class="tw-mx-2 tw-text-gray-300">|</span>
                                        <span class="tw-font-medium">{{ $schedule->activity_name }}</span>
                                    </div>

                                    {{-- Tombol Hapus (X) --}}
                                    <form action="{{ route('asprak.schedule.destroy', $schedule->id) }}" method="POST"
                                        class="tw-ml-3 tw-flex tw-items-center"
                                        onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="tw-text-gray-400 hover:tw-text-red-500 tw-transition tw-duration-150"
                                            title="Hapus Jadwal">
                                            {{-- Icon SVG X (Cross) --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="tw-w-4 tw-h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- CARD 2: Status Lamaran (Style Tabel Referensi) --}}
            <div class="tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">
                <div class="tw-mb-5 tw-flex tw-justify-between tw-items-center">
                    <h2 class="tw-text-xl tw-font-semibold">Status Lamaran</h2>
                </div>

                <div class="tw-overflow-x-auto">
                    {{-- Menggunakan style table persis seperti referensi --}}
                    <table class="tw-w-full tw-text-sm tw-border-collapse">
                        <thead class="tw-bg-gray-100 tw-text-gray-700">
                            <tr>
                                <th class="tw-border tw-p-3 tw-text-left">Mata Kuliah</th>
                                <th class="tw-border tw-p-3 tw-text-left">Kode</th>
                                <th class="tw-border tw-p-3 tw-text-left">Tanggal Apply</th>
                                <th class="tw-border tw-p-3 tw-text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->applications as $app)
                                <tr class="hover:tw-bg-gray-50">
                                    <td class="tw-border tw-p-3 tw-font-medium">
                                        {{ $app->vacancy->course->course_name ?? 'Matkul Terhapus' }}
                                    </td>
                                    <td class="tw-border tw-p-3">
                                        {{ $app->vacancy->course->course_code ?? '-' }}
                                    </td>
                                    <td class="tw-border tw-p-3">
                                        {{ $app->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="tw-border tw-p-3 tw-text-center">
                                        @php
                                            // Logic Warna Badge
                                            $badgeClass = match ($app->status) {
                                                'accepted' => 'tw-bg-green-100 tw-text-green-800',
                                                'rejected' => 'tw-bg-red-100 tw-text-red-800',
                                                default => 'tw-bg-yellow-100 tw-text-yellow-800',
                                            };
                                        @endphp
                                        <span
                                            class="tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-semibold {{ $badgeClass }}">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="tw-text-center tw-text-gray-500 tw-py-6 tw-border">
                                        Kamu belum melamar lowongan apapun.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
