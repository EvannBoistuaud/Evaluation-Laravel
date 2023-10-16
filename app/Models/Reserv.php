<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserv extends Model
{
    use HasFactory;

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}
