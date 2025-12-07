<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsprakDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil User ID yang sedang login
        $userId = Auth::id();

        // 2. Cari data Student berdasarkan id (Asumsi: tabel student punya kolom id atau relasi ke user)
        // KASUS A: Jika tabel 'users' dan 'student' terpisah dan direlasikan:
        $student = Student::where('id', auth()->user()->foreignid)
            ->with([
                'schedules',
                'applications.vacancy.course',
            ])
            ->firstOrFail();

        // KASUS B: Jika kamu tidak pakai tabel Users terpisah (Login langsung pakai tabel Student):
        // $student = Student::with(['schedules', 'applications.vacancy.course'])->find($userId);

        return view('asprak.dashboard', compact('student'));
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'activity_name' => 'required',
        ]);

        // PERBAIKAN DISINI:
        // Ambil ID Student langsung dari kolom 'foreignid' milik user yang login
        $studentId = auth()->user()->foreignid;

        // Cek jaga-jaga kalau foreignid kosong
        if (! $studentId) {
            return back()->with('error', 'Akun ini tidak terhubung dengan data Mahasiswa.');
        }

        StudentSchedule::create([
            'student_id' => $studentId, // Langsung pakai variabel ini
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'activity_name' => $request->activity_name,
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Tambahkan method ini di dalam class AsprakDashboardController

    public function destroySchedule($id)
    {
        // Cari jadwal berdasarkan ID
        $schedule = StudentSchedule::findOrFail($id);

        // Keamanan: Pastikan jadwal ini milik student yang sedang login
        if ($schedule->student_id != auth()->user()->foreignid) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus data
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
