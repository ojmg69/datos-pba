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
                    <a style="float: right" class="btn btn-info" href="{{route('economico.index')}}">Volver a la vista principal</a>
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
                                <th>Fondo Inclusión Social</th>
                                <th>Fondo Fina. Educ.</th>
                                <th>Fondo Infra. Muni. 2017</th>
                                <th>Fondo Ley 14890</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferencias as $transf)
                                <tr>
                                    <td> {{ $transf->distrito }}</td>
                                    <td>$ {{number_format($transf->coparticipacion, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->omision_copart_2019, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->descentralizacion, 0, ',', '.') }} </td>
                                    <td>$ {{number_format($transf->juegos_azar, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->ffps, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->fsa, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->fdo_fort_recursos_muni, 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->fdo_ , 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->fdo_financ_educativo, 0, ',', '.') }} </td>
                                    <td>$ {{number_format($transf->fdo_infra_municipal_2017 , 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->fdo_ley_14890 , 0, ',', '.') }}</td>
                                    <td>$ {{number_format($transf->total , 0, ',', '.') }}</td>
                                    
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
                                <th>Fondo Inclusión Social</th>
                                <th>Fondo Fina. Educ.</th>
                                <th>Fondo Infra. Muni. 2017</th>
                                <th>Fondo Ley 14890</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><hr><br><br>
            </div>
        </div>
    </div>

@stop