@extends('layout.app')

@section('content')

    <ul>
        @auth
        <a href="{{ route('client.create') }}" class="btn btn-primary">{{__("Add")}}</a>
    @endauth
        @forelse ($clients as $client)
            <li>
                <div class="mb-2">
                    <form action="{{ route('client.destroy', $client->id) }}" method="post">
                        <b>{{__("Name")}}: </b>{{ $client->nom }} {{ $client->prenom }} <b>{{__("Email")}}: </b> {{ $client->email }}

                        @auth

                            @can('client-index')
                                <a href="{{ route('client.edit', ['client' => $client->id]) }}"
                                    class="btn btn-sm btn-warning">{{__("Update")}}</a>
                            @endcan

                            @csrf
                            @method('delete')

                            @can('client-index')
                                <input type="submit" class="btn btn-sm btn-warning" value="{{__("Delete")}}" />
                            @endcan

                        @endauth
                    </form>
                </div>
            </li>
        @empty
            <li>
                {{__("No client Known")}}
            </li>
        @endforelse
    </ul>
@endsection
