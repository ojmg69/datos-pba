<div class="box">
    @switch($vista)
        @case('detalle')

        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Políticas Locales</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'distrito_plan_politico',

                'joins' =>
                [
                'distritos' => ['distrito_id', ['nombre']],
                'planes_politicos' => ['planes_politicos_id', ['nombre']],
                ],

                'columnas' =>
                [
                'distritos.nombre' => 'Municipio',
                'planes_politicos.nombre' => 'Plan',
                'observaciones' => 'Observaciones'

                ],

                'escucharMapa' => true,

                'buscador' =>
                [
                'columna' => 'distritos.nombre',
                'mensaje' => 'Buscar por nombre'
                ],

                'selector' =>
                [
                    'porTabla' => [
                        'tabla' => 'planes_politicos',
                        'opciones' => 'nombre',
                        'valores' => 'id',
                    ],
                
                    'filtrarPor' => 'planes_politicos_id',
                    'textoDefecto' => 'Filtrar por plan',

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
                //mapa.municipios()

                const estilosMunicipios = JSON.parse('{!! json_encode($this->estilosMunicipios) !!}')
                mapa.pintarMunicipios(estilosMunicipios);

                const referencias = JSON.parse('{!! json_encode($referencias) !!}');
                console.log(referencias.data)
                mapa.agregarReferencias(referencias, 'municipios');

            });

            window.addEventListener('estilosActualizados', evento => {
                const estilos = evento.detail

                mapa.pintarMunicipios(estilos);
            })

        </script>

    @stop
</div>
