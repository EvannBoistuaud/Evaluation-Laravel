@extends('layout.app')

@section('content')
  <h2>{{__("Update")}}</h2>
  <form action="{{ route('client.update', ['client' => $client->id]) }}" method="post">

    @csrf
    @method('put')

    <x-input property="nom" type="text" label="Last Name" :model="$client"/>

    <x-input property="prenom" type="text" label="First Name" :model="$client"/>

    <x-input property="email" type="email" label="Email" :model="$client"/>

    <x-input-submit/>

  </form>
@endsection
