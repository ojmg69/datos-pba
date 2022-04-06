<?php

namespace App\Http\Controllers;

use App\Productivo;
use Illuminate\Http\Request;

class ProductivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('productivo.index', ["tipo" => $tipo]);
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
     * @param  \App\Productivo  $productivo
     * @return \Illuminate\Http\Response
     */
    public function show(Productivo $productivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productivo  $productivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Productivo $productivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productivo  $productivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productivo $productivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productivo  $productivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productivo $productivo)
    {
        //
    }
}
