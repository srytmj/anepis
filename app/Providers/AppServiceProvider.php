<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;
use App\Models\Student;
use App\Models\Lecture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        // Schema::defaultMorphKeyType('uuid');
        // Schema::defaultCollation('utf8mb4_unicode_ci');

        View::composer('components.navbar', function ($view) {
            $user = Auth::user();

            $displayName = $user->username ?? $user->name ?? 'Guest'; // username login
            $fullName = null;

            if ($user) {
                if ($user->role === 'student') {
                    $student = Student::where('id', $user->foreignid)->first(); // manual match
                    $fullName = $student->name ?? null;
                } elseif ($user->role === 'lecture') {
                    $lecture = Lecture::where('id', $user->foreignid)->first(); // manual match
                    $fullName = $lecture->name ?? null;
                }
            }

            $view->with([
                'displayName' => $displayName,
                'fullName' => $fullName
            ]);
        });
    }
}