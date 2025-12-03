<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestudentRequest $request)
    {
        $data = $request->validate([
            'studentid' => 'required|integer|unique:student,studentid',
            'email' => 'required|email|unique:student,email',
            'name' => 'required|string|max:255',
            'phonenumber' => 'nullable|string|max:20',
            'transcript' => 'nullable|file|mimes:pdf',
            'profilephoto' => 'nullable|image|max:2048',
        ]);

        // Upload files
        if ($request->hasFile('transcript')) {
            $data['transcript'] = $request->file('transcript')->store('transcripts', 'public');
        }

        if ($request->hasFile('profilephoto')) {
            $data['profilephoto'] = $request->file('profilephoto')->store('profilephotos', 'public');
        }

        Student::create($data);

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, student $student)
    {
        $data = $request->validate([
            'studentid' => 'required|integer|unique:student,studentid,' . $student->id,
            'email' => 'required|email|unique:student,email,' . $student->id,
            'name' => 'required|string|max:255',
            'phonenumber' => 'nullable|string|max:20',
            'transcript' => 'nullable|file|mimes:pdf',
            'profilephoto' => 'nullable|image|max:2048',
        ]);

        // Upload files
        if ($request->hasFile('transcript')) {
            if ($student->transcript) {
                Storage::disk('public')->delete($student->transcript);
            }
            $data['transcript'] = $request->file('transcript')->store('transcripts', 'public');
        }

        if ($request->hasFile('profilephoto')) {
            if ($student->profilephoto) {
                Storage::disk('public')->delete($student->profilephoto);
            }
            $data['profilephoto'] = $request->file('profilephoto')->store('profilephotos', 'public');
        }

        $student->update($data);

        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        if ($student->transcript) {
            Storage::disk('public')->delete($student->transcript);
        }
        if ($student->profilephoto) {
            Storage::disk('public')->delete($student->profilephoto);
        }

        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }
}