@extends('adminlte::page')

@section('title', 'Económico')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- OpenLayers v6 CSS -->
    <link rel="stylesheet" href="{{ asset('/lib/openlayers-v6.4.3-dist/ol.css') }}">
@stop


@section('content_header')

@stop


@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-8"><hr>
                <h2><font color="#3E444D">Módulo en construcción. Disculpe las molestias.</font></h2>
                <hr>
                <h3><font color="#3E444D">Estado:</font></h3>
                <h4><font color="#3E444D"> -- Carga y normalización de datos</font></h4> <br>
                <hr>
                <h4><font color="#3E444D">Continúe navegando por el menú o regrese al <a href="{{ route('home') }}"> Panel de Inicio</font></a>
                </h4>
                <hr>
            </div>
            <div class="col-4">
                <img src="{{ url('/img/construccion.png') }}" alt="" width="100%">
            </div>
        </div>
    </div>
@stop
