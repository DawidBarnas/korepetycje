<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorAvailability;

class TutorAvailabilityController extends Controller
{

    public function index()
    {
        $hours = ['7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

        return view('tutor-availability', compact('hours'));
        
    }

    public function checkAvailability(Request $request)
{
    $selectedDate = $request->input('date');
    $selectedHoursString = $request->input('selected_hours');

    // JSON na tablicę
    $selectedHoursArray = json_decode($selectedHoursString[0]);

    //zalogowany uzytkownik
    $tutorId = auth()->user()->id;

    // Przechodzę przez wybrane godziny i dodaję do bazy danych
    foreach ($selectedHoursArray as $hour) {
        // Sprawdź, czy rekord już istnieje
        $existingRecord = TutorAvailability::where('tutor_id', $tutorId)
            ->where('date', $selectedDate)
            ->where('hour', $hour)
            ->first();

        // Jeśli rekord już istnieje, przejdź do kolejnej iteracji
        if ($existingRecord) {
            continue;
        }

        //  nowy rekord do bazy danych
        TutorAvailability::create([
            'tutor_id' => $tutorId,
            'date' => $selectedDate,
            'hour' => $hour,
            'user_id' => null, 
            'is_available' => true, 
        ]);
    }

    return redirect()->back()->with('success', 'Dostępność została zapisana pomyślnie.');
}

    
}