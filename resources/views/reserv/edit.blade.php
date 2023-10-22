@extends('layout.app')

@section('content')
  <h2>{{__("Update")}}</h2>
  <form action="{{ route('reserv.update', ['reserv' => $reserv->id]) }}" method="post">

    @csrf
    @method('put')

    <div>
        <label for="numero">{{__("Reservation's Number")}}</label>
        <input type="text" name="numero" id="numero" required value="{{ old('numero', $reserv->numero) }}">
    </div>

    <div>
      <label for="date_reservation">{{__("Reservation's Date")}}</label>
      <input type="date" name="date_reservation" id="date_reservation" required value="{{ old('date_reservation', $reserv->numero) }}">
    </div>

    <div>
      <label for="heure_reservation">{{__("Reservation's Hour")}}</label>
      <input type="time" name="heure_reservation" id="heure_reservation" required value="{{ old('heure_reservation', $reserv->numero) }}">
    </div>

    <div>
        <label for="prix">{{__("Price")}}</label>
        <input type="number" step="any" name="prix" id="prix" required value="{{ old('prix', $reserv->prix) }}">
    </div>

    <div>
        <label for="nombre_place">{{__("Number of Seat")}}</label>
        <input type="number" name="nombre_place" id="nombre_place" required value="{{ old('nombre_place', $reserv->nombre_place) }}">
    </div>

    <div>
        <label for="salle">{{__("Room")}}</label>
        <select name="salle_id" id="salle_id">
          @foreach ($salles as $salle)
            <option value="{{ $salle->id }}" {{ $reserv->salle_id == $salle->id ? 'selected' : '' }}>
              {{ $salle->nom_salle }}
            </option>
          @endforeach
        </select>
    </div>

    <div>
        <label for="client">{{__("Customer")}}</label>
        <select name="client_id" id="client_id">
          @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{ $reserv->client_id == $client->id ? 'selected' : '' }}>
              {{ $client->nom }} {{$client->prenom}}
            </option>
          @endforeach
        </select>
    </div>

    <div>
      <input type="submit" value="{{__("Submit")}}" class="btn btn-success">
    </div>

  </form>
@endsection
