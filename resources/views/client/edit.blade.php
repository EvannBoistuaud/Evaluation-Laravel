@extends('layout.app')

@section('content')
  <h2>Mise à jour</h2>
  <form action="{{ route('client.update', ['client' => $client->id]) }}" method="post">

    @csrf
    @method('put')

    <div>
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" required maxlength="75" value="{{ old('nom', $client->nom) }}">
    </div>
    @error('nom')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" required maxlength="75" value="{{ old('prenom', $client->prenom) }}">
    </div>
    @error('prenom')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <label for="email">Adresse Mail</label>
      <input type="email" name="email" id="email" required value="{{ old('email', $client->email) }}">
    </div>
    @error('email')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
