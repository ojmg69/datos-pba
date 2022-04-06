<?php

namespace App\Http\Controllers;

use App\Sanitario;
use Illuminate\Http\Request;

class SanitarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('sanitario.index', ["tipo" => $tipo]);
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
     * @param  \App\Sanitario  $sanitario
     * @return \Illuminate\Http\Response
     */
    public function show(Sanitario $sanitario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sanitario  $sanitario
     * @return \Illuminate\Http\Response
     */
    public function edit(Sanitario $sanitario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sanitario  $sanitario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanitario $sanitario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sanitario  $sanitario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sanitario $sanitario)
    {
        //
    }
}
