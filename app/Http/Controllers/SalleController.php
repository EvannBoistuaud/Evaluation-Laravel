<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleRequest;
use App\Models\Salle;
use App\Repositories\SalleRepository;
use Auth;

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
        $salles = Salle::all();
        if (Auth::user()->can('salle-index')) {
        return view('salle.index', compact('salles'));
        }

        abort(401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('salle-index')) {
        return view('salle.create');
        }

        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalleRequest $request)
    {
        $salle=$this->repository->store($request->all());
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
        if (Auth::user()->can('salle-index')) {
        return view('salle.edit', compact('salle'));
        }

        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalleRequest $request, Salle $salle)
    {
        $this->repository->update($salle, $request->all());

        return redirect()->route('salle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $salle = Salle::find($id);
        $salle->delete();
        return redirect()->route('salle.index');
    }

}
