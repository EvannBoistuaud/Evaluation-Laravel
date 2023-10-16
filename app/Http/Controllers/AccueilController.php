<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reserv;
use App\Models\Salle;

class AccueilController extends Controller
{
    public function index()
    {
        $reservs = Reserv::all();
        $salles = Salle::all();

        return view('welcome', compact('reservs', 'salles'));
    }
}
