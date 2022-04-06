<div class="box">
    @switch($vista)
        @case('detalle')
            {{-- <div class="box-header">
                <h3 class="box-title">{{ $asentamiento->nombre }}</h3>
                <span>{{ $asentamiento->tipo_asentamientos->nombre }}</span>
            </div>
            <hr>
            <div class="box-body row">
                <div class="col-7">

                </div>
                <div class="col-5 justifiy-content-center">

                </div>
                <button class="btn btn-info" wire:click="verTabla">Volver al listado completo</button>
            </div>
            @break --}}
        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Geografía - Climas</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'clima_distrito',

                'joins' =>
                [
                'distritos' => ['distrito_id', ['nombre']],
                'climas' => ['clima_id', ['nombre']],
                ],

                'columnas' =>
                [
                'distritos.nombre' => 'Municipio',
                'climas.nombre' => 'Clima'

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
                        'tabla'    => 'climas',
                        'opciones' => 'nombre',
                        'valores'  => 'id',
                    ],
                'filtrarPor' => 'clima_id',
                'textoDefecto' => 'Filtrar por clima',
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
                // mapa.municipios()
                mapa.municipiosSiNoHayFoco()

                const estilosMunicipios = JSON.parse('{!! json_encode($this->estilosMunicipios) !!}')
                mapa.pintarMunicipios(estilosMunicipios);

                const referencias = JSON.parse('{!! json_encode($referencias) !!}');
                console.log(referencias.data)
                mapa.agregarReferencias(referencias, 'municipios', 'Clasificación por tipos');

            });

            window.addEventListener('estilosActualizados', evento => {
                const estilos = evento.detail

                mapa.pintarMunicipios(estilos);
            })

        </script>

    @stop
</div>
