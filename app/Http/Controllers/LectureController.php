<?php

namespace App\Http\Controllers;

use App\Models\lecture;
use App\Http\Requests\StorelectureRequest;
use App\Http\Requests\UpdatelectureRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ApplyVacancy;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }

        $lectures = Lecture::all();
        return view('lecture.index', compact('lectures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lecture.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelectureRequest $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:50|unique:lecture,nidn,' . ($lecture->id ?? ''),
            'name' => 'required|string|max:255',
        ]);

        Lecture::create($request->all());
        return redirect()->route('lecture.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(lecture $lecture)
    {
        // 1. Ambil ID Dosen dari user yang login
        $lectureId = Auth::user()->foreignid; // Asumsi kolom foreignid di users table

        // 2. Query Pelamar
        // Ambil lamaran DIMANA vacancy -> course -> diajar oleh dosen ini
        $applicants = ApplyVacancy::whereHas('vacancy.course.lecturers', function ($q) use ($lectureId) {
            $q->where('lecture.id', $lectureId);
        })
            ->with([
                'student.schedules',        // Jadwal sibuk mahasiswa
                'vacancy.course.schedules', // Jadwal mata kuliah asprak
                'vacancy.course'            // Info matkul
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        // return view('lecture.dashboard', compact('applicants'));
        return response()->json($applicants);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lecture $lecture)
    {
        return view('lecture.edit', compact('lecture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelectureRequest $request, lecture $lecture)
    {
        $request->validate([
            'nidn' => 'required|string|max:50|unique:lecture,nidn,' . ($lecture->id ?? ''),
            'name' => 'required|string|max:255',
        ]);

        $lecture->update($request->all());
        return redirect()->route('lecture.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lecture $lecture)
    {
        $lecture->delete();
        return redirect()->route('lecture.index')->with('success', 'Dosen berhasil dihapus.');
    }

    public function previewTranscript($id)
    {
        // 1. Cari data mahasiswa berdasarkan ID
        $student = Student::findOrFail($id);

        // 2. Cek apakah kolom transcript ada isinya
        if (!$student->transcript) {
            abort(404, 'File transkrip tidak ditemukan di database.');
        }

        // 3. Dapatkan Full Path File
        // Asumsi file tersimpan di disk 'public' (storage/app/public)
        // $student->transcript isinya misal: "transcripts/NamaFileAcak.pdf"
        $path = Storage::disk('public')->path($student->transcript);

        // 4. Cek apakah file fisik benar-benar ada
        if (!file_exists($path)) {
            abort(404, 'File fisik tidak ditemukan di server.');
        }

        // 5. Return Response File (Ini kuncinya!)
        // Laravel otomatis set header 'Content-Type: application/pdf'
        // dan 'Content-Disposition: inline'
        return response()->file($path);
    }
}