<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TutorAvailability;
use Illuminate\Support\Facades\DB;

class TutorCalendarController extends Controller
{
    public function show($id)
    {
        $tutor = User::findOrFail($id);

        // Pobierz dostępne daty z bazy danych
        $availableDatesandHours = TutorAvailability::where('tutor_id', $id)
            ->where('is_available', 1)
            ->get();
        return view('tutor-calendar', compact('tutor', 'availableDatesandHours'));
    }
}
