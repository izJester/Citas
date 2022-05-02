<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporalRequest;
use App\Http\Requests\UpdateTemporalRequest;
use App\Models\Temporal;

class TemporalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('temporary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($identf = null)
    {
        return view('temporary.create');
    }

    public function create_second($identf)
    {
        return view('temporary.second' , 
        ['temporal' => Temporal::where('identificador', $identf)->first()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemporalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemporalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temporal  $temporal
     * @return \Illuminate\Http\Response
     */
    public function show(Temporal $temporal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temporal  $temporal
     * @return \Illuminate\Http\Response
     */
    public function edit(Temporal $temporal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemporalRequest  $request
     * @param  \App\Models\Temporal  $temporal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemporalRequest $request, Temporal $temporal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temporal  $temporal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temporal $temporal)
    {
        //
    }
}
