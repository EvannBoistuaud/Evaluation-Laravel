<?php
namespace App\Repositories;
use App\Models\Reserv;
class ReservRepository
{
protected $reserv;
public function __construct(Reserv $reserv) {
$this->reserv = $reserv;
}
private function save(Reserv $reserv, array $inputs) {
    $reserv->numero = $inputs['numero'];
    $reserv->date_reservation = $inputs['date_reservation'];
    $reserv->heure_reservation = $inputs['heure_reservation'];
    $reserv->prix = $inputs['prix'];
    $reserv->nombre_place = $inputs['nombre_place'];
    $reserv->salle_id = $inputs['salle_id'];

$reserv->save();
return $reserv;
}
public function store(array $inputs) {
$reserv = new $this->reserv;
return $this->save($reserv, $inputs);
}
public function update(Reserv $reserv, array $inputs) {
return $this->save($reserv, $inputs);
}
}
