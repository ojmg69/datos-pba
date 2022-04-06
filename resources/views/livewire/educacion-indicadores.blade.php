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
                <h3 class="box-title">Indicadores</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'indicadores',

                    'columnas'  =>
                        [
                            'distritos.nombre'      => 'Municipio',
                            'nivel'                 => 'Nivel',
                            'cantidad_de_alumnos'   => 'Alumnos',
                            'tasa_de_egreso'        => 'Egreso',
                            'tasa_de_repitencia'    => 'Repitencia',
                            'tasa_de_abandono'      => 'Abandono',
                        ],

                    'joins'     =>
                        [
                            'distritos'   => ['distrito_id', ['nombre']]
                        ],

                    'buscador'  => [ 'columna'   => 'distritos.nombre', 'mensaje'   => 'Buscar por municipio' ],

                    'escucharMapa'  => true,

                    'ordenarPor'    => [
                        ['distritos.nombre', 'asc'],
                        ['nivel', 'asc']
                    ]
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

            const estilos = JSON.parse('{!!  json_encode($this->estilos) !!}')
            mapa.pintarMunicipios(estilos);
            const referencias = JSON.parse('{!!  json_encode($this->referencias) !!}')
            mapa.agregarReferencias(referencias, 'municipios');
        });
    </script>
    @stop
</div>
