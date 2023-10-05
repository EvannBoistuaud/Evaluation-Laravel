@extends('layout.app')

@section('content')
  <h2>Création</h2>
  <form action="{{ route('client.store') }}" method="post">

    @csrf

    <div>
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" required value="{{ old('nom') }}" maxlength="75">
    </div>

    <div>
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" required value="{{ old('prenom') }}" maxlength="75">
    </div>

    <div>
      <label for="email">Adresse Email</label>
      <input type="email" name="email" id="email" required value="{{ old('email') }}">
    </div>

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
