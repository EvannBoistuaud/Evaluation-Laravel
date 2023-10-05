@extends('layout.app')

@section('content')
  <h2>Mise à jour</h2>
  <form action="{{ route('salle.update', ['salle' => $salle->id]) }}" method="post">

    @csrf
    @method('put')

    <div>
      <label for="nom_salle">Nom</label>
      <input type="text" name="nom_salle" id="nom_salle" required maxlength="150" value="{{ old('nom_salle', $salle->nom_salle) }}">
    </div>
    @error('nom')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" required maxlength="150" value="{{ old('adresse', $salle->adresse) }}">
    </div>
    @error('adresse')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="nombre_place">Nombre de Place</label>
      <input type="number" name="nombre_place" id="nombre_place" required value="{{ old('nombre_place', $salle->nombre_place) }}">
    </div>
    @error('email')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
