<?php

namespace App\Http\Controllers;

use App\Cultura;
use Illuminate\Http\Request;

class CulturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('cultura.index', ["tipo" => $tipo]);
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
     * @param  \App\Cultura  $cultura
     * @return \Illuminate\Http\Response
     */
    public function show(Cultura $cultura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cultura  $cultura
     * @return \Illuminate\Http\Response
     */
    public function edit(Cultura $cultura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cultura  $cultura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cultura $cultura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cultura  $cultura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cultura $cultura)
    {
        //
    }
}
