<div>
    <div class="col-12">
        <div class="box col-12">

            @if ($vista == 'general' || $vista == 'tablero')
            <div class="box-header" style="display: flex; justify-content: space-between;">
                <h3 class="box-title">Establecimientos Sanitarios</h3>
                @if ($vista == 'general')
                <button class="btn btn-info" wire:click="verTablero">Volver a vista principal</button>
                @endif
            </div>
            <hr>
            @endif

            @switch($vista)

            @case('tablero')
            @livewire('tablero-contadores-por-categoria', [
            'nombre' => 'Establecimentos por tipo de administración',
            'idGrafico' => 'contadoresporTipoEstablecimiento',
            'categorias' => $conteoPorTipo['categorias'],
            'valores' => $conteoPorTipo['valores'],
            'ordenar' => ['valores', 'desc']
            ])

            @livewire('tablero-contadores-por-categoria', [
            'nombre' => 'Totales por Categoría',
            'idGrafico' => 'contadoresPorCategoria',
            'categorias' => $conteoPorCategoria['categorias'],
            'valores' => $conteoPorCategoria['valores'],
            'ordenar' => ['valores', 'desc']
            ])
            
            @livewire('tablero-grafico-dona', [
            'nombre' => 'Gráfico por Categoría',
            'idGrafico' => 'graficoPorCategoria',
            'categorias'=> $conteoPorCategoria['categorias'],
            'colores' => $conteoPorCategoria['colores'],
            'valores' => $conteoPorCategoria['valores'],
            'info' => 'La categoría "otros" incluye: vacunatorios, unidades móviles y C.I.C.',
            ])

            <div style="display: flex; justify-content: flex-end">
                <button class="btn btn-info" wire:click="verGeneral">Ver detalles</button>
            </div>
             <i>*La categoría "otros" incluye: vacunatorios, unidades móviles y C.I.C.</i>
            @break


            @case('detalle')
            <div class="box-header">
                <h3 class="box-title font-weight-bold">{{ $establecimiento->nombre }}</h3>
                <hr>
            </div>

            <div class="box-body">
                @if ($establecimiento->direccion)
                <span class="font-weight-bold">Dirección:</span>
                <p>{{ $establecimiento->direccion }}</p>
                @endif

                @if ($establecimiento->contacto)
                <span class="font-weight-bold">Contacto:</span>
                <p>{{ $establecimiento->contacto }}</p>
                @endif
            </div>

            <button class="btn btn-info my-4" wire:click="verTabla">Volver al listado completo</button>
            @break
            @default
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'establecimientos_sanitarios',

                'columnas' =>
                [
                'nombre' => 'Nombre',
                'localidad' => 'Localidad',
                'tipos_establecimientos.nombre' => 'Administración',
                'detalles' => 'Tipo',
                ],

                'joins' =>
                [
                'tipos_establecimientos' => ['tipos_establecimientos_id', ['nombre']],
                'categorias_establecimientos' => ['categorias_establecimientos_id', ['nombre']]
                ],

                'evento' => [ 'nombre' => 'clickEnEstablecimiento', 'columna' => 'id' ],

                'escucharMapa' => true,
                'seccionMapa' => $idSeccion,
                'municipioMapa' => $idMunicipio,

                'buscador' => [
                'columna' => 'nombre',
                'mensaje' => 'Buscar por nombre'
                ],


                'selector' => [
                'porTabla' => [
                'tabla' => 'categorias_establecimientos',
                'opciones' => 'nombre',
                'valores' => 'id',
                ],
                'filtrarPor' => 'categorias_establecimientos_id',
                'textoDefecto' => 'Todas las categorias'
                ]
                ])
            </div>



            @endswitch
        </div>
    </div>

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipiosSiNoHayFoco()

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);

            const referencias = JSON.parse('{!!  json_encode($this->referencias) !!}')
            mapa.agregarReferencias(referencias, 'municipios', 'Categoría');
        });

        window.addEventListener('pinesActualizados', evento => {
            mapa.agregarPines(evento.detail);
        })

        window.addEventListener('enfocarCoordenadas', evento => {
            const latitud = Number(evento.detail.coords.latitud)
            const longitud = Number(evento.detail.coords.longitud)
            const idMunicipio = Number(evento.detail.idMunicipio)
            if (latitud !== null && longitud !== null) {
                mapa.mostrarMunicipio(idMunicipio)
                mapa.enfocarPunto({ latitud, longitud })
                mapa.agregarPines([{ latitud, longitud, relleno: '#f00' }])
            }
        });

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });
        
        window.addEventListener('mostrarSeccion', evento => {
            const id = evento.detail;
            mapa.enfocarMunicipiosDeSeccion(id);
        });

        window.addEventListener('mostrarTodosLosMunicipios', function () {
            mapa.municipios();
        });
    </script>
    @stop
</div>
