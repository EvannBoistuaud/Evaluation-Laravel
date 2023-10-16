@extends('layout.app')

@section('content')
        <a href="{{ route('reserv.create') }}" class="btn btn-primary">Ajouter</a>

    <ul>
        @forelse ($reservs as $reserv)
            <li>
                <div class="mb-2">
                    <form action="{{route('reserv.destroy', $reserv->id)}}" method="post" >
                    <b>N°Reservation: </b>{{ $reserv->numero }} <b>Date: </b> {{$reserv->date_reservation}}
                    <b>Heure: </b> {{$reserv->heure_reservation}} <b>Prix: </b> {{$reserv->prix}}€
                    <b>Nombre de place: </b> {{$reserv->nombre_place}}
                    <b>Client: </b> {{$reserv->client->nom}} {{$reserv->client->prenom}}
                    <b>Salle: </b> {{$reserv->salle->nom_salle}}

                     @cannot('reserv-update')
                        <a href="{{ route('reserv.edit', ['reserv' => $reserv->id]) }}"
                            class="btn btn-sm btn-warning">Modifier</a>
                    @endcannot

                    @csrf
                        @method('delete')
                    @cannot('reserv-destroy')
                        <input type="submit" class="btn btn-sm btn-warning" value="Supprimer" />
                    @endcannot
                    </form>
                </div>
            </li>
        @empty
            <li>
                Aucune reservation connue
            </li>
        @endforelse
    </ul>
@endsection
