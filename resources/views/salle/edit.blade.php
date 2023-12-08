@extends('layout.app')

@section('content')
  <h2>{{__("Update")}}</h2>
  <form action="{{ route('salle.update', ['salle' => $salle->id]) }}" method="post">

    @csrf
    @method('put')

    <x-input property="nom_salle" type="text" label="Name" :model="$salle"/>

    <x-input property="adresse" type="text" label="Address" :model="$salle"/>

    <x-input property="nombre_place" type="number" label="Places Number" :model="$salle"/>


    <x-input-submit/>

  </form>
@endsection
