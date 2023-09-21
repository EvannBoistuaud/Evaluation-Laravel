@extends('layouts.app')

@section('content')
  <h2>Création</h2>
  <form action="{{ route('matiere.store') }}" method="post">

    @csrf

    <div>
      <label for="libelle">Libellé</label>
      <input type="text" name="libelle" id="libelle" value="{{ old('libelle') }}" required maxlength="75">
    </div>

    <div>
      <label for="libelle">Niveau</label>
      <input type="text" name="niveau" id="niveau" value="{{ old('niveau') }}" required maxlength="20">
    </div>

    <div>
      <input type="submit" value="Valider" class="btn btn-success">
    </div>

  </form>
@endsection
