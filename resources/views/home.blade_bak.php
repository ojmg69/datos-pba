@extends('adminlte::page')

@section('title', 'Inicio')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- OpenLayers v6 CSS -->
    <link rel="stylesheet" href="{{ asset('lib/openlayers-v6.4.3-dist/ol.css') }}">
@stop


@section('content_header')

@stop

@section('content')
    <div class="container" style="background-color: #015875">
        <h3>Panel de Inicio</h3>
        <hr>
        <div class="row">
            <div class="col-8">

                <h5><b>¡Te damos la bienvenida {{ auth()->user()->name }}!</b></h5>

                <h5>El mapa digital de la provincia de Buenos Aires, es un instrumento de planificación
                    estratégica de mediano y largo plazo que visibiliza el panorama actual, el potencial y lo
                    transcurrido a través de los avances registrados.</h5>
                <h5> Aborda información precisa y actualizada, de fuentes oficiales de cada uno de los municipios en base a
                    los
                    siguientes
                    ejes:</h5>
                <ul>
                    
                    <A style=color:#ffffff; HREF='https://datospba.ar/municipios/intendente'> <h5><li type="circle">Municipios</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/politico-institucional/gobernacion'> <li>Institucional</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/electoral/resultados'> <li>Electoral</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/economico'> <li>Económico</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/productivo/agrupamientos-industriales'> <li>Productivo</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/vivienda/asentamientos'> <li>Vivienda</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/sanitario/regiones'> <li>Sanitario</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/educacion/escuelas'> <li>Educación</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/construccion'> <li>Discapacidad</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/cultura/espacios-culturales'> <li>Cultura</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/medioambiente/politicas-locales'> <li>Medioambiente</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/genero/comisarias-mujer'> <li>Género</li></A>
                    <A style=color:#ffffff; HREF='https://datospba.ar/geografia/clima'> <li>Geografía</li></h5></A>

                </ul>
            </div>
            <div class="col-4">
                <img src="{{ url('/img/logo_senado/senado_logos-Celeste.png') }}" alt="" width="100%">
            </div>
        </div>
    </div>
@stop


@section('js')


    <script src="{{ asset('js/mapcontrol.js') }}"></script>
@stop
