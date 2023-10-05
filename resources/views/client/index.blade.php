@extends('layout.app')

@section('content')
        <a href="{{ route('client.create') }}" class="btn btn-primary">Ajouter</a>

    <ul>
        @forelse ($clients as $client)
            <li>
                <div class="mb-2">
                    <b>Nom: </b>{{ $client->nom }} {{ $client->prenom }} <b>Adresse Mail: </b> {{$client->email}}
                    @cannot('client-update')
                        <a href="{{ route('client.edit', ['client' => $client->id]) }}"
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
