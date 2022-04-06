<div class="col-12">
    <div class="box">
        <div class="box-header d-flex justify-content-between">
            <h3 class="box-title">Municipios - Fiestas Populares</h3>
            @if($vista == "general")
            <button class="btn btn-info mb-3" wire:click="verTablero">Volver</button>
            @endif
        </div>

        @switch($vista)
        @case('tablero')
        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Tipos',
        'idGrafico' => 'contadoresporFiesta',
        'categorias' => $conteoFiestasPopulares['categorias'],
        'valores' => $conteoFiestasPopulares['valores'],
        ])
        
        @livewire('tablero-contadores-por-categoria', [
        'nombre' => '',
        'idGrafico' => 'contadoresporFiesta2',
        'categorias' => $conteoFiestasPopulares2['categorias'],
        'valores' => $conteoFiestasPopulares2['valores'],
        ])
        
        @livewire('tablero-grafico-dona', [
        'nombre' => 'Gráfica Tipológica en %',
        'idGrafico' => 'contadoresporFiestaGrafico',
        'categorias'=> $conteoFiestasPopularesGrafico['categorias'],
        'colores' => $conteoFiestasPopularesGrafico['colores'],
        'valores' => $conteoFiestasPopularesGrafico['valores'],
        ])
        <div style="display: flex; justify-content: flex-end">
            <button class="btn btn-info" wire:click="verGeneral">Ver detalles</button>
        </div>
        @break
        @case("detalle")
        <hr>
        <div class="box-body row">
            <div class="col-6">
                <h4><b>Fiesta:</b> {{ $datosFiestas->nombre }}</h4>
                <hr>
                <h4><b>Municipio:</b> {{ $datosFiestas->distrito->nombre }}</h4>
                <hr>
                <h4><b>Fecha:</b> {{ $datosFiestas->fecha }}</h4>
                <hr>
                <h4><b>Web:</b> <a href="{{ $datosFiestas->sitio_web }}">{{ $datosFiestas->sitio_web }}</a></h4>
                <hr>
            </div>
            <div class="col-6 justifiy-content-center">

                <h4><b>Descripción:</b></h4>
                <div style="height: 250px;overflow-y: scroll; text-align:justify; padding:10px;">
                    {{ $datosFiestas->descripcion }}
                </div>
            </div>
            <button class="mr-3 btn btn-info" wire:click="volver">Atrás</button>
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver al listado completo</button>

        </div>
        @break
        @case("general")
        <!-- /.box-header -->


        <div class="box-body">


            @livewire('tabla-generica', [
            'tabla' => 'fiestas',

            'joins' =>
            [
            'distritos' => ['distrito_id', ['nombre']]
            ],

            'columnas' =>
            [
            'nombre' => 'Fiesta',
            'distritos.nombre' =>'Municipio',
            'fecha' => 'Fecha'
            ],

            'evento' =>
            [
            'nombre' => 'verDetalle',
            'columna' => 'id'
            ],

            'escucharMapa' => true,
            'municipioMapa' => $idMunicipio,
            'seccionMapa' => $idSeccion,

            'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre'],

            'ordenarPor' => [
            ['orden', 'asc']
            ]
            ])




            @break


            @default

            @endswitch




        </div>

        @section('js')
        <script>
            window.addEventListener('mapaListo', evento => {
                mapa.quitarEstilos()
                mapa.quitarReferencias()
                mapa.quitarPines()

                const idsMunicipiosResaltados = JSON.parse('{!! json_encode($idsMunicipiosResaltados) !!}')
                const relleno = '{!! Config::get("constantes-mapa.estilos.resaltado.relleno") !!}'
                const borde = '{!! Config::get("constantes-mapa.estilos.resaltado.borde") !!}'
                const estilos = idsMunicipiosResaltados.map(id => ({ id, relleno, borde }))

                /*  mapa.pintarMunicipios(estilos)
                 mapa.agregarReferencias([{ nombre: 'Municipios con fiestas', relleno, borde }], 'municipios') */
            });

            window.addEventListener('clickEnLupita', evento => {
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });
        </script>
        @stop

    </div
