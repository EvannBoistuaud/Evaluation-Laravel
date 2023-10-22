@extends('layout.app')

@section('content')

    <ul>

        @forelse ($clients as $client)
            <li>
                <div class="mb-2">
                    <form action="{{ route('client.destroy', $client->id) }}" method="post">
                        <b>{{__("Name")}}: </b>{{ $client->nom }} {{ $client->prenom }} <b>{{__("Email")}}: </b> {{ $client->email }} {{$client->id}}

                        @auth

                            @cannot('client-update')
                                <a href="{{ route('client.edit', ['client' => $client->id]) }}"
                                    class="btn btn-sm btn-warning">{{__("Update")}}</a>
                            @endcannot

                            @csrf
                            @method('delete')

                            @cannot('client-destroy')
                                <input type="submit" class="btn btn-sm btn-warning" value="{{__("Delete")}}" />
                            @endcannot

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
