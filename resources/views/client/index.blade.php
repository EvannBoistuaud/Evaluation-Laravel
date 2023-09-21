@extends('layouts.app')

@section('content')
  @can('client-create')
    <a href="{{ route('client.create') }}" class="btn btn-primary">Ajouter</a>
  @endcan

  <ul>
    @forelse ($clients as $client)
      <li>
        <div class="mb-2">
          {{ $client->libelle }} [{{ $client->niveau }}]
          @cannot('client-update')
            <a href="{{ route('client.edit', ['client' => $client->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
          @endcannot
        </div>
      </li>
    @empty
      <li>
        Aucun client connue
      </li>
    @endforelse
  </ul>
@endsection
