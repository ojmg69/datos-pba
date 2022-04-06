<div class="box">
    @switch($vista)
        @case('detalle')
            <div class="box-header">
                <h3 class="box-title font-weight-bold">{{ $puerto->nombre }}</h3>
                <span>{{ $puerto->tipo }}</span>

                @if ($puerto->web)
                    <br>
                    <a href={{ $puerto->web }}>{{ $urlLinda }}</a>
                @endif
                <hr>
            </div>

            <div class="box-body">
                <span class="font-weight-bold">Carga:</span>
                <p>{{ $puerto->carga }}</p>

                @if ($puerto->principales_destinos)
                    <span class="font-weight-bold">Principales Destinos:</span>
                    <p>{{ $puerto->principales_destinos }}</p>
                @endif

                @if ($puerto->observaciones)
                    <span class="font-weight-bold">Observaciones:</span>
                    <p>{{ $puerto->observaciones }}</p>
                @endif
            <div>

            <button class="btn btn-info my-4" wire:click="verTabla">Volver al listado completo</button>
        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Puertos</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'puertos',

                    'columnas'  =>
                        [
                            'nombre'            => 'Nombre',
                            'nombre_autoridad'  => 'Autoridad',
                            'tipo'               => 'Tipo',
                        ],

                    'evento'    =>
                        [
                            'nombre' => 'clickEnPuerto',
                            'columna' => 'id'
                        ],
                    
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

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
        });

        window.addEventListener('agregarPines', evento => {
            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);
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
    </script>
    @stop
</div>
