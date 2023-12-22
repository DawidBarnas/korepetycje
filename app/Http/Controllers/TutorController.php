<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;

class TutorController extends Controller
{
    public function showProfile($id)
    {
        $tutor = User::findOrFail($id);
        $ratings = $tutor->ratings; // Użyj relacji, aby pobrać oceny tego korepetytora

        // Sprawdź, czy użytkownik już ocenił tego korepetytora
        $hasRated = Rating::where('tutor_id', $id)
            ->where('user_id', auth()->user()->id)
            ->exists();

        return view('tutor-profile', compact('tutor', 'ratings', 'hasRated'));
    }


    public function rateTutor(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:255',
    ]);

    $tutor = User::findOrFail($id);

    // Sprawdzenie, czy użytkownik już ocenił tego korepetytora
    $existingRating = Rating::where('tutor_id', $id)
        ->where('user_id', auth()->user()->id)
        ->first();

    if (!$existingRating) {
        // Dodanie nowej oceny
        Rating::create([
            'tutor_id' => $id,
            'user_id' => auth()->user()->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Dziękujemy za ocenę korepetytora.');
    } else {
        return redirect()->back()->with('error', 'Już oceniłeś(aś) tego korepetytora.');
    }
}


}
