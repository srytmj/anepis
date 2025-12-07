<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApplyVacancyController;
use App\Http\Controllers\AsprakDashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
// use course controller
use App\Http\Controllers\ProfileController;
// use lecture controller
use App\Http\Controllers\StudentController;
// use student controller
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('course', CourseController::class);
    Route::resource('lecture', LectureController::class);
    Route::resource('student', StudentController::class);
    Route::resource('vacancy', VacancyController::class);
    Route::get('/vacancy/{vacancy}', [VacancyController::class, 'show'])->name('vacancy.show');

    // Cek apakah user adalah student sebelum masuk dashboard
    // Route::resource('asprak', AsprakDashboardController::class);
    Route::get('/asprak/dashboard', function () {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized action.'); // Atau return redirect('/')
        }

        return app(AsprakDashboardController::class)->index();
    })->name('asprak.dashboard');

    // Route untuk submit jadwal (Post)
    Route::post('/asprak/schedule', [AsprakDashboardController::class, 'storeSchedule'])
        ->name('asprak.schedule.store');

    Route::delete('/asprak/schedule/{id}', [AsprakDashboardController::class, 'destroySchedule'])
        ->name('asprak.schedule.destroy');
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

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

require __DIR__.'/auth.php';
