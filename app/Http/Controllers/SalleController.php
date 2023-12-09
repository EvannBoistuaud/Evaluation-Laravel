<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleRequest;
use App\Models\Salle;
use App\Repositories\SalleRepository;
use Auth;
use App\Mail\EditSalleMail;
use App\Mail\NewSalleMail;
use App\Mail\DeleteSalleMail;
use Mail;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;

    public function __construct(SalleRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        //Récupérer toute les salles
        $salles = Salle::all();

         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('salle-index')) {
        // ... Alors rediriger vers salle.index
        return view('salle.index', compact('salles'));
        }
        //Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('salle-index')) {
        // ... Alors renvoyer vers salle.create
        return view('salle.create');
        }
        // Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalleRequest $request)
    {
        // Sauvegarder les valeurs récupérées dans la base de données avant de rediriger vers salle.index
        $salle = $this->repository->store($request->all());

        // Récupère le mail de la personne connectée et envoie un mail de confirmation
        $mail = Auth::user()->email;
        Mail::to($mail)->send(new NewSalleMail($salle));

        return redirect()->route('salle.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
         // Si la personne authentifié possède les bonnes autorisation...
        if (Auth::user()->can('salle-index')) {
        // ... Alors rediriger vers salle.edit
        return view('salle.edit', compact('salle'));
        }
        // Sinon renvoyer une erreur
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalleRequest $request, Salle $salle)
    {
        //Sauvegarder les valeurs récupérées dans la base de donnée et rediriger vers salle.index
        $salle = $this->repository->update($salle, $request->all());

        // Récupère le mail de la personne connectée et envoie un mail de confirmation
        $mail = Auth::user()->email;
        Mail::to($mail)->send(new EditSalleMail($salle));

        return redirect()->route('salle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Récupérer la bonne salle avant de la supprimer et rediriger vers salle.index
        $salle = Salle::find($id);
        $salle->delete();

        // Récupère le mail de la personne connectée et envoie un mail de confirmation
        $mail = Auth::user()->email;
        Mail::to($mail)->send(new DeleteSalleMail($salle));

        return redirect()->route('salle.index');
    }

}
