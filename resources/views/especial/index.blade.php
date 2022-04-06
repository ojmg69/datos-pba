@extends('adminlte::page')

@section('title', 'Discapacidad')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- OpenLayers v6 CSS -->
    <link rel="stylesheet" href="{{ asset('/lib/openlayers-v6.4.3-dist/ol.css') }}">
@stop


@section('content_header')

@stop

@section('content')
    @livewire('especial', ['visual' => $tipo]);
@stop

@section('js')

@stop
