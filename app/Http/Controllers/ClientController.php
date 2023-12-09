<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientRepository;
use Auth;
use Illuminate\Cache\Repository;
use App\Mail\EditClientMail;
use Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;

    public function index()
    {
        // Récupère l'id de la personne authentifié
        $id = Auth::user()->id;

        // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('client-index')) {
            // ... Alors récupérer le client ayant la même id_user que l'utilisateur connécté
            // Et rediriger vers client.index avec la valeur $client
            $clients = Client::all()->where('id_user', $id);
            return view('client.index', compact('clients'));
        }
        // Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('client-index')) {
            // ... Alors renvoyer a la page client.create
            return view('client.create');
        }
        //Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        //Enregistre les valeurs récupérées dans la database avant de rediriger vers client.index
        $this->repository->store($request->all());
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
         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('client-index')) {
            //... Alors renvoyer vers client.edit avec $client
            return view('client.edit', compact('client'));
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        // Enregistrer la valeur obtenue dans la database avant de rediriger vers client.index
        $editclient = $this->repository->update($client, $request->all());

         //Récupérer le mail de l'utilisateur connecté et lui envoyer un mail
         $mail = Auth::user()->email;
         Mail::to($mail)->send(new EditClientMail($editclient));

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Récupère le client avec le bon id avant de le supprimer et de rediriger vers la page client.index
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.index');
    }
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }
}
