@extends('layout.app')

@section('content')
        <a href="{{ route('salle.create') }}" class="btn btn-primary">Ajouter</a>

    <ul>
        @forelse ($salles as $salle)
            <li>
                <div class="mb-2">
                    <b>Nom: </b>{{ $salle->nom_salle }} <b>Adresse: </b>{{ $salle->adresse }} <b>Nombre de place: </b> {{$salle->nombre_place}}
                    @cannot('salle-update')
                        <a href="{{ route('salle.edit', ['salle' => $salle->id]) }}"
                            class="btn btn-sm btn-warning">Modifier</a>
                    @endcannot
                </div>
            </li>
        @empty
            <li>
                Aucune matière connue
            </li>
        @endforelse
    </ul>
@endsection
