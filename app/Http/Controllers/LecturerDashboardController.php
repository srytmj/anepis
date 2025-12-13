<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyVacancy;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil ID Dosen dari user yang login
        $lectureId = Auth::user()->foreignid; // Asumsi kolom foreignid di users table

        // 2. Query Pelamar
        // Ambil lamaran DIMANA vacancy -> course -> diajar oleh dosen ini
        $applicants = ApplyVacancy::whereHas('vacancy.course.lecturers', function($q) use ($lectureId) {
            $q->where('lecture.id', $lectureId);
        })
        ->with([
            'student.schedules',        // Jadwal sibuk mahasiswa
            'vacancy.course.schedules', // Jadwal mata kuliah asprak
            'vacancy.course'            // Info matkul
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('lecture.dashboard', compact('applicants'));
        // return response()->json($applicants);
        // return response()->json("test");
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $application = ApplyVacancy::findOrFail($id);
        
        // Update status
        $application->status = $request->status;
        $application->save();

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }
}