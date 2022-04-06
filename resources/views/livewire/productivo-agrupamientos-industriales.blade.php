<div class="box">
    @switch($vista)
    @case('detalle')
    <div class="box-header">
        <h3 class="box-title font-weight-bold">{{ $pyme->nombre }}</h3>
        <span>{{ $pyme->localidad }}</span>
        <hr>
    </div>

    <div class="box-body">
        <span class="font-weight-bold">Pertenece al agrupamiento:</span>
        <p>{{ $pyme->agrupamientoIndustrial->nombre }}</p>
        <div>

            <button class="btn btn-info my-4" wire:click="verPyMEs">Volver a PyMEs</button>
            @break
            @case('tablero')
            @livewire('tablero-contadores-por-categoria', [
            'nombre' => 'Números',
            'idGrafico' => 'agrupamientoIndustrialNumero',
            'categorias' => $conteoAgrupamientosNumero['categorias'],
            'valores' => $conteoAgrupamientosNumero['valores'],
            'ordenar' => ['valores', 'asc']
            ])

            @livewire('tablero-contadores-por-categoria', [
            'nombre' => 'Tipos',
            'idGrafico' => 'agrupamientoIndustrialTipo',
            'categorias' => $conteoAgrupamientosTipo['categorias'],
            'valores' => $conteoAgrupamientosTipo['valores'],
            'ordenar' => ['valores', 'asc']
            ])

            @livewire('tablero-grafico-dona', [
            'nombre' => 'Gráfica tipológica en %',
            'idGrafico' => 'agrupamientoGrafico',
            'categorias'=> $conteoAgrupamientosTipGrafica['categorias'],
            'colores' => $conteoAgrupamientosTipGrafica['colores'],
            'valores' => $conteoAgrupamientosTipGrafica['valores']
            ])

            <div style="display: flex; justify-content: flex-end">
                <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
            </div>
            @break
            @case('detalle-agrupamiento')
            @livewire('detalle-generico',
            [
            'titulo' => 'nombre',

            'subtitulo' => 'direccion',

            'cuerpo' => [
            'web',
            'contacto',
            'teléfono',
            'email'
            ],

            'volver' => 'verAgrupamientos',

            'boton' => [ 'nombre' => 'Ver PyMEs', 'evento' => 'verPyMEs' ],
            ]
            )
            @break
            @case('pymes')
            <div class="box-header">
                <h3 class="box-title">PyMEs</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'pymes',

                'columnas' =>
                [
                'nombre' => 'Nombre',
                'tipo_agrupamientos.nombre' => 'Tipo',
                'localidad' => 'Localidad',
                ],

                'joins' =>
                [
                'tipo_agrupamientos' => ['tipo_agrupamiento_id', ['nombre']]
                ],

                'evento' => [ 'nombre' => 'clickEnPyme', 'columna' => 'id' ],

                'preFiltrado' => [
                'columna' => 'agrupamiento_industrial_id',
                'evento' => 'agrupamientoActualizado'
                ],

                'escucharMapa' => true,

                'boton' => 'Volver a Agrupamiento',

                'buscador' => [
                'columna' => 'nombre',
                'mensaje' => 'Buscar por nombre'
                ]
                ])
            </div>
            @break
            @case('agrupamientos')
            <div class="box-header d-flex justify-content-between">
                <h3 class="box-title">Agrupamientos Industriales</h3>
                <button class="btn btn-info mb-3" wire:click="verTablero">Volver</button>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'agrupamiento_industriales',

                'columnas' =>
                [
                'nombre' => 'Nombre',
                ],

                'evento' =>
                [
                'nombre' => 'clickEnAgrupamiento',
                'columna' => 'id'
                ],

                'escucharMapa' => true,
                'municipioMapa' => $idDistritoSeleccionado,
                'seccionMapa' => $seccion,
                'buscador' => [
                'columna' => 'nombre',
                'mensaje' => 'Buscar por nombre'
                ]
                ])
            </div>
            @break
            @endswitch

            @section('js')
            <script>
                window.addEventListener('mapaListo', evento => {
                    mapa.quitarEstilos()
                    mapa.quitarReferencias()
                    mapa.quitarPines()
                    mapa.municipiosSiNoHayFoco()

                    const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
                    mapa.agregarPines(pines);
                });

                window.addEventListener('enfocarCoordenadas', evento => {
                    const pin = evento.detail.coords
                    if (pin.latitud !== null && pin.longitud !== null) {
                        mapa.enfocarPunto({ latitud: pin.latitud, longitud: pin.longitud })
                        mapa.agregarPines([pin])
                    }
                });

                window.addEventListener('clickEnLupita', evento => {
                    const id = evento.detail;
                    mapa.mostrarMunicipio(id)
                });
            </script>
            @stop
        </div>
