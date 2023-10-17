<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    public function index()
    {

        $id = Auth::user()->id;
        if (Auth::user()->can('client-index')) {
            $clients = Client::find($id);
            return view('client.index', compact('clients'));
        }
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('client-index')) {
            return view('client.create');
        }
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = $this->repository->store($request->all());
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        if (Auth::user()->can('client-index')) {
            return view('client.edit', compact('client'));
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->repository->update($client, $request->all());

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.index');
    }
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }
}
