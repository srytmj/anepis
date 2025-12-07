<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\ApplyVacancy;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(404);
        }

        $vacancies = Vacancy::with('course')->latest()->get();
        return view('vacancy.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('vacancy.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVacancyRequest $request)
    {
        $request->validate([
            'course_id' => 'required|exists:course,id',
            'quota' => 'required|integer|min:1',
            'status_vac' => 'required|in:open,closed',
            'close_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Vacancy::create($request->all());

        return redirect()->route('vacancy.index')->with('success', 'Vacancy created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        // Load course, lecturers, schedules
        $vacancy->load(['course.lecturers', 'course.schedules']);

        return view('vacancy.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        $courses = Course::all();
        return view('vacancy.edit', compact('vacancy', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $request->validate([
            'course_id' => 'required|exists:course,id',
            'quota' => 'required|integer|min:1',
            'status_vac' => 'required|in:open,closed',
            'close_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $vacancy->update($request->all());

        return redirect()->route('vacancy.index')->with('success', 'Vacancy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('vacancy.index')->with('success', 'Vacancy deleted.');
    }
}