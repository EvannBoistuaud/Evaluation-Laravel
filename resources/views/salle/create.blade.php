@extends('layout.app')

@section('content')
  <h2>Création</h2>
  <form action="{{ route('salle.store') }}" method="post">

    @csrf

    <div>
      <label for="nom_salle">Nom</label>
      <input type="text" name="nom_salle" id="nom_salle" required value="{{ old('nom_salle') }}" maxlength="150">
    </div>

    <div>
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" required value="{{ old('adresse') }}" maxlength="150">
    </div>

    <div>
      <label for="nombre_place">Nombre de place</label>
      <input type="number" name="nombre_place" id="nombre_place" required value="{{ old('nombre_place') }}">
    </div>

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
