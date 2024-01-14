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
        // TUTOR
        $id = Auth::user()->id;


        $tutorSchedules = TutorAvailability::with('user') 
        ->where('tutor_id', auth()->user()->id)
        ->get();

        return view('your-schedule', compact('tutorSchedules'));
    }

    public function delete($id)
    {
        // TUTOR
        $tutorSchedule = TutorAvailability::find($id);

        
        $tutorSchedule->delete();

        return redirect('your-schedule')->with('success', 'Termin został pomyślnie usunięty.');
    }

    public function index_user()
    {
        // USER
        $id = Auth::user()->id;


        $userSchedules = TutorAvailability::with('tutor') 
        ->where('user_id', auth()->user()->id)
        ->get();
        // dd($userSchedules);

        return view('your-schedule-user', compact('userSchedules'));
    }

    public function delete_user($id)
{
    $userSchedule = TutorAvailability::find($id);

    if ($userSchedule) {
        TutorAvailability::where('id', $id)
            ->update([
                'user_id' => null,
                'is_available' => 1,
            ]);

        return redirect('your-schedule-user')->with('success', 'Termin został pomyślnie usunięty.');
    } else {
        return redirect('your-schedule-user')->with('error', 'Nie można odnaleźć danego terminu.');
    }
}
}
