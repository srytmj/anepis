@extends('layouts.app')

@section('content')
<div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">

    <div class="tw-flex tw-justify-between tw-items-center tw-mb-5">
        <h2 class="tw-text-xl tw-font-semibold">Data Dosen</h2>

        <a href="{{ route('lecture.create') }}"
            class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">
            Tambah Dosen
        </a>
    </div>

    <div class="tw-overflow-x-auto tw-mt-5">
        <table id="lectureTable" class="tw-w-full tw-text-sm tw-border-collapse">
            <thead class="tw-bg-gray-100 tw-text-gray-700">
                <tr>
                    <th class="tw-border tw-p-2">No</th>
                    <th class="tw-border tw-p-2">NIDN</th>
                    <th class="tw-border tw-p-2">Nama Dosen</th>
                    <th class="tw-border tw-p-2" width="150px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($lectures as $lecture)
                <tr class="hover:tw-bg-gray-50">
                    <td class="tw-border tw-p-2">{{ $loop->iteration }}</td>
                    <td class="tw-border tw-p-2">{{ $lecture->nidn }}</td>
                    <td class="tw-border tw-p-2">{{ $lecture->name }}</td>
                    <td class="tw-border tw-p-2">
                        <div class="tw-flex tw-gap-2 tw-items-center">
                            <a href="{{ route('lecture.edit', $lecture->id) }}"
                                class="tw-bg-yellow-500 tw-text-white tw-text-sm tw-px-3 tw-py-1 tw-rounded hover:tw-bg-yellow-600">
                                Ubah
                            </a>

                            <form action="{{ route('lecture.destroy', $lecture->id) }}" method="POST"
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
                    <td colspan="3" class="tw-text-center tw-text-gray-500 tw-py-4">
                        Tidak ada data Dosen
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
    $('#lectureTable').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        language: {
            emptyTable: "Tidak ada data Dosen",
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