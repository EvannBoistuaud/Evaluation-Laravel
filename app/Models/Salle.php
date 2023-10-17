<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Salle
 *
 * @property int $id
 * @property string $nom_salle
 * @property string $adresse
 * @property int $nombre_place
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Salle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereNomSalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereNombrePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
