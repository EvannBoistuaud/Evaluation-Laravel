<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;


    function nb_reservations_a_venir()
    {
        return Reserv::where('date_reservation', '>', date('Y-m-d'))
            ->where('salle_id', $this->id)
            ->count();
    }
}
