<?php

namespace App\Http\Controllers;

// Models
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Lecture;
use App\Models\User;

//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecourseRequest;
use App\Http\Requests\UpdatecourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }

        $search = $request->search;

        $courses = Course::with(['lecturers', 'schedules'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%$search%")->orWhere('class', 'like', "%$search%");
                });
            })
            ->paginate(5);

        return view('course.index', compact('courses', 'search'));
        // return response()->json([
        //     'courses' => $courses,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lecturers = User::where('role', 'lecture')->get();
        return view('course.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:course,course_code',
            'course_name' => 'required',
            'major' => 'required',

            'lecturers' => 'required|array',

            'schedule_day' => 'required|array',
            'schedule_start' => 'required|array',
            'schedule_end' => 'required|array',
        ]);

        // create course
        $course = Course::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'major'=> $request->major,
        ]);

        // attach lecturers
        $course->lecturers()->attach($request->lecturers);

        // create schedules
        foreach ($request->schedule_day as $i => $day) {
            CourseSchedule::create([
                'course_id' => $course->id,
                'day' => $day,
                'start_time' => $request->schedule_start[$i],
                'end_time' => $request->schedule_end[$i],
            ]);
        }

        return redirect()->route('course.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::with(['lecturers', 'schedules'])->findOrFail($id);
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // --- Update basic data ---
        $course->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'major'=> $request->schedule_start[$id],
        ]);

        // --- Update lecturers ---
        $lecturers = $request->lecturers ?? [];
        $course->lecturers()->sync($lecturers);

        // --- Update schedules ---
        $days = $request->schedule_day ?? [];
        $starts = $request->schedule_start ?? [];
        $ends = $request->schedule_end ?? [];

        // Hapus semua jadwal lama
        $course->schedules()->delete();

        // Tambahkan ulang jadwal baru
        for ($i = 0; $i < count($days); $i++) {
            if (!$days[$i] || !$starts[$i] || !$ends[$i]) {
                continue;
            }

            $course->schedules()->create([
                'day' => $days[$i],
                'start_time' => $starts[$i],
                'end_time' => $ends[$i],
            ]);
        }

        return redirect()->route('course.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index');
    }
}