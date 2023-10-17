@extends('layout.app')

@section('content')
@can('salle-create')

        <a href="{{ route('salle.create') }}" class="btn btn-primary">{{__("Add")}}</a>

        @endcan
    <ul>
        @forelse ($salles as $salle)
            <li>
                <div class="mb-2" >
                    <form action="{{route('salle.destroy', $salle->id)}}" method="post" >
                    <b>{{__("Name")}}: </b>{{ $salle->nom_salle }} <b>{{__("Address")}}: </b>{{ $salle->adresse }} <b>{{__("Places Number")}}: </b> {{$salle->nombre_place}}

                    @auth
                                            @can('salle-update')
                        <a href="{{ route('salle.edit', ['salle' => $salle->id]) }}"
                            class="btn btn-sm btn-warning" ">{{__("Edit")}}</a>
                    @endcan

                        @csrf
                        @method('delete')
                    @can('salle-destroy')
                        <input type="submit" class="btn btn-sm btn-warning" value="{{__("Delete")}}" />
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
