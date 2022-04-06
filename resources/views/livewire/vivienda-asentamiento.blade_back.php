<div class="box">
    @switch($vista)
        @case('detalle')
            <div class="box-header">
                <h3 class="box-title">{{ $asentamiento->nombre }}</h3>
                <span>{{ $asentamiento->tipo_asentamientos->nombre }}</span>
            </div>
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <p><b>Municipio:</b> {{ $asentamiento->distrito->nombre }}</p>
                    <p><b>Encargado:</b> {{ $asentamiento->encargado }}</p>
                    <p><b>Año de origen:</b> {{ $asentamiento->origen }}</p>
                    <p><b>Nro de familias:</b> {{ $asentamiento->cant_familias }}</p>
                    <p><b>Superficie:</b> {{ $asentamiento->superficie }} m2</p>
                    <p><b>Energía eléctrica:</b> {{ $asentamiento->energia_electrica }}</p>
                    <p><b>Alumbrado:</b> {{ $asentamiento->alumbrado }}</p>
                    <p><b>Agua corriente:</b> {{ $asentamiento->agua_corriente }}</p>
                    <p><b>Red de cloacas:</b> {{ $asentamiento->red_de_cloacas }}</p>
                    <p><b>Red de gas:</b> {{ $asentamiento->red_de_gas }}</p>
                    <p><b>Pavimento:</b> {{ $asentamiento->pavimento }}</p>
                </div>
                <div class="col-5 justifiy-content-center">

                </div>
                <button class="btn btn-info" wire:click="verTabla">Volver al listado completo</button>
            </div>
            @break
        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Asentamientos</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'asentamientos',

                    'columnas'  =>
                        [
                            'nombre'                    => 'Nombre',
                            'municipio'                 => 'Municipio',
                            'tipo_asentamientos.nombre' => 'Tipo',
                            'origen'                    => 'Orígen',
                            
  
                        ],
                        
                    'joins'     =>
                        [
                            'distritos'         => ['distrito_id', ['nombre']],
                        ],


                    'evento'    =>
                        [
                            'nombre' => 'clickEnAsentamiento',
                            'columna' => 'id'
                        ],

                    'escucharMapa'  => true,

                    'buscador'  =>
                        [
                            'columna'   => 'nombre',
                            'mensaje'   => 'Buscar por nombre'
                        ],

                    'joins'     =>
                        [
                            'tipo_asentamientos'    => ['tipo_asentamientos_id', ['nombre']],
                        ],

                    'selector'  =>
                        [
                            'porTabla' => [
                                'tabla'    => 'tipo_asentamientos',
                                'opciones' => 'nombre',
                                'valores'  =>  'id',
                            ],
                            'filtrarPor'    => 'tipo_asentamientos_id',
                            'textoDefecto'  => 'Todas los tipos'
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
    </script>
    @stop
</div>
