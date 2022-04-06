<div>
    @switch($vista)
    @case('tablero')
    @livewire('tablero-contadores-por-categoria', [
    'nombre' => 'Clasificación por tipo',
    'idGrafico' => 'conteoTribunalesJuzgados',
    'categorias' => $conteoTribunalesJuzgados['categorias'],
    'valores' => $conteoTribunalesJuzgados['valores'],
    ])
    @livewire('tablero-grafico-dona', [
    'nombre' => 'Gráfica por tipo',
    'idGrafico' => 'agrupamientoGrafico',
    'categorias'=> $conteoTribunalesJuzgadosGrafica['categorias'],
    'colores' => $conteoTribunalesJuzgadosGrafica['colores'],
    'valores' => $conteoTribunalesJuzgadosGrafica['valores']
    ])
    <div style="display: flex; justify-content: flex-end">
        <button class="btn btn-info" wire:click="verDetalles">Ver Detalles</button>
    </div>
    @break
    @case('departamentos')
    <div class="box-header">
        <div class="d-flex justify-content-between my-2">
            <h3 class="box-title">Tribunales y Juzgados</h3>
            <button class="btn btn-info" wire:click="verGeneral">Volver</button>
        </div>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'departamentos',

        'columnas' =>
        [
        'nombre' => 'Nombre',
        ],

        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],
        'escucharMapa' => true,

        'evento' =>
        [
        'nombre' => 'clickEnDepartamento',
        'columna' => 'id'
        ],
        ])
    </div>
    @break

    @case('sedes')
    <div class="box-header">
        <div class="d-flex justify-content-between my-2">
            <h3 class="box-title">Sedes</h3>
            <button class="btn btn-info" wire:click="verGeneral">Volver</button>
        </div>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'sedes',

        'columnas' =>
        [
        'nombre' => 'Nombre',
        'distritos.nombre' => 'Municipio'
        ],
        
        'joins' =>
        [
        'distritos' => ['distrito_id', ['nombre']],
        ],

        'escucharMapa' => true,
        'seccionMapa' => $seccion,
        'municipioMapa' => $distritoSeleccionadoId,

        'botonTabla' => [
        'nombre' => 'botonVerDeptoEntero',
        'texto' => 'Ver departamento entero',
        'resetPage' => true,
        ],

        'preFiltrado' => [
        'columna' => 'distrito_id',
        'valor' => $distritoSeleccionadoId,
        'evento' => 'distritoSeleccionadoActualizado',
        'resetearMunicipioAlActualizar' => true
        ],

        'preFiltradoDos' => [
        'columna' => 'dpto_judicial_id',
        'evento' => 'deptoJudicialActualizado',
        'resetearMunicipioAlActualizar' => true
        ],

        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],

        'evento' =>
        [
        'nombre' => 'verSede',
        'columna' => 'id'
        ],

        'selector' =>
        [
        'porTabla' => [
        'tabla' => 'organos',
        'opciones' => 'nombre',
        'valores' => 'id',
        ],
        'filtrarPor' => 'organo_id',
        'textoDefecto' => 'Todos los organos'
        ]
        ])
    </div>
    @break

    @case('sede')
    <div class="box-body container">
        <div class="row align-items-center">
            <div class="m-2">
                <span class="h3 font-weight-bold">{{ $sede->nombre }}</span>
                <h6>{{ $sede->dpto_nombre }}</h6>
            </div>
        </div>

        <hr>

        <div class="col-12">
            <div class="row">
                <span class="font-weight-bold mr-2">Teléfono:</span>
                <span>{{ $sede->telefono }}</span>
            </div>

            <div class="row">
                <span class="font-weight-bold mr-2">Dirección:</span>
                <span>{{ $sede->direccion }}</span>
            </div>
        </div>

        <button class="btn btn-info my-4" wire:click="verDetalles">Volver al listado completo</button>
    </div>
    @break
    @endswitch

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarPines()
            mapa.quitarReferencias()
            mapa.municipiosSiNoHayFoco()

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
        });

        window.addEventListener('agregarPines', evento => {
            const pines = JSON.parse('{!! json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
        })

        window.addEventListener('mostrarMunicipios', evento => {
            mapa.municipios();
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

    </script>
    @stop
</div>
