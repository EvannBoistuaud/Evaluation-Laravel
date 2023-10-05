<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Repositories\SalleRepository;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    public function index()
    {
        $salles = Salle::all();

        return view('salle.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $salle=$this->repository->store($request->all());
        return redirect()->route('salle.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        return view('salle.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salle $salle)
    {
        $this->repository->update($salle, $request->all());

        return redirect()->route('salle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        //
    }
    public function __construct(SalleRepository $repository)
    {
        $this->repository = $repository;
    }
}
