<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\TutorAvailability;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->where('role', '!=', 'admin')->get();
        $users = User::where('role', '!=', 'admin')->paginate(8);
        return view('users', compact('users'));
    }

    public function delete($id)
    {
        // Znajdź użytkownika do usunięcia
        $user = User::find($id);

        if (!$user) {
            return redirect('users')->with('error', 'Użytkownik nie istnieje.');
        }

        // Sprawdź, czy usuwany użytkownik to korepetytor
        if ($user->role === 'tutor') {
            // Usuń powiązane oceny, gdzie tutor_id równa się ID usuwanego korepetytora
            Rating::where('tutor_id', $user->id)->delete();
        } elseif ($user->role === 'user') {
            // Usuń powiązane oceny, gdzie user_id równa się ID usuwanego użytkownika
            Rating::where('user_id', $user->id)->delete();
            TutorAvailability::where('user_id', $id)->update(['is_available' => 1,]);
        }
        

        // Usuń użytkownika
        $user->delete();

        return redirect('users')->with('success', 'Użytkownik został pomyślnie usunięty.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
