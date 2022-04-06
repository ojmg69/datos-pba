<div class="box">
    <div class="box-header" style="display: flex; justify-content: space-between;">
        <h3 class="box-title">Especial</h3>
        @if ($vista === 'escuelas-por-sector' || $vista === 'escuelas-por-nivel' )
        <button class="btn btn-info mb-3" wire:click="verTablero">Volver a vista principal</button>
        @endif
    </div>
    @switch($vista)
    @case('tablero')
    @livewire('tablero-contadores-por-categoria', [
    'nombre' => 'Clasificación por Administración',
    'idGrafico' => 'conteoClasificacionAdministracion',
    'categorias' => $conteoClasificacionAdministracion['categorias'],
    'valores' => $conteoClasificacionAdministracion['valores']
    ])

    @livewire('tablero-contadores-por-categoria', [
    'nombre' => 'Niveles',
    'idGrafico' => 'conteoClasificacionNivel',
    'categorias' => $conteoClasificacionNivel['categorias'],
    'valores' => $conteoClasificacionNivel['valores'],
    ])

    @livewire('tablero-grafico-dona', [
    'nombre' => 'Gráfico por partido politico',
    'idGrafico' => 'conteoClasificacionAdministracionGrafica',
    'categorias'=> $conteoClasificacionAdministracionGrafica['categorias'],
    'colores' => $conteoClasificacionAdministracionGrafica['colores'],
    'valores' => $conteoClasificacionAdministracionGrafica['valores'],
    ])
    <div style="display: flex; justify-content: flex-end">
        <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
    </div>
    @break
    @case('detalle')
    @livewire('detalle-generico', [
    'titulo' => 'nombre',

    'subtitulo' => 'direccion',

    'cuerpo' => [
    'sector',
    'ambito',
    'localidad',
    'telefono',
    'correo_electronico',
    'modalidad'
    ],
    ])
    @break
    'condicional' => ['columna' => 'modalidad', 'valor' => 'Educación Especial'],
    @case('escuelas-por-sector')
    <div class="box-body">

        @livewire('tabla-generica', [
        'tabla' => 'establecimientos_educativos',

        'columnas' =>
        [
        'nombre' => 'Nombre',
        'modalidad' => 'Modalidad',
        'nivel_educativo.nombre' => 'Nivel Educativo',
        'distritos.nombre' => 'Municipio'
        ],

        'joins' =>
        [
        'nivel_educativo' => ['nivel_educativo_id', ['nombre']],
        'distritos' => ['distrito_id', ['nombre']],
        ],

        'evento' =>
        [
        'nombre' => 'clickEnEstablecimiento',
        'columna' => 'id'
        ],

        'selector' =>
        [
        'porTabla' => [
        'tabla' => 'sector_educativo',
        'opciones' => 'nombre',
        'valores' => 'id',
        ],
        'filtrarPor' => 'sector_educativo_id',
        'textoDefecto' => 'Todos los sectores'
        ],

        'condicional' => ['columna' => 'modalidad', 'valor' => 'Educación Especial'],
        'boton' => [ 'nombre' => 'Filtro por Nivel', 'evento' => 'verEscuelasPorNivel', 'resetPage' => true ],
        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],

        'escucharMapa' => true,
        'municipioMapa' => $idMunicipio,
        'seccionMapa' => $seccion
        ])
    </div>
    @break
    @case('escuelas-por-nivel')
    <div class="box-body">

        @livewire('tabla-generica', [
        'tabla' => 'establecimientos_educativos',

        'columnas' =>
        [
        'nombre' => 'Nombre',
        'modalidad' => 'Modalidad',
        'nivel_educativo.nombre' => 'Nivel Educativo',
        'distritos.nombre' => 'Municipio'
        ],

        'joins' =>
        [
        'nivel_educativo' => ['nivel_educativo_id', ['nombre']],
        'tipo_establecimiento_educativo' => ['tipo_establecimiento_id', ['nombre']],
        'distritos' => ['distrito_id', ['nombre']],
        ],

        'evento' =>
        [
        'nombre' => 'clickEnEstablecimiento',
        'columna' => 'id'
        ],

        'selector' => [
        'tabla' => 'sector_educativo',
        'opciones' => 'nombre',
        'valores' => 'id',
        ],
        'filtrarPor' => 'sector_educativo_id',
        'todos' => 'Todos los sectores',

        'selector' =>
        [
        'porTabla' => [
        'tabla' => 'tipo_establecimiento_educativo',
        'opciones' => 'nombre',
        'valores' => 'id',
        ],
        'filtrarPor' => 'tipo_establecimiento_id',
        'textoDefecto' => 'Todos los sectores'
        ],

        'condicional' => ['columna' => 'modalidad', 'valor' => 'Educación Especial'],
        'boton' => [ 'nombre' => 'Filtro por Sector', 'evento' => 'verEscuelasPorSector', 'resetPage' => true ],
        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],

        'escucharMapa' => true,
        'municipioMapa' => $idMunicipio,
        'seccionMapa' => $seccion
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

            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
            mapa.agregarReferencias(referencias, 'municipios', 'Instituciones Educativas');

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
        });

        window.addEventListener('mostrarMunicipios', () => {
            mapa.municipios();
        })

        window.addEventListener('agregarPines', evento => {
            const pines = evento.detail
            mapa.agregarPines(pines);
        })

        window.addEventListener('quitarPines', evento => {
            mapa.quitarPines();
        })

        window.addEventListener('pinesActualizados', evento => {
            mapa.agregarPines(evento.detail);
        })

        window.addEventListener('enfocarCoordenadas', evento => {
            const latitud = Number(evento.detail.coords.latitud)
            const longitud = Number(evento.detail.coords.longitud)
            const relleno = String(evento.detail.coords.relleno);

            const idMunicipio = Number(evento.detail.idMunicipio)
            if (latitud !== null && longitud !== null) {
                mapa.mostrarMunicipio(idMunicipio)
                mapa.enfocarPunto({ latitud, longitud })
                mapa.agregarPines([{ latitud, longitud, relleno }])
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
