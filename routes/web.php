<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplyVacancyController;

Route::get('/', function () {
    return view('pages.dashboard.read');
})->middleware(['auth'])->name('home');
Route::get('/about', function () {
    return view('pages.about.read');
})->middleware(['auth'])->name('about');

Route::get('/dashboard', function () {
    return view('pages.dashboard.read');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('course', App\Http\Controllers\CourseController::class);
    Route::resource('lecture', App\Http\Controllers\LectureController::class);
    Route::resource('student', App\Http\Controllers\StudentController::class);
    Route::resource('vacancy', App\Http\Controllers\VacancyController::class);
    Route::get('/vacancy/{vacancy}', [VacancyController::class, 'show'])->name('vacancy.show');
});

// lecturers
Route::get('/lecturers', [ApiController::class, 'lecturers']);
Route::get('/lecturers/search', [ApiController::class, 'searchLecturers']);

// courses
Route::get('/courses', [ApiController::class, 'courses']);

// schedule
Route::get('/courses/{id}/schedules', [ApiController::class, 'courseSchedule']);
Route::get('/lecture/search', [ApiController::class, 'searchLec']);

Route::post('/vacancy/apply', [ApplyVacancyController::class, 'store'])->name('vacancy.apply.store')->middleware('auth');

require __DIR__.'/auth.php';