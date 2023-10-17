@extends('layout.app')

@section('content')
  <h2>Création</h2>
  <form action="{{ route('reserv.store') }}" method="post">

    @csrf

    <div>
      <label for="numero">N°Reservation</label>
      <input type="text" name="numero" id="numero" required value="{{ old('numero') }}" maxlength="75">
    </div>

    <div>
      <label for="date_reservation">Date de Reservation</label>
      <input type="date" name="date_reservation" id="date_reservation" required value="{{ old('date_reservation') }}">
    </div>

    <div>
      <label for="heure_reservation">Heure de Reservation</label>
      <input type="time" name="heure_reservation" id="heure_reservation" required value="{{ old('heure_reservation') }}">
    </div>

    <div>
        <label for="prix">Prix</label>
        <input type="number" step="any" name="prix" id="prix" required value="{{ old('prix') }}">
    </div>
    <div>
        <label for="nombre_place">Nombre de Place</label>
        <input type="number" name="nombre_place" id="nombre_place" required value="{{ old('nombre_place') }}">
    </div>

    <div>
        <label for="salle_id">Salle</label>
        <select name="salle_id" id="salle_id">
          @foreach ($salles as $salle)
          <option value="{{ $salle->id }}">{{ $salle->nom_salle }}</option>
          @endforeach
        </select>
    </div>

    <div>
        <label for="client">Client</label>

          @foreach ($clients as $client)
          <input type="text" name="client" id="client" required readonly value="{{ $client->nom}} {{$client->prenom}}"
          @endforeach

    </div>

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
