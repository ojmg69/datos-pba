<div class="box">
    @switch($vista)
    @case('detalle')
    @livewire('detalle-generico', [
    'titulo' => 'nombre',

    'subtitulo' => 'direccion',

    'cuerpo' => [
    'tipo',
    ],
    ])
    @break
    @default
    <div class="box-header">
        <h3 class="box-title">Universidades y Terciarios</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'universidad_o_terciario',

        'columnas' =>
        [
        'nombre' => 'Nombre',
        'tipo' => 'Tipo',
        'distritos.nombre' => 'Municipio'
        ],

        'joins' =>
        [
        'nivel_educativo' => ['nivel_educativo_id', ['tipo']],
        'distritos' => ['distrito_id', ['nombre']],
        ],

        'evento' =>
        [
        'nombre' => 'clickEnEstablecimiento',
        'columna' => 'id'
        ],

        'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por nombre' ],

        'escucharMapa' => true,
        'seccionMapa' => $idSeccion,
        'municipioMapa' => $idMunicipio
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

        window.addEventListener('mostrarMunicipios', () => {
            mapa.municipios();
        })

        window.addEventListener('agregarPines', evento => {
            const pines = evento.detail;
            mapa.agregarPines(pines);
        })

        window.addEventListener('quitarPines', evento => {
            mapa.quitarPines();
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

        window.addEventListener('mostrarSeccion', evento => {
            const id = evento.detail;
            mapa.enfocarMunicipiosDeSeccion(id);
        });

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });
    </script>
    @stop
</div>
