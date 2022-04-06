<?php

namespace App\Http\Controllers;

use App\Geografia;
use Illuminate\Http\Request;

class GeografiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        return view('geografia.index', ["tipo" => $tipo]);
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
     * @param  \App\Geografia  $geografia
     * @return \Illuminate\Http\Response
     */
    public function show(Geografia $geografia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Geografia  $geografia
     * @return \Illuminate\Http\Response
     */
    public function edit(Geografia $geografia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Geografia  $geografia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geografia $geografia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Geografia  $geografia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Geografia $geografia)
    {
        //
    }
}
