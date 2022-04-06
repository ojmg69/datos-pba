<?php

namespace App\Http\Controllers;

use App\Educacion;
use Illuminate\Http\Request;

class EspecialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('especial.index', ["tipo" => $tipo]);
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
     * @param  \App\Educacion  $educacion
     * @return \Illuminate\Http\Response
     */
    public function show(Educacion $educacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Educacion  $educacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Educacion $educacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educacion  $educacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educacion $educacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educacion  $educacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educacion $educacion)
    {
        //
    }
}
