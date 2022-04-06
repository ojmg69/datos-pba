<div class="box">
    <div class="box-header">
        <h3 class="box-title">Consejeros Escolares</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
            'tabla'     => 'concejeros',

            'columnas'  =>
                [
                    'distritos.nombre'        => 'Municipio',
                    'consejero'                 => 'Consejero',
                    'bloques_legislativos.nombre'             => 'Bloque',
                ],

            'joins'     =>
                [
                    'distritos'   => ['distrito_id', ['nombre']],
                    'bloques_legislativos'   => ['bloque_legislativo_id', ['nombre']]
                ],
               
             'escucharMapa'  => true,
            'buscador'  => [ 'columna'   => 'distritos.nombre', 'mensaje'   => 'Buscar por municipio' ],
            'selector' =>
                [
                    'porTabla' => [
                        'tabla'    => 'concejeros',
                        'opciones' => 'consejero',
                        'valores'  => 'id',
                    ],
                'filtrarPor' => 'id',
                'textoDefecto' => 'Filtrar por clima',
                'valorInicial' => '1'
                ]

            /*'ordenarPor'    => [
                ['distritos.nombre', 'asc'],
                ['bloque_nombre', 'asc'],
                ['consejero', 'asc']
            ]*/
        ])
    </div>

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
            mapa.agregarReferencias(referencias, 'municipios', 'Regiones Educativas');
        });
    </script>
    @stop
</div>
