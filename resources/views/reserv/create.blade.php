@extends('layout.app')

@section('content')
  <h2>{{__("Create")}}</h2>
  <form action="{{ route('reserv.store') }}" method="post">

    @csrf

    <x-input property="numero" type="number" label="Reservation's Number" />

    <x-input property="date_reservation" type="date" label="Reservation's Date" />

    <x-input property="heure_reservation" type="time" label="Reservation's Hour" />

    <x-input property="prix" type="number" label="Price" />

    <x-input property="nombre_place" type="number" label="Number of Seat" />

    <x-select property="salle_id" label="Room" :collec="$salles" prop_name="nom_salle"/>


    <div>
          <input type="hidden" name="client_id" id="client_id" required readonly value="{{ $clients }}"/>
    </div>


    <x-input-submit/>

  </form>
@endsection
