<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // admin -> return user saja
        // student -> load student relation
        if ($user->role === 'student') {
            $user->load('student');
        }

        return view('pages.profile.index', compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi user umum
        $request->validate([
            'email' => "required|email|unique:users,email,{$user->id}",
        ]);

        // Update data user (name dimatikan editnya jadi tidak diupdate)
        $user->update([
            'email' => $request->email,
        ]);

        // Jika STUDENT → update tabel student
        if ($user->role === 'student') {

            $student = $user->student;

            $request->validate([
                'phonenumber' => 'nullable|string|max:30',
                'transcript' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'profilephoto' => 'nullable|image|max:2048',
            ]);

            // Upload transcript
            if ($request->hasFile('transcript')) {
                $transcriptPath = $request->file('transcript')->store('transcripts', 'public');
                $student->transcript = $transcriptPath;
            }

            // Upload profile photo
            if ($request->hasFile('profilephoto')) {
                $photoPath = $request->file('profilephoto')->store('profilephotos', 'public');
                $student->profilephoto = $photoPath;
            }

            // Update field lain
            $student->phonenumber = $request->phonenumber;
            $student->save();
        }

        return back()->with('success', 'Profile updated!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
