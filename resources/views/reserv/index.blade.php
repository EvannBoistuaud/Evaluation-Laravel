@extends('layout.app')

@section('content')
    @auth
        <a href="{{ route('reserv.create') }}" class="btn btn-primary">{{__("Add")}}</a>
    @endauth

    <ul>
        @forelse ($reservs as $reserv)
            <li>
                <div class="mb-2">
                    <form action="{{ route('reserv.destroy', $reserv->id) }}" method="post">

                        <b>{{__("Reservation's Number")}}: </b>{{ $reserv->numero }} <b>{{__("Reservation's Date")}}: </b> {{ $reserv->date_reservation }}
                        <b>{{__("Reservation's Hour")}}: </b> {{ $reserv->heure_reservation }} <b>{{__("Price")}}: </b> {{ $reserv->prix }}€
                        <b>{{__("Number of Seat")}}: </b> {{ $reserv->nombre_place }}
                        <b>{{__("Customer")}}: </b> {{ $reserv->client->nom }} {{ $reserv->client->prenom }}
                        <b>{{__("Room")}}: </b> {{ $reserv->salle->nom_salle }}

                        @auth

                            @cannot('reserv-update')
                                <a href="{{ route('reserv.edit', ['reserv' => $reserv->id]) }}"
                                    class="btn btn-sm btn-warning">{{__("Update")}}</a>
                            @endcannot

                            @csrf
                            @method('delete')

                            @cannot('reserv-destroy')
                                <input type="submit" class="btn btn-sm btn-warning" value="{{__("Delete")}}" />
                            @endcannot

                        @endauth
                    </form>
                </div>
            </li>
        @empty
            <li>
                {{__("No Reservation Known")}}
            </li>
        @endforelse
    </ul>
@endsection
