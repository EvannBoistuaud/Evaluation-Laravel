<?php

namespace App\Http\Controllers;

use App\Models\Reserv;
use App\Models\Salle;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\ReservRepository;
use Auth;

class ReservController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    public function index()
    {

        $reservs = Reserv::all();

        if (Auth::user()->can('reserv-index')) {
        return view('reserv.index', compact('reservs'));
        }
        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salles = Salle::all();
        $clients = Client::all();
        if (Auth::user()->can('reserv-index')) {
        return view('reserv.create', compact('salles','clients'));
        }
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->repository->store($request->all());
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
        $salles = Salle::all();
        $clients = Client::all();

        if (Auth::user()->can('reserv-index')) {
        return view('reserv.edit', compact('reserv', 'salles', 'clients' ));
        }
        abort(401);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserv $reserv)
    {
        $this->repository->update($reserv, $request->all());

        return redirect()->route('reserv.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reserv = Reserv::find($id);
        $reserv->delete();
        return redirect()->route('reserv.index');
    }

    public function __construct(ReservRepository $repository)
    {
        $this->repository = $repository;
    }
}
