@extends('layout.app')

@section('content')
  <h2>{{__("Create")}}</h2>
  <form action="{{ route('salle.store') }}" method="post">

    @csrf

    <x-input property="nom_salle" type="text" label="Name" />

    <x-input property="adresse" type="text" label="Adresse" />

    <x-input property="nombre_place" type="number" label="Places Number" />

    <x-input-submit/>

  </form>
@endsection
