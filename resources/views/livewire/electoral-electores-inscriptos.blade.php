<div class="col-12">
    <div class="box">
        <div class="box-header d-flex justify-content-between">
            <h3 class="box-title">Electoral - Electores e Inscriptos</h3>
            @if($vista === "tablero")
            <select wire:model="periodoSelected" class="form-control" style="width: 25%">
                <option selected disabled>Seleccione año</option>
                @foreach ($periodos as $periodo)
                <option value="{{ $periodo->id }}">
                    {{ $periodo->nombre }}
                </option>
                @endforeach
            </select>
            @endif
            @if($vista === "general")
            <button class="btn btn-info mb-3" wire:click="verTablero">Volver</button>
            @endif
        </div>

        @switch($vista)
        @case("tablero")
        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Elección General',
        'idGrafico' => 'electoresVotantes',
        'categorias' => $conteoElectores['categorias'],
        'valores' => $conteoElectores['valores'],
        'ordenar' => ['valores', 'desc'],
        ])

        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Circuitos y Mesas',
        'idGrafico' => 'circuitosMesas',
        'categorias' => $conteoCircuitosMesas['categorias'],
        'valores' => $conteoCircuitosMesas['valores'],
        ])

        @livewire('tablero-grafico-dona', [
        'nombre' => 'Gráfico por Concurrencia',
        'idGrafico' => 'graficoElectores',
        'categorias'=> $conteoElectoresGrafico['categorias'],
        'colores' => $conteoElectoresGrafico['colores'],
        'valores' => $conteoElectoresGrafico['valores']
        ])

        <div style="display: flex; justify-content: flex-end">
            <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
        </div>
        @break
        @case("detalle")
        <hr>
        <div class="box-body row">
            <div class="col-7">
                <h4><b>Autoridad:</b> {{ $datosElectores->cargo }}</h4>
                <hr>
                <h4><b>Cargo:</b> {{ $datosElectores->cargo }}</h4>
                <hr>
                <h4><b>Contacto:</b></h4>
                <p>{{ $datosElectores->contacto }}</p>
                <h4><b>Direccion:</b></h4>
                <p>{{ $datosConsulado->direccion }}</p>
            </div>
            <div class="col-5 justifiy-content-center">
            </div>
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                al listado completo</button>
        </div>
        @break
        @case("general")
        <div class="box-body">
            @livewire('tabla-generica', [
            'tabla' => 'electores',

            'joins' =>
            [
            'distritos' => ['distrito_id', ['nombre']],
            'periodo_eleccion' => ['periodo_eleccion_id', ['nombre']],
            ],

            'columnas' =>
            [
            'distritos.nombre' => 'Municipio',
            'inscriptos' => 'Inscriptos',
            'votantes' => 'Votantes',
            'porc_votantes' => 'Concurrencia (%)'
            ],
            'selector' =>
            [
            'porTabla' => [
            'tabla' => 'periodo_eleccion',
            'opciones' => 'nombre',
            'valores' => 'id',
            ],
            'filtrarPor' => 'periodo_eleccion_id',
            'textoDefecto' => 'Selecciona un año',
            'valorInicial' => '2'
            ],

            'escucharMapa' => true,
            'municipioMapa' => $idMunicipio,
            'seccionMapa' => $seccion,
            'periodo' => $periodoSelected,

            'buscador' => [ 'columna' => 'distritos.nombre', 'mensaje' => 'Buscar por nombre' ]
            ])
            @break
            @endswitch


        </div>

        @section('js')
        <script>
            window.addEventListener('mapaListo', evento => {
                mapa.quitarEstilos()
                mapa.quitarReferencias()
                mapa.quitarPines()
                mapa.municipiosSiNoHayFoco()

                const idsMunicipiosResaltados = JSON.parse('{!!  json_encode($idsMunicipiosResaltados) !!}')
                const relleno = '{!!  Config::get('constantes - mapa.estilos.resaltado.relleno ') !!}'
                const borde = '{!!  Config::get('constantes - mapa.estilos.resaltado.borde ') !!}'
                const estilos = idsMunicipiosResaltados.map(id => ({
                    id,
                    relleno,
                    borde
                }))
            });

            window.addEventListener('clickEnLupita', evento => {
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });

        </script>
        @stop

    </div>
