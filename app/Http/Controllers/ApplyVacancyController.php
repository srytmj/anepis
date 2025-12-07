<?php

namespace App\Http\Controllers;

use App\Models\ApplyVacancy;
use App\Http\Requests\StoreApplyVacancyRequest;
use App\Http\Requests\UpdateApplyVacancyRequest;
// use auth facade
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Http\Request;

class ApplyVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'vacancy_id' => 'required|exists:vacancy,id',
            'student_id' => 'nullable|exists:student,id',
        ]);

        $vacancyId = $request->input('vacancy_id');
        $studentId = $request->input('student_id');

        $student = \App\Models\Student::find(id: $studentId);
        
        if (!$student) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai student.');
        }

        // Cek apakah sudah apply sebelumnya
        $alreadyApplied = \App\Models\ApplyVacancy::where('vacancy_id', $vacancyId)
            ->where('student_id', $student->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('info', 'Anda sudah apply lowongan ini.');
        }

        // Simpan apply baru
        \App\Models\ApplyVacancy::create([
            'vacancy_id' => $vacancyId,
            'student_id' => $student->id,
            // 'status' => 'applied',
            // 'applied_at' => now(), // optional
        ]);

        return redirect()->back()->with('success', 'Berhasil apply lowongan!');
        // return response()->json([$student, $vacancyId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyVacancy $applyVacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplyVacancy $applyVacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplyVacancyRequest $request, ApplyVacancy $applyVacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplyVacancy $applyVacancy)
    {
        //
    }
}