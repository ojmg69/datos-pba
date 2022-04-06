<div class="box">
    @switch($vista)
    @case('detalle')
    @livewire('detalle-generico', [
    'titulo' => 'nombre',

    'subtitulo' => 'direccion',

    'cuerpo' => [
    'observaciones',
    ],
    ])
    @break
    @default
    <div class="box-header">
        <h3 class="box-title">Espacios de Contención</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'espacios_contencion',

        'columnas' =>
        [
        'distritos.nombre' => 'Municipio',
        'nombre' => 'Nombre',
        ],

        'joins' =>
        [
        'distritos' => ['distrito_id', ['nombre']]
        ],

        'evento' =>
        [
        'nombre' => 'clickEnEspacio',
        'columna' => 'id'
        ],

        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],

        'escucharMapa' => true,
        'municipioMapa' => $idMunicipio,
        'seccionMapa' => $idSeccion,
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

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
        });

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
