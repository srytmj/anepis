<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Course;
use App\Models\CourseSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // ===============================
    //  GET ALL LECTURERS
    // ===============================
    public function lecturers()
    {
        return response()->json(
            Lecture::select('id', 'name')->get()
        );
    }
    
    public function searchLec(Request $request)
    {
        $keyword = $request->q;

        return Lecture::where('name', 'like', "%{$keyword}%")
            ->select('id', 'name')
            ->limit(10)
            ->get();
    }
    // ===============================
    //  SEARCH LECTURERS
    // ===============================
    public function searchLecturers()
    {
        $keyword = request('q');

        return response()->json(
            Lecture::where('name', 'like', "%{$keyword}%")
                    ->select('id', 'name')
                    ->get()
        );
    }

    // ===============================
    //  GET ALL COURSES
    // ===============================
    public function courses()
    {
        return response()->json(
            Course::select('id', 'course_code', 'course_name')->get()
        );
    }

    // ===============================
    //  GET COURSE SCHEDULE BY ID
    // ===============================
    public function courseSchedule($courseId)
    {
        return response()->json(
            CourseSchedule::where('course_id', $courseId)->get()
        );
    }
}