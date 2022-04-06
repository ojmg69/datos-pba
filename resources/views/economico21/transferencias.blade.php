@extends('adminlte::page')

@section('title', 'Económico')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/styles.css?v=<?php echo time(); ?>" />
    <script src="/js/functions.js?v=<?php echo time(); ?>"></script>
    <!-- OpenLayers v6 CSS -->
    <link rel="stylesheet" href="{{ asset('/lib/openlayers-v6.4.3-dist/ol.css') }}">
@stop


@section('content_header')

@stop


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transferencias a Distritos</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <hr>
                    <a style="float: right" class="btn btn-info" href="{{route('economico21.index')}}">Volver a la vista principal</a>
                    <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Distrito</th>
                                <th>Coparticipación</th>
                                <th>Omisión Copart. 2019</th>
                                <th>Descentralización</th>
                                <th>Juegos de Azar</th>
                                <th>FFPS</th>
                                <th>FSA</th>
                                <th>Fondo Fort. Rec. Muni.</th>
                                <th>Fondo </th>
                                <th>Fondo Fina. Educ.</th>
                                <th>Fondo Infra. Muni. 2017</th>
                                <th>Fondo Ley 14890</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferencias as $transf)
                                <tr>
                                    <td> {{ $transf->distrito }}</td>
                                    <td>$ {{ $transf->coparticipacion }}</td>
                                    <td>$ {{ $transf->omision_copart_2019 }}</td>
                                    <td>$ {{ $transf->descentralizacion }}</td>
                                    <td>$ {{ $transf->juegos_azar }}</td>
                                    <td>$ {{ $transf->ffps }}</td>
                                    <td>$ {{ $transf->fsa }}</td>
                                    <td>$ {{ $transf->fdo_fort_recursos_muni }}</td>
                                    <td>$ {{ $transf->fdo_ }}</td>
                                    <td>$ {{ $transf->fdo_financ_educativo }}</td>
                                    <td>$ {{ $transf->fdo_infra_municipal_2017 }}</td>
                                    <td>$ {{ $transf->fdo_ley_14890 }}</td>
                                    <td>$ {{ $transf->total }}</td>
                                    <td> <button wire:click="verDetalle({{ $transf->id }})" class="btn btn-info"><i
                                                class="fas fa-search"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Distrito</th>
                                <th>Coparticipación</th>
                                <th>Omisión Copart. 2019</th>
                                <th>Descentralización</th>
                                <th>Juegos de Azar</th>
                                <th>FFPS</th>
                                <th>FSA</th>
                                <th>Fondo Fort. Rec. Muni.</th>
                                <th>Fondo </th>
                                <th>Fondo Fina. Educ.</th>
                                <th>Fondo Infra. Muni. 2017</th>
                                <th>Fondo Ley 14890</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><hr><br><br>
            </div>
        </div>
    </div>

@stop