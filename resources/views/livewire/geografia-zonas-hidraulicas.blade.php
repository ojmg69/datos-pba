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
                <h3 class="box-title">Geografía - Zonas Hidráulicas</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'distrito_zona_hidrica',

                'joins' =>
                [
                'distritos' => ['distrito_id', ['nombre']],
                'zona_hidricas' => ['zona_hidrica_id', ['nombre']],
                ],

                'columnas' =>
                [
                'distritos.nombre' => 'Municipio',
                'zona_hidricas.nombre' => 'Zona hidráulica'

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
                        'tabla' => 'zona_hidricas',
                        'opciones' => 'nombre',
                        'valores' => 'id',
                    ],
                    'filtrarPor' => 'zona_hidrica_id',
                    'textoDefecto' => 'Filtrar por zona',

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
                mapa.agregarReferencias(referencias, 'municipios' , 'Zonas Hidráulicas');

            });

            window.addEventListener('estilosActualizados', evento => {
                const estilos = evento.detail

                mapa.pintarMunicipios(estilos);
            })

        </script>

    @stop
</div>
