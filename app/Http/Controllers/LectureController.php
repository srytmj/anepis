<?php

namespace App\Http\Controllers;

use App\Models\lecture;
use App\Http\Requests\StorelectureRequest;
use App\Http\Requests\UpdatelectureRequest;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        //
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
}