<div>
    <div class="col-12">
        <div class="box col-12">
            @if ($vista == 'general' || $vista == 'tablero')
                <div class="box-header" style="display: flex; justify-content: space-between;">
                    <h3 class="box-title">Datos Políticos - Intendentes</h3>
                    @if ($vista == 'tablero')
                        <div class="row text-right">
                            <div class="col-12">
                                Incluir Comuna 4
                            </div>    
                            <div class="col-12">
                                <div class="custom-control custom-switch">
                                    <input wire:model="cities" name="cities" wire:change="verTablero(true)" type="checkbox" class="form-control custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Si</label>
                                </div>
                            </div>    
                        </div>
                    @endif
                    @if ($vista == 'general')
                        <button class="btn btn-info" wire:click="verTablero">Volver a vista principal</button>
                    @endif
                </div>
            @endif

            @switch($vista)
                @case('tablero')
                <div class="box-body">
                    <hr>
                    
                    @livewire('tablero-contadores-por-categoria', [
                        'nombre'        => 'Por Partido Político',
                        'idGrafico'     => 'contadoresPorPartido',
                        'categorias'    => $conteoPorPartidos['categorias'],
                        'valores'       => $conteoPorPartidos['valores'],
                        'ordenar'       => ['categorias', 'asc']
                    ])
                    
                    @livewire('tablero-contadores-por-categoria', [
                        'nombre'        => 'Por Género',
                        'idGrafico'     => 'contadoresPorGenero',
                        'categorias'    => $conteoIntendentesPorGenero['categorias'],
                        'valores'       => $conteoIntendentesPorGenero['valores'],
                        'ordenar'       => ['categorias', 'asc']
                    ])

                    @livewire('tablero-grafico-dona', [
                        'nombre'    =>  'Gráfico por Partidos Políticos',
                        'idGrafico' =>  'graficoPartidos',
                        'categorias'=>  $conteoPorPartidos['categorias'],
                        'colores'   =>  $conteoPorPartidos['colores'],
                        'valores'   =>  $conteoPorPartidos['valores']
                    ])

                    <div style="display: flex; justify-content: flex-end">
                        <button class="btn btn-info" wire:click="verGeneral">Ver detalles</button>
                    </div>
                </div>
                @break
                @case("detalle")
                <div class="box-body container">
                    <div class="row align-items-center">
                        <img style="border-radius: 50%" width="100px" height="100px"
                            src="{{ url('img/personas/intendentes/' . $intendente->imagen) }}"
                            alt="Foto de {{ $intendente->intendente }}" />
                        <div class="m-2">
                            <span class="h3 font-weight-bold">{{ $intendente->intendente }}</span>
                            <h6 style="color: {{ $intendente->partido->color }};">
                                {{ $intendente->partido->nombre }}
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div style="text-align:justify;">{!! nl2br ($intendente-> historia) !!}</div><hr>
                    </div>

                    <button class="btn btn-info" wire:click="verGeneral">Volver al listado completo</button>
                    <button class="btn btn-info" wire:click="verTablero">Volver a vista principal</button>
                </div>
                @break
                @case("general")
                <!-- /.box-header -->
                <div class="box-body">
                    <hr>
                    @livewire('tabla-generica', [
                        'tabla'     => 'intendentes',

                        'columnas'  =>
                            [
                                'distritos.nombre'  => 'Municipio',

                                'imagen'            =>
                                    [ 'encabezado' => 'Foto', 'tipo' => 'img', 'prefijoUrl' => '../img/personas/intendentes/' ],

                                'intendente'        => 'Intendente',

                                'partidos.nombre'   => [ 'encabezado' => 'Partido', 'tipo' => 'coloreada', 'columnaColor' => 'partidos.color' ],
                            ],

                        'joins'     =>
                            [
                                'distritos'    => ['distrito_id', ['nombre']],
                                'partidos'    => ['partido_id', ['nombre', 'color']]
                            ],

                        'ordenarPor' => [ ['distritos.nombre', 'asc'] ],

                        'selector'  =>
                            [
                                'porTabla' =>   [
                                    'tabla'        => 'partidos',
                                    'opciones'     => 'nombre',
                                    'valores'      => 'id',
                                ],                               
                                'filtrarPor'      => 'partido_id',
                                'textoDefecto'    => 'Todos los partidos'
                            ],

                        'buscador'  => [ 'columna' => 'intendente', 'mensaje' => 'Buscar por nombre'],

                        'evento'    =>
                            [
                                'nombre' => 'verDetalleIntendente',
                                'columna' => 'id'
                            ],

                        'escucharMapa'  => true,
                        'seccionMapa' => $idSeccion
                    ])
                </div>
                @break

            @endswitch
        </div>

        @push('js')
            <script>
                window.addEventListener('mapaListo', evento => {
                    const mapa = evento.detail;
                    mapa.quitarReferencias()
                    mapa.quitarPines()
                    mapa.municipiosSiNoHayFoco()

                    const estilos = JSON.parse('{!!  json_encode($estilos) !!}');
                    mapa.pintarMunicipios(estilos);

                    const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
                    referencias.push({
                        nombre: "Intendenta",
                        borde: "#8E44AD"
                    })
                    mapa.agregarReferencias(referencias, 'municipios');

                    if (!mapa.hayMunicipioGuardado()) {
                        mapa.municipios();
                    }
                });

                window.addEventListener('clickEnLupita', evento => {
                    const id = evento.detail;
                    mapa.mostrarMunicipio(Number(id))
                });

            </script>
        @endpush
    </div>

</div>
