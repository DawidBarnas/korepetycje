<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorAvailability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class YourScheduleController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $userSchedules = DB::table('tutor_availabilities')
            ->join('users', 'tutor_availabilities.tutor_id', '=', 'users.id')
            ->select('tutor_availabilities.*', 'users.name', 'users.email')
            ->where('tutor_availabilities.user_id', $id)
            ->paginate(5);

        $tutorSchedules = DB::table('tutor_availabilities')
            ->join('users', 'tutor_availabilities.user_id', '=', 'users.id')
            ->select('tutor_availabilities.*', 'users.name', 'users.email')
            ->where('tutor_availabilities.tutor_id', $id)
            ->paginate(5);

        return view('your-schedule', compact('tutorSchedules','userSchedules'));
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
