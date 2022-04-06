<?php

namespace App\Http\Controllers;

use App\Electoral;
use Illuminate\Http\Request;

class ElectoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('electoral.index', ["tipo" => $tipo]);
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
     * @param  \App\Electoral  $electoral
     * @return \Illuminate\Http\Response
     */
    public function show(Electoral $electoral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Electoral  $electoral
     * @return \Illuminate\Http\Response
     */
    public function edit(Electoral $electoral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Electoral  $electoral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Electoral $electoral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Electoral  $electoral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electoral $electoral)
    {
        //
    }
}
