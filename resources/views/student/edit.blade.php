@extends('layouts.app')

@section('content')
<div class="tw-max-w-2xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-sm tw-p-6">

    {{-- Judul Dinamis --}}
    <h2 class="tw-text-lg tw-font-semibold tw-mb-6 tw-text-center tw-text-gray-800">
        {{ isset($student) ? 'Edit Data Mahasiswa' : 'Tambah Mahasiswa Baru' }}
    </h2>

    <form action="{{ isset($student) ? route('student.update', $student->id) : route('student.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        
        @csrf
        {{-- Directive @method hanya muncul jika mode Edit --}}
        @if(isset($student)) 
            @method('PUT') 
        @endif

        {{-- === NIM === --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">NIM</label>
            {{-- Gunakan type="number" agar mobile keyboard muncul angka --}}
            <input type="number" name="studentid" 
                   value="{{ old('studentid', $student->studentid ?? '') }}" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500 @error('studentid') tw-border-red-500 @enderror"
                   placeholder="Masukkan NIM (Angka)">
            @error('studentid') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- === NAMA === --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" 
                   value="{{ old('name', $student->name ?? '') }}" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500 @error('name') tw-border-red-500 @enderror"
                   placeholder="Nama Lengkap Mahasiswa">
            @error('name') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- === EMAIL === --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">Email</label>
            <input type="email" name="email" 
                   value="{{ old('email', $student->email ?? '') }}" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500 @error('email') tw-border-red-500 @enderror"
                   placeholder="contoh@email.com">
            @error('email') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- === NO TELP === --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">No. Telp</label>
            <input type="text" name="phonenumber" 
                   value="{{ old('phonenumber', $student->phonenumber ?? '') }}" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500 @error('phonenumber') tw-border-red-500 @enderror"
                   placeholder="08xxxxxxxx">
            @error('phonenumber') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- === TRANSKRIP (PDF) === --}}
        <div class="tw-mb-4">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">Transkrip Nilai (PDF)</label>
            
            {{-- Helper text untuk Edit Mode --}}
            @if(isset($student))
                <p class="tw-text-xs tw-text-gray-500 tw-mb-2">Kosongkan jika tidak ingin mengubah file transkrip.</p>
            @endif

            <input type="file" name="transcript" accept="application/pdf" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded tw-bg-white @error('transcript') tw-border-red-500 @enderror">
            
            @error('transcript') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror

            @if(isset($student) && $student->transcript)
                <div class="tw-mt-2">
                    <a href="{{ asset('storage/' . $student->transcript) }}" target="_blank" 
                       class="tw-inline-flex tw-items-center tw-text-blue-600 hover:tw-underline tw-text-sm">
                        <svg class="tw-w-4 tw-h-4 tw-mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Lihat Transkrip Saat Ini
                    </a>
                </div>
            @endif
        </div>

        {{-- === FOTO PROFILE === --}}
        <div class="tw-mb-6">
            <label class="tw-block tw-font-semibold tw-mb-1 tw-text-gray-700">Foto Profil</label>
            
            @if(isset($student))
                <p class="tw-text-xs tw-text-gray-500 tw-mb-2">Kosongkan jika tidak ingin mengubah foto.</p>
            @endif

            <input type="file" name="profilephoto" accept="image/*" 
                   class="tw-w-full tw-border tw-p-2 tw-rounded tw-bg-white @error('profilephoto') tw-border-red-500 @enderror">
            
            @error('profilephoto') 
                <p class="tw-text-red-500 tw-text-sm tw-mt-1">{{ $message }}</p> 
            @enderror

            @if(isset($student) && $student->profilephoto)
                <div class="tw-mt-3">
                    <p class="tw-text-xs tw-text-gray-500 tw-mb-1">Foto Saat Ini:</p>
                    <img src="{{ asset('storage/' . $student->profilephoto) }}" 
                         class="tw-h-24 tw-w-24 tw-object-cover tw-rounded-lg tw-border tw-border-gray-200 tw-shadow-sm" 
                         alt="Profile Photo">
                </div>
            @endif
        </div>

        {{-- === TOMBOL AKSI === --}}
        <div class="tw-flex tw-justify-end tw-gap-3 tw-mt-6 tw-pt-4 tw-border-t">
            {{-- Tombol Batal/Kembali --}}
            <a href="{{ route('student.index') }}" 
               class="tw-px-4 tw-py-2 tw-rounded tw-bg-gray-200 tw-text-gray-700 hover:tw-bg-gray-300 tw-transition">
                Batal
            </a>

            {{-- Tombol Submit --}}
            <button type="submit" 
                    class="tw-bg-red-600 tw-text-white tw-px-6 tw-py-2 tw-rounded hover:tw-bg-red-700 tw-shadow tw-transition">
                {{ isset($student) ? 'Update Data' : 'Simpan Data' }}
            </button>
        </div>

    </form>
</div>
@endsection