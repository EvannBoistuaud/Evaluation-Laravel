@extends('layout.app')

@section('content')
  <h2>{{__("Create")}}</h2>
  <form action="{{ route('reserv.store') }}" method="post">

    @csrf

    <div>
      <label for="numero">{{__("Reservation's Number")}}</label>
      <input type="text" name="numero" id="numero" required value="{{ old('numero') }}" maxlength="75">
    </div>

    <div>
      <label for="date_reservation">{{__("Reservation's Date")}}</label>
      <input type="date" name="date_reservation" id="date_reservation" required value="{{ old('date_reservation') }}">
    </div>

    <div>
      <label for="heure_reservation">{{__("Reservation's Hour")}}</label>
      <input type="time" name="heure_reservation" id="heure_reservation" required value="{{ old('heure_reservation') }}">
    </div>

    <div>
        <label for="prix">{{__("Price")}}</label>
        <input type="number" step="any" name="prix" id="prix" required value="{{ old('prix') }}">
    </div>
    <div>
        <label for="nombre_place">{{__("Number of Seat")}}</label>
        <input type="number" name="nombre_place" id="nombre_place" required value="{{ old('nombre_place') }}">
    </div>

    <div>
        <label for="salle_id">{{__("Room")}}</label>
        <select name="salle_id" id="salle_id">
          @foreach ($salles as $salle)
          <option value="{{ $salle->id }}">{{ $salle->nom_salle }}</option>
          @endforeach
        </select>
    </div>

    <div>
        <label for="client">{{__("Customer")}}</label>

          @foreach ($clients as $client)
          <input type="text" name="client" id="client" required readonly value="{{ $client->nom}} {{$client->prenom}}"
          @endforeach

    </div>

    <div>
      <input type="submit" value="{{__("Submit")}}" class="btn btn-success">
    </div>

  </form>
@endsection
