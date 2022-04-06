<?php

namespace App\Http\Controllers;

use App\FuentesInformacion;
use Illuminate\Http\Request;

class FuentesInformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('fuentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FuentesInformacion  $fuentesInformacion
     * @return \Illuminate\Http\Response
     */
    public function show(FuentesInformacion $fuentesInformacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FuentesInformacion  $fuentesInformacion
     * @return \Illuminate\Http\Response
     */
    public function edit(FuentesInformacion $fuentesInformacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FuentesInformacion  $fuentesInformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuentesInformacion $fuentesInformacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FuentesInformacion  $fuentesInformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuentesInformacion $fuentesInformacion)
    {
        //
    }
}
