<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TutorAvailability;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    
    
    

// ...

public function saveSelectedDateTime(Request $request)
{
    //  dane z formularza
    $selectedDate = $request->input('selectedDate');
    $selectedHour = $request->input('selectedHour');
    $tutorId = $request->input('tutorId');
    $id = auth()->user()->id;
    // obiekt Carbon dla daty i godziny
    $dateTime = \Carbon\Carbon::parse($selectedDate . ' ' . $selectedHour);

    // aktualizacja odpowiednich rekordow w tabeli TutorAvailability
    TutorAvailability::where('date', $dateTime->format('Y-m-d'))
        ->where('hour', $dateTime->format('H:i'))
        ->where('tutor_id', $tutorId)
        ->update([
            'is_available' => 0,
            'user_id' => $id
        ]);


    // przekierowanie na odpowiednią stronę
    return redirect()->back()->with('success', 'Wybrana data i godzina zostały zapisane.');
}

}
