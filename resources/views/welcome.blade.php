@extends('layout.app')

@section('content')
    <div style="float: left; width: 40%; margin-right: 20%">
        <ul>
            <h2>Nombre de reservation à venir</h2>
            @forelse ($salles as $salle)
                <li>
                    <div class="mb-2">
                        <b>Salle: </b> {{ $salle->nom_salle }} / {{ $salle->nb_reservations_a_venir() }}
                    </div>
                </li>
            @empty
                Pas de données
            @endforelse
        </ul>
    </div>

    <div style="float: left; width: 40%; background-color: red">
        test
    </div>
@endsection
