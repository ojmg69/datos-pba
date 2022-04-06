<div class="box">
    <div class="box-header">
        <h3 class="box-title">Representatividad Política</h3>
    </div>

    @livewire('selector',
        [
            'textoDefecto'  => 'General',
            'porValores'    => [
                ['Frente de Todos', 'FDT'],
                ['Juntos por el Cambio', 'JXC'],
                ['Otros', 'Otros']
            ]
        ]
    )
    @switch($vista)
        @case('todos')
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'representatividad_politica',

                    'joins'     => [
                        'distritos'         => ['distrito_id', ['nombre']],
                    ],

                    'columnas'  =>
                        [
                            'distritos.nombre'      => 'Municipio',
                            'total_concejales'      => 'Total de Concejales',
                            'concejalas'            => 'Concejalas',
                            'porcentaje_concejalas' => 'Concejalas (%)',
                        ],

                    'escucharMapa'  => true,
                    'preFiltrado' => ['columna' => 'distrito_id', 'evento' => 'cambioTabla']
                ])
            </div>
        @break
        @case('fdt')
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'representatividad_politica',

                    'joins'     => [
                        'distritos'         => ['distrito_id', ['nombre']],
                    ],

                    'columnas'  =>
                        [
                            'distritos.nombre'      => 'Municipio',
                            'total_concejales_fdt'      => 'Total de Concejales FDT',
                            'concejalas_fdt'            => 'Concejalas FDT',
                            'porcentaje_concejalas_fdt' => 'Concejalas FDT (%)',
                        ],

                    'escucharMapa'  => true,
                    'preFiltrado' => ['columna' => 'distrito_id', 'evento' => 'cambioTabla']
                ])
            </div>
        @break
        @case('jxc')
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'representatividad_politica',

                    'joins'     => [
                        'distritos'         => ['distrito_id', ['nombre']],
                    ],

                    'columnas'  =>
                        [
                            'distritos.nombre'      => 'Municipio',
                            'total_concejales_jxc'      => 'Total de Concejales JxC',
                            'concejalas_jxc'            => 'Concejalas JxC',
                            'porcentaje_concejalas_jxc' => 'Concejalas JxC (%)',
                        ],

                    'escucharMapa'  => true,
                    'preFiltrado' => ['columna' => 'distrito_id', 'evento' => 'cambioTabla']
                ])
            </div>
        @break
        @case('otros')
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'representatividad_politica',

                    'joins'     => [
                        'distritos'         => ['distrito_id', ['nombre']],
                    ],

                    'columnas'  =>
                        [
                            'distritos.nombre'                     => 'Municipio',
                            'total_concejales_otros_partidos'      => 'Total de Concejales Otros',
                            'concejalas_otros_partidos'            => 'Concejalas Otros',
                            'porcentaje_concejalas_otros_partidos' => 'Concejalas Otros (%)',
                        ],

                    'escucharMapa'  => true,
                    'preFiltrado' => ['columna' => 'distrito_id', 'evento' => 'cambioTabla']
                ])
            </div>
        @break
        @default
        @break
    @endswitch

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipiosSiNoHayFoco()
            // mapa.municipios()

            const estilos = JSON.parse('{!!  json_encode($estilos) !!}');
            mapa.pintarMunicipios(estilos);

            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
            mapa.agregarReferencias(referencias, 'municipios');
        });

        window.addEventListener('pintarEstilos', evento => {
            const estilos = evento.detail;
            mapa.pintarMunicipios(estilos);
        })
    </script>
    @stop
</div>
