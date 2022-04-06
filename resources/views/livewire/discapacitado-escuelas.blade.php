<div class="box">
    @switch($vista)
        @case('detalle')
            @livewire('detalle-generico', [
                'titulo'    => 'nombre',

                'subtitulo' => 'direccion',

                'cuerpo'    => [
                    'sector',
                    'ambito',
                    'localidad',
                    'telefono',
                    'correo_electronico',
                    'modalidad'
                ],
            ])
        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Establecimientos Educativos Especiales</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'discapacitados',

                    'columnas'  =>
                        [
                            'nombre'            => 'Nombre',
                            'modalidad'         => 'Modalidad',
                            'distritos.nombre'  => 'Municipio'
                        ],

                    'joins'     =>
                        [
                            'nivel_educativo'   => ['nivel_educativo_id', ['tipo']],
                            'distritos'         => ['distrito_id', ['nombre']],
                        ],

                    'evento'    =>
                        [
                            'nombre' => 'clickEnEstablecimiento',
                            'columna' => 'id'
                        ],

                    'selector'  => [
                        'tabla' => 'sector_educativo',
                        'colOpcion' => 'nombre',
                        'colValor'  =>  'id',
                        'filtrarPor'    => 'sector_educativo_id',
                        'todos'     => 'Todos los sectores'
                    ],

                    'buscador'  => [ 'columna'   => 'nombre', 'mensaje'   => 'Buscar por nombre' ],

                    'escucharMapa'  => true
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

            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
            mapa.agregarReferencias(referencias, 'municipios', 'Instituciones Educativas Especiales');

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
    </script>
    @stop
</div>
