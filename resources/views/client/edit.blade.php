@extends('layout.app')

@section('content')
  <h2>{{__("Update")}}</h2>
  <form action="{{ route('client.update', ['client' => $client->id]) }}" method="post">

    @csrf
    @method('put')

    <div>
      <label for="nom">{{__("Last Name")}}</label>
      <input type="text" name="nom" id="nom" required maxlength="75" value="{{ old('nom', $client->nom) }}">
    </div>
    @error('nom')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="prenom">{{__("First Name")}}</label>
      <input type="text" name="prenom" id="prenom" required maxlength="75" value="{{ old('prenom', $client->prenom) }}">
    </div>
    @error('prenom')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="email">{{__("Email")}}</label>
      <input type="email" name="email" id="email" required value="{{ old('email', $client->email) }}">
    </div>
    @error('email')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <input type="submit" value="{{__("Submit")}}" class="btn btn-success">
    </div>

  </form>
@endsection
