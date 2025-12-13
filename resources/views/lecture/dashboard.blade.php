@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-p-5">

        <div class="tw-mb-8">
            <h1 class="tw-text-2xl tw-font-bold tw-text-gray-800">Dashboard Dosen</h1>
            <p class="tw-text-gray-600">Seleksi Calon Asisten Praktikum</p>
        </div>

        @if(session('success'))
            <div class="tw-bg-green-100 tw-text-green-700 tw-p-3 tw-rounded tw-mb-5 tw-border tw-border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="tw-bg-white tw-rounded-lg tw-shadow-sm tw-overflow-hidden">
            <div class="tw-overflow-x-auto">
                <table class="tw-w-full tw-text-sm tw-border-collapse">
                    <thead class="tw-bg-gray-800 tw-text-white">
                        <tr>
                            <th class="tw-p-4 tw-text-left">Mahasiswa</th>
                            <th class="tw-p-4 tw-text-left">Posisi Dilamar</th>
                            <th class="tw-p-4 tw-text-left tw-w-1/3">Cek Bentrok Jadwal</th>
                            <th class="tw-p-4 tw-text-center">Status</th>
                            <th class="tw-p-4 tw-text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tw-divide-y tw-divide-gray-200">
                        @forelse($applicants as $app)
                            <tr class="hover:tw-bg-gray-50 tw-transition">

                                {{-- 1. Info Mahasiswa --}}
                                <td class="tw-p-4 tw-align-top">
                                    <div class="tw-font-bold tw-text-gray-900">{{ $app->student->name }}</div>
                                    <div class="tw-text-xs tw-text-gray-500">{{ $app->student->studentid }}</div>
                                    <div class="tw-text-xs tw-text-gray-500">{{ $app->student->email }}</div>
                                    @if($app->student->transcript)
                                        <a href="#" class="tw-text-xs tw-text-blue-600 tw-underline tw-mt-1 tw-block">Lihat
                                            Transkrip</a>
                                    @endif
                                </td>

                                {{-- 2. Info Lowongan --}}
                                <td class="tw-p-4 tw-align-top">
                                    <div class="tw-font-semibold tw-text-blue-800">
                                        {{ $app->vacancy->course->course_name }}
                                    </div>
                                    <div class="tw-text-xs tw-text-gray-500">
                                        Kode: {{ $app->vacancy->course->course_code }}
                                    </div>
                                    <div class="tw-mt-2">
                                        <span class="tw-text-[10px] tw-uppercase tw-tracking-wider tw-text-gray-400">Jadwal
                                            Praktikum:</span>
                                        <ul class="tw-mt-1">
                                            @foreach($app->vacancy->course->schedules as $cSchedule)
                                                <li class="tw-text-xs tw-font-medium tw-text-gray-700">
                                                    • {{ $cSchedule->day }},
                                                    {{ \Carbon\Carbon::parse($cSchedule->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($cSchedule->end_time)->format('H:i') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>

                                {{-- 3. Cek Bentrok (Jadwal Mahasiswa) --}}
                                <td class="tw-p-4 tw-align-top">
                                    <div class="tw-bg-yellow-50 tw-p-3 tw-rounded tw-border tw-border-yellow-100">
                                        <div class="tw-text-xs tw-font-bold tw-text-yellow-800 tw-mb-2 tw-uppercase">Jadwal
                                            Sibuk Mahasiswa:</div>

                                        @if($app->student->schedules->count() > 0)
                                            <div class="tw-flex tw-flex-wrap tw-gap-2">
                                                @foreach($app->student->schedules as $sSchedule)
                                                    @php
                                                        // Logic Sederhana Highlight Bentrok (Visual Only)
                                                        // Kita cek apakah Hari mahasiswa sama dengan Hari Praktikum
                                                        $isConflict = false;
                                                        foreach ($app->vacancy->course->schedules as $cs) {
                                                            if ($cs->day == $sSchedule->day) {
                                                                $isConflict = true; // Jika harinya sama, kita tandai merah
                                                            }
                                                        }
                                                        $bgClass = $isConflict ? 'tw-bg-red-100 tw-text-red-700 tw-border-red-200' : 'tw-bg-white tw-text-gray-600 tw-border-gray-200';
                                                    @endphp

                                                    <span
                                                        class="tw-inline-block tw-px-2 tw-py-1 tw-rounded tw-text-xs tw-border {{ $bgClass }}">
                                                        <b>{{ $sSchedule->day }}</b> <br>
                                                        {{ \Carbon\Carbon::parse($sSchedule->start_time)->format('H:i') }} -
                                                        {{ \Carbon\Carbon::parse($sSchedule->end_time)->format('H:i') }}
                                                        <div class="tw-text-[10px] tw-italic">{{ $sSchedule->activity_name }}</div>
                                                    </span>
                                                @endforeach
                                            </div>
                                            <div class="tw-mt-2 tw-text-[10px] tw-text-gray-400">
                                                *Merah = Hari sama dengan jadwal praktikum (Cek jamnya)
                                            </div>
                                        @else
                                            <span class="tw-text-xs tw-text-gray-400 tw-italic">Mahasiswa belum input jadwal.</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- 4. Status --}}
                                <td class="tw-p-4 tw-align-middle tw-text-center">
                                    @php
                                        $badge = match ($app->status) {
                                            'accepted' => 'tw-bg-green-100 tw-text-green-800',
                                            'rejected' => 'tw-bg-red-100 tw-text-red-800',
                                            default => 'tw-bg-gray-100 tw-text-gray-800',
                                        };
                                    @endphp
                                    <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-bold {{ $badge }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>

                                {{-- 5. Aksi --}}
                                <td class="tw-p-4 tw-align-middle tw-text-center">
                                    <div class="tw-flex tw-justify-center tw-items-center tw-gap-2">

                                        {{-- TOMBOL LIHAT TRANSKRIP (MODAL) --}}
                                        @if($app->student->transcript)
                                            {{-- Cari bagian tombol Lihat Transkrip yang tadi --}}
                                            <button type="button"
                                                onclick="openPdfModal('{{ route('transcript.preview', $app->student->id) }}')"
                                                class="tw-bg-blue-500 hover:tw-bg-blue-600 tw-text-white tw-p-2 tw-rounded tw-shadow"
                                                title="Lihat Transkrip">
                                                {{-- Ikon mata --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        @endif

                                        @if($app->status === 'pending')
                                            {{-- Tombol Terima --}}
                                            <form action="{{ route('lecturer.application.update', $app->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit"
                                                    class="tw-bg-green-600 hover:tw-bg-green-700 tw-text-white tw-p-2 tw-rounded tw-shadow"
                                                    title="Terima">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>

                                            {{-- Tombol Tolak --}}
                                            <form action="{{ route('lecturer.application.update', $app->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menolak mahasiswa ini?')">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit"
                                                    class="tw-bg-red-600 hover:tw-bg-red-700 tw-text-white tw-p-2 tw-rounded tw-shadow"
                                                    title="Tolak">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @elseif($app->status !== 'pending' && !$app->student->transcript)
                                            <span class="tw-text-xs tw-text-gray-400">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="tw-text-center tw-p-10 tw-text-gray-500">
                                    Belum ada mahasiswa yang melamar di mata kuliah Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openPdfModal(url) {
            // 1. Ambil elemen object
            const pdfObject = document.getElementById('pdfPreview');

            // 2. Set atribut 'data' dengan URL dari controller
            pdfObject.setAttribute('data', url);

            // 3. Update link fallback (jaga-jaga kalau preview gagal)
            const downloadLink = document.getElementById('downloadLink'); // Tombol di footer modal
            const fallbackLink = document.getElementById('fallbackLink'); // Link di tengah layar

            if (downloadLink) downloadLink.href = url;
            if (fallbackLink) fallbackLink.href = url;

            // 4. Munculkan Modal
            const modal = document.getElementById('pdfModal');
            modal.classList.remove('tw-hidden');
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const pdfObject = document.getElementById('pdfPreview');

            // Sembunyikan modal
            modal.classList.add('tw-hidden');

            // Reset data agar memori lepas (penting!)
            pdfObject.setAttribute('data', '');
        }
    </script>

    {{-- MODAL COMPONENT --}}
    <div id="pdfModal" class="tw-fixed tw-inset-0 tw-z-50 tw-hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">

        {{-- 1. Backdrop (Latar Gelap) --}}
        {{-- Pastikan ini menutupi seluruh layar --}}
        <div class="tw-fixed tw-inset-0 tw-bg-gray-900 tw-bg-opacity-75 tw-transition-opacity" onclick="closePdfModal()">
        </div>

        {{-- 2. Posisi Modal (Tengah Layar) --}}
        <div class="tw-fixed tw-inset-0 tw-z-10 tw-overflow-y-auto">
            <div class="tw-flex tw-min-h-full tw-items-center tw-justify-center tw-p-4 tw-text-center sm:tw-p-0">

                {{-- 3. Kotak Putih Modal --}}
                <div
                    class="tw-relative tw-transform tw-overflow-hidden tw-rounded-lg tw-bg-white tw-text-left tw-shadow-xl tw-transition-all sm:tw-my-8 sm:tw-w-full sm:tw-max-w-4xl">

                    {{-- Header Modal --}}
                    <div class="tw-bg-gray-50 tw-px-4 tw-py-3 tw-flex tw-justify-between tw-items-center tw-border-b">
                        <h3 class="tw-text-lg tw-font-bold tw-text-gray-900">
                            Preview Transkrip
                        </h3>
                        <button type="button" onclick="closePdfModal()" class="tw-text-gray-400 hover:tw-text-gray-600">
                            <svg class="tw-h-6 tw-w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- BODY MODAL (PENTING: Tinggi diatur disini) --}}
                    {{-- tw-h-[70vh] artinya tinggi area ini 70% dari tinggi layar monitor --}}
                    <div class="tw-relative tw-w-full tw-h-[70vh] tw-bg-gray-100">

                        {{-- Tag Object untuk PDF --}}
                        <object id="pdfPreview" type="application/pdf" data="" class="tw-w-full tw-h-full tw-block">

                            {{-- Fallback jika PDF gagal load --}}
                            <div
                                class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full tw-text-gray-500 tw-gap-2">
                                <p>Preview tidak tersedia.</p>
                                <a id="fallbackLink" href="#" target="_blank"
                                    class="tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-blue-700">
                                    Download File PDF
                                </a>
                            </div>
                        </object>

                    </div>

                    {{-- Footer Modal --}}
                    <div class="tw-bg-gray-50 tw-px-4 tw-py-3 tw-flex tw-flex-row-reverse tw-gap-2 tw-border-t">
                        <a id="downloadLink" href="#" target="_blank"
                            class="tw-inline-flex tw-justify-center tw-rounded-md tw-bg-blue-600 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-white tw-shadow-sm hover:tw-bg-blue-700">
                            Download PDF
                        </a>
                        <button type="button" onclick="closePdfModal()"
                            class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-gray-300 tw-bg-white tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-50">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection