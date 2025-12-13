@extends('layouts.app')

@section('content')

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">

        <div class="tw-flex tw-justify-between tw-items-center tw-mb-5">
            <h2 class="tw-text-xl tw-font-semibold">Data Matakuliah</h2>

            <a href="{{ route('course.create') }}"
                class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
                Tambah Matakuliah
            </a>
        </div>

        <div class="tw-overflow-x-auto tw-mt-5">
            <table id="courseTable" class="tw-w-full tw-text-sm tw-border-collapse">
                <thead class="tw-bg-gray-100 tw-text-gray-700">
                    <tr>
                        <th class="tw-border tw-p-2">No</th>
                        <th class="tw-border tw-p-2">Kode</th>
                        <th class="tw-border tw-p-2">Matakuliah</th>
                        <th class="tw-border tw-p-2">Jurusan</th>
                        <th class="tw-border tw-p-2">Dosen</th>
                        <th class="tw-border tw-p-2">Jadwal</th>
                        <th class="tw-border tw-p-2" width="150px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($courses as $course)
                        <tr class="hover:tw-bg-gray-50">

                            <td class="tw-border tw-p-2">{{ $loop->iteration }}</td>

                            <td class="tw-border tw-p-2">{{ $course->course_code }}</td>

                            <td class="tw-border tw-p-2">{{ $course->course_name }}</td>

                            <td class="tw-border tw-p-2">{{ $course->major }}</td>
                            
                            {{-- ========= LECTURERS ============ --}}
                            <td class="tw-border tw-p-2">
                                @if ($course->lecturers->isNotEmpty())
                                    <ul class="tw-list-disc tw-ml-4">
                                        @foreach ($course->lecturers as $lec)
                                            <li>[{{ $lec->id }}] {{ $lec->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="tw-text-gray-400">Tidak ada lecturer</span>
                                @endif
                            </td>

                            {{-- ========= SCHEDULES ============ --}}
                            <td class="tw-border tw-p-2">
                                @if ($course->schedules->isNotEmpty())
                                    <ul class="tw-list-disc tw-ml-4">
                                        @foreach ($course->schedules as $sch)
                                            <li>
                                                {{ $sch->day }} |
                                                {{ substr($sch->start_time, 0, 5) }} -
                                                {{ substr($sch->end_time, 0, 5) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="tw-text-gray-400">Belum ada jadwal</span>
                                @endif
                            </td>

                            <td class="tw-border tw-p-2">
                                <div class="tw-flex tw-gap-2 tw-items-center">

                                    <a href="{{ route('course.edit', $course->id) }}"
                                        class="tw-bg-yellow-500 tw-text-white tw-text-sm tw-px-3 tw-py-1 tw-rounded hover:tw-bg-yellow-600">
                                        Ubah
                                    </a>

                                    <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="tw-bg-red-500 tw-text-white tw-text-sm tw-px-3 tw-py-1 tw-rounded hover:tw-bg-red-600">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="" class="tw-text-center tw-text-gray-500 tw-py-4">
                                Tidak ada data Matakuliah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#courseTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 5,
                language: {
                    emptyTable: "Tidak ada data Matakuliah",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        });
    </script>
@endpush
