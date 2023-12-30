<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorAvailability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class YourScheduleController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;


        $tutorSchedules = TutorAvailability::with('user') 
        ->where('tutor_id', auth()->user()->id)
        ->get();

        return view('your-schedule', compact('tutorSchedules'));
    }

    public function delete($id)
    {
        // Znajdź użytkownika do usunięcia
        $tutorSchedule = TutorAvailability::find($id);

        // Usuń użytkownika
        $tutorSchedule->delete();

        return redirect('your-schedule')->with('success', 'Termin został pomyślnie usunięty.');
    }
}
