<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorAvailability;

class YourScheduleController extends Controller
{
    function index()
    {
        $id = auth()->user()->id;
        
        $tutorSchedules = TutorAvailability::where('tutor_id', $id)->paginate(4);
        return view('your-schedule',compact('tutorSchedules'));
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
