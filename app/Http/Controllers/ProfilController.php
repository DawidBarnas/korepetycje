<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function show() {
        $userData = auth()->user();

        return view('profil', compact('userData'));
    }
}
