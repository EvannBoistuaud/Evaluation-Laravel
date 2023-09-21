@extends('layouts.app')

@section('title', $matiere->libelle)

@section('content')
  <h1>Présentation de la matière</h1>

  <h2>Intitulé</h2>
  <p>{{ $matiere->libelle }}</p>

  <h2>Niveau</h2>
  <p>{{ $matiere->niveau }}</p>

  <h2>Nombre de professeurs {{ $matiere->professeurs->count() }}</h2>
  <ul>
    @forelse ($matiere->professeurs as $professeur)
      <li>
        <p>{{ $professeur->identite(false) }}</p>
      </li>
    @empty
      <li>
        <p>Aucun enseignant pour cette matière</p>
      </li>
    @endforelse
  </ul>
@endsection
