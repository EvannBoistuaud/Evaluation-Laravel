<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * App\Models\Reserv
 *
 * @property int $id
 * @property int $numero
 * @property string $date_reservation
 * @property string $heure_reservation
 * @property string $prix
 * @property int $nombre_place
 * @property int $salle_id
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Salle $salle
 * @method static \Database\Factories\ReservFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereDateReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereHeureReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereNombrePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereSalleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reserv whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    function reservation_client()
    {
        $id = Auth::id();
        return $id;
    }
}
