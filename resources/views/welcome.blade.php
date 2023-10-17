@extends('layout.app')

@section('content')
    <div style="float: left; width: 40%; margin-right: 20%">
        <ul>
            <h2 style="font-weight: bold; font-size: 30px; margin-bottom: 20px"">{{__("Upcoming Reservation")}}</h2>
            @forelse ($salles as $salle)
                <li>
                    <div class="mb-2">
                        <b>{{__("Room")}}: </b> {{ $salle->nom_salle }} / {{ $salle->nb_reservations_a_venir() }}
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
