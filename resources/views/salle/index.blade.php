@extends('layout.app')

@section('content')
@can('salle-create')

        <a href="{{ route('salle.create') }}" class="btn btn-primary">Ajouter</a>

        @endcan
    <ul>
        @forelse ($salles as $salle)
            <li>
                <div class="mb-2" >
                    <form action="{{route('salle.destroy', $salle->id)}}" method="post" >
                    <b>Nom: </b>{{ $salle->nom_salle }} <b>Adresse: </b>{{ $salle->adresse }} <b>Nombre de place: </b> {{$salle->nombre_place}}

                    @auth
                                            @can('salle-update')
                        <a href="{{ route('salle.edit', ['salle' => $salle->id]) }}"
                            class="btn btn-sm btn-warning" ">Modifier</a>
                    @endcan

                        @csrf
                        @method('delete')
                    @can('salle-destroy')
                        <input type="submit" class="btn btn-sm btn-warning" value="Supprimer" />
                    @endcan

                    @endauth
                    </form>
                </div>
            </li>
        @empty
            <li>
                Aucune matière connue
            </li>
        @endforelse
    </ul>
@endsection
