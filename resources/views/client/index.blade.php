@extends('layout.app')

@section('content')
    @auth

        <a href="{{ route('client.create') }}" class="btn btn-primary">Ajouter</a>

    @endauth
    <ul>
        @forelse ($clients as $client)
            <li>
                <div class="mb-2">
                    <form action="{{ route('client.destroy', $client->id) }}" method="post">
                        <b>Nom: </b>{{ $client->nom }} {{ $client->prenom }} <b>Adresse Mail: </b> {{ $client->email }}

                        @auth

                            @cannot('client-update')
                                <a href="{{ route('client.edit', ['client' => $client->id]) }}"
                                    class="btn btn-sm btn-warning">Modifier</a>
                            @endcannot

                            @csrf
                            @method('delete')

                            @cannot('client-destroy')
                                <input type="submit" class="btn btn-sm btn-warning" value="Supprimer" />
                            @endcannot

                        @endauth
                    </form>
                </div>
            </li>
        @empty
            <li>
                Aucun client connue
            </li>
        @endforelse
    </ul>
@endsection
