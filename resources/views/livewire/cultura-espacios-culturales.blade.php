<div class="box">
    @switch($vista)
    @case('detalle')
    @livewire('detalle-generico',
    [
    'titulo' => 'nombre',

    'subtitulo' => 'direccion',

    'cuerpo' => [
    'actividades',
    'contacto',
    ],
    ]
    )
    @break
    @default
    <div class="box-header">
        <h3 class="box-title">Espacios Culturales</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'espacio_cultural',

        'joins' => [
        'tipo_espacio_cultural' => ['tipo_espacio_cultural_id', ['nombre']],
        'distritos' => ['distrito_id', ['nombre']]
        ],

        'columnas' =>
        [
        'nombre' => 'Nombre',
        'distritos.nombre' => 'Municipio',
        'tipo_espacio_cultural.nombre' => 'Tipo',
        'direccion' => 'Dirección',
        ],

        'escucharMapa' => true,
        'seccionMapa' => $idSeccion,
        'municipioMapa' => $idMunicipio,

        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre'],

        'selector' =>
        [
        'porTabla' => [
        'tabla' => 'tipo_espacio_cultural',
        'opciones' => 'nombre',
        'valores' => 'id',
        ],
        'filtrarPor' => 'tipo_espacio_cultural_id',
        'textoDefecto' => 'Todos los tipos'
        ],

        'evento' =>
        [
        'nombre' => 'clickEnEntidad',
        'columna' => 'id'
        ],
        ])
    </div>
    @endswitch

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipiosSiNoHayFoco()
            // mapa.municipios()

            const pines = JSON.parse('{!!  json_encode($pines) !!}')
            mapa.agregarPines(pines);
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
