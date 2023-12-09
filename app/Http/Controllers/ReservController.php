<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservRequest;
use App\Models\Reserv;
use App\Models\Salle;
use App\Models\Client;
use App\Models\User;
use App\Repositories\ReservRepository;
use Auth;
use App\Mail\ReservMail;
use Mail;

class ReservController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    public function index()
    {
        // Récupérer l'id de l'utilisateur connecté
        $id = Auth::user()->id;

        //Si la personne connécté possède les bonnes autorisation...
        if (Auth::user()->can('reserv-index')) {
            //... Alors renvoyer toute les réservation du client connecté et rediriger vers reserv.index
            $reservs = Reserv::all()->where('client_id', $id);
            return view('reserv.index', compact('reservs'));
        }
        // Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer l'id de l'utilisateur connecté
        $id = Auth::user()->id;

         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('reserv-index')) {
            // ... Alors récuperer toute les salle et le client lier à l'utilisateur avant de renvoyer vers reserv.create
            $salles = Salle::all();
            $clients = Client::where('id_user', $id)->get();
        return view('reserv.create', compact('salles','clients','id'));
        }
        // Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservRequest $request)
    {
        // Sauvegarder les valeurs récupérées dans la base de donnée
       $reserv = $this->repository->store($request->all());

        //Récupérer le mail de l'utilisateur connecté et lui envoyer un mail
        $mail = Auth::user()->email;
        Mail::to($mail)->send(new ReservMail($reserv));

        //Rediriger vers reserv.index
        return redirect()->route('reserv.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserv $reserv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserv $reserv)
    {
        //Recuperer toute les salles et clients
        $salles = Salle::all();
        $clients = Client::all();

         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('reserv-index')) {
        // ... Alors renvoyer vers reserv.edit
        return view('reserv.edit', compact('reserv', 'salles', 'clients' ));
        }
        //Sinon renvoyer une erreur
        abort(401);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservRequest $request, Reserv $reserv)
    {
        // Sauvegarder les valeurs récupérées dans la base de donnée
        $this->repository->update($reserv, $request->all());

        // Rediriger vers reserv.index
        return redirect()->route('reserv.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Séléctionner la bonne reservation avant de la supprimer et de rediriger vers reserv.index
        $reserv = Reserv::find($id);
        $reserv->delete();
        return redirect()->route('reserv.index');
    }

    public function __construct(ReservRepository $repository)
    {
        $this->repository = $repository;
    }
}
