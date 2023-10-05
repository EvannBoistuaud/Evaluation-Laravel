<?php
namespace App\Repositories;
use App\Models\Salle;
class SalleRepository
{
protected $salle;
public function __construct(Salle $salle) {
$this->salle = $salle;
}
private function save(Salle $salle, array $inputs) {
    $salle->nom_salle = $inputs['nom_salle'];
    $salle->adresse = $inputs['adresse'];
    $salle->nombre_place = $inputs['nombre_place'];

$salle->save();
return $salle;
}
public function store(array $inputs) {
$salle = new $this->salle;
return $this->save($salle, $inputs);
}
public function update(Salle $salle, array $inputs) {
return $this->save($salle, $inputs);
}
}
