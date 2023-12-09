@extends('layout.app')

@section('content')
  <h2>{{__("Update")}}</h2>
  <form action="{{ route('reserv.update', ['reserv' => $reserv->id]) }}" method="post">

    @csrf
    @method('put')


    <x-input property="numero" type="number" label="Reservation's Number" :model="$reserv"/>

    <x-input property="date_reservation" type="date" label="Reservation's Date" :model="$reserv"/>

    <x-input property="heure_reservation" type="time" label="Reservation's Hour" :model="$reserv"/>

    <x-input property="prix" type="number" label="Price" :model="$reserv"/>

    <x-input property="nombre_place" type="number" label="Number of Seat" :model="$reserv"/>


    <x-select property="salle_id" label="Room" :collec="$salles" :model="$reserv" prop_name="nom_salle" />

    <div>
        <input type="hidden" name="client_id" id="client_id" required readonly value="{{ auth()->user()->id }}"/>
    </div>

    <x-input-submit/>

  </form>
@endsection
