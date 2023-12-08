@extends('layout.app')

@section('content')
  <h2>Création</h2>
  <form action="{{ route('client.store') }}" method="post">

    @csrf

    <x-input property="nom" type="text" label="Last Name" />

    <x-input property="prenom" type="text" label="First Name" />

    <x-input property="email" type="email" label="Email" />

    <x-input-submit/>

  </form>
@endsection
