<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporalRequest;
use App\Http\Requests\UpdateTemporalRequest;
use Illuminate\Http\Request;
use App\Models\Tramite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['code' => Str::random(9)]);
        $url = URL::signedRoute('temporary.create');
        return view('temporary.index' , compact('url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('temporary.create');
    }

    public function create_second()
    {
        return view('temporary.second');
    }

    public function create_third()
    {
        return view('temporary.third');
        
    }

    public function continue(Request $request)
    {
        $tramite = Tramite::where('identificador', $request->code)->first();
        session(['code' => $request->code]);
        if(session('secondStep') == true){
            $url = URL::signedRoute('temporary.create_third');
            return redirect($url);
        }
        if(empty($tramite->motivos) or session('firstStep') == true){
            $url = URL::signedRoute('temporary.create_second');
            return redirect($url);
        }
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
