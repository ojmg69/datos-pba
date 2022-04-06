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
                    <h3 class="box-title">Gastos de Distritos</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <hr>
                    <a style="float: right" class="btn btn-info" href="{{route('economico.index')}}">Volver a la vista principal</a>
                    <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Distrito</th>
                                <th>Personal</th>
                                <th>Obras Públicas</th>
                                <th>Servicios</th>
                                <th>Gastos Figurativos</th>
                                <th>Bienes de Consumo</th>
                                <th>Bienes de Uso</th>
                                <th>Transferencias</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gastos as $gas)
                                <tr>
                                    <td> {{  $gas->distrito }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->personal }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->obras_publicas }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->servicios }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->gastos_figurativos }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->bienes_de_consumo }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->bienes_de_uso }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->transferencias }}</td>
                                    <td>$ {{NumberFormatter::create( 'es_ES', NumberFormatter::DECIMAL )->format( $gas->total }}</td>
                                    <td> <button wire:click="verDetalle({{ $gas->id }})" class="btn btn-info"><i
                                                class="fas fa-search"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Distrito</th>
                                <th>Personal</th>
                                <th>Obras Públicas</th>
                                <th>Servicios</th>
                                <th>Gastos Figurativos</th>
                                <th>Bienes de Consumo</th>
                                <th>Bienes de Uso</th>
                                <th>Transferencias</th>
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