@extends('layouts.app')

@section('content')
<div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-5">

    <div class="tw-flex tw-justify-between tw-items-center tw-mb-5">
        <h2 class="tw-text-xl tw-font-semibold">Data Lowongan</h2>
        <a href="{{ route('vacancy.create') }}" class="tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-red-700">Tambah Lowongan</a>
    </div>

    <div class="tw-overflow-x-auto">
        <table id="vacancyTable" class="tw-w-full tw-text-sm tw-border-collapse">
            <thead class="tw-bg-gray-100 tw-text-gray-700">
                <tr>
                    <th class="tw-border tw-p-2">No</th>
                    <th class="tw-border tw-p-2">Matakuliah</th>
                    <th class="tw-border tw-p-2">Durasi</th>
                    <th class="tw-border tw-p-2">Kuota</th>
                    <th class="tw-border tw-p-2">Status</th>
                    <th class="tw-border tw-p-2">Batas</th>
                    <th class="tw-border tw-p-2">Deskripsi</th>
                    <th class="tw-border tw-p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vacancies as $vac)
                <tr class="hover:tw-bg-gray-50">
                    <td class="tw-border tw-p-2">{{ $loop->iteration }}</td>
                    <td class="tw-border tw-p-2">{{ $vac->course->course_name }}</td>
                    <td class="tw-border tw-p-2">{{ $vac->duration }}</td>
                    <td class="tw-border tw-p-2">{{ $vac->quota }}</td>
                    <td class="tw-border tw-p-2">{{ ucfirst($vac->status_vac) }}</td>
                    <td class="tw-border tw-p-2">{{ $vac->close_date }}</td>
                    <td class="tw-border tw-p-2">{{ $vac->description ?? '-' }}</td>
                    <td class="tw-border tw-p-2">
                        <div class="tw-flex tw-gap-2">
                            <a href="{{ route('vacancy.edit', $vac->id) }}" class="tw-bg-yellow-500 tw-text-white tw-text-sm tw-px-3 tw-py-1 tw-rounded hover:tw-bg-yellow-600">Edit</a>
                            <form action="{{ route('vacancy.destroy', $vac->id) }}" method="POST" onsubmit="return confirm('Yakin hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button class="tw-bg-red-500 tw-text-white tw-text-sm tw-px-3 tw-py-1 tw-rounded hover:tw-bg-red-600">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="tw-text-center tw-text-gray-500 tw-py-4">Tidak ada data lowongan</td>
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
    $('#vacancyTable').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        language: {
            emptyTable: "Tidak ada data vacancy",
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
