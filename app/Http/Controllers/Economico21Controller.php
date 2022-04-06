<?php

namespace App\Http\Controllers;

use App\Economico21;
use App\Gasto;
use App\Transferencia;
use Illuminate\Http\Request;

class Economico21Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('economico21.index');
    }
    public function transferencias()
    {
        $transferencias = Transferencia::all();
        return view('economico21.transferencias',compact('transferencias'));
    }

    public function composicionGastos(){
        return view('economico.comp-gastos');
    }
    public function gastos()
    {
        $gastos = Gasto::all();
        return view('economico.gastos',compact('gastos'));
    }

    public function cargarGrafico($id)
    {

        $transferencias = Transferencia::where('distrito_id','=',$id)->first();

        dd($transferencias);
        $labels = $transferencias->pluck('id');
        $data = $transferencias->pluck('economico21');

        
        return response()->json(compact('labels', 'data'));
    }

    public function transferenciasDeDistrito($id) {
        $transferencia = Transferencia::where('distrito_id', '=', intval($id))->get()[0];
        $jsonTransferencia = [
            'Distrito'                  =>  $transferencia->distrito,
            'Coparticipacion'           =>  $transferencia->coparticipacion,
            'Omision Copart. 2019'      =>  $transferencia->omision_copart_2019,
            'Descentralizacion'         =>  $transferencia->descentralizacion,
            'Juegos de Azar'            =>  $transferencia->juegos_azar,
            'FFPS'                      =>  $transferencia->ffps,
            'FSA'                       =>  $transferencia->fsa,
            'Fondo Fort. Rec. Muni.'    =>  $transferencia->fdo_fort_recursos_muni,
            'Fond'                      =>  $transferencia->fdo_,
            'Fondo Fina. Educ.'         =>  $transferencia->fdo_financ_educativo,
            'Fondo Infra. Muni. 2017'   =>  $transferencia->fdo_infra_municipal_2017,
            'Fondo Ley 14890'           =>  $transferencia->fdo_ley_14890,
        ];
        return response()->json($jsonTransferencia);
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
     * @param  \App\Economico  $economico
     * @return \Illuminate\Http\Response
     */
    public function show(Economico $economico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Economico  $economico
     * @return \Illuminate\Http\Response
     */
    public function edit(Economico $economico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Economico  $economico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Economico $economico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Economico  $economico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Economico $economico)
    {
        //
    }
}
