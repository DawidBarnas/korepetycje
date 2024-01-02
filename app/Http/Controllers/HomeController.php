<?php

namespace App\Http\Controllers;

use App\Models\TutorSubject;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subjects = DB::table('subjects')->get();

        return view('home', compact('subjects'));
    }
    public function save(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->role === 'tutor') {
            $subjectId = $request->input('subject_id');

            if ($subjectId) {
                $tutorId = $user->id;

                // Sprawdź, czy istnieje rekord w tutor_subjects
                $existingRecord = TutorSubject::where('tutor_id', $tutorId)->first();

                if ($existingRecord) {
                    // Jeśli rekord istnieje, zaktualizuj go
                    $existingRecord->update(['subject_id' => $subjectId]);

                    return redirect()->route('home')->with('success', 'Przedmiot został zaktualizowany pomyślnie.');
                } else {
                    // Jeśli rekord nie istnieje, dodaj nowy
                    TutorSubject::create([
                        'tutor_id' => $tutorId,
                        'subject_id' => $subjectId,
                    ]);

                    return redirect()->route('home')->with('success', 'Przedmiot został dodany pomyślnie.');
                }
            }
        }

        return redirect()->route('home')->with('error', 'Wystąpił błąd podczas dodawania przedmiotu.');
    }




}
