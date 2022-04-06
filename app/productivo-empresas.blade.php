<div class="box">
        @switch($vista)
        @case('detalle')
            <div class="box-header">
                <h3 class="box-title font-weight-bold">{{ $empresa->nombre }}</h3>
                <span>{{ $empresa->tipo_de_produccion }}</span>

                @if ($empresa->web)
                    <br>
                    <a href={{ $empresa->web }}>{{ $urlLinda }}</a>
                @endif
                <hr>
            </div>

            <div class="box-body">
                <span class="font-weight-bold">Exportadora:</span>
                <p>{{ $empresa->exportadora ? 'Si':'No' }}</p>

                @if ($empresa->exportadora && $empresa->volumen_exportacion)
                    <span class="font-weight-bold">Volumen de exportacion:</span>
                    <p>{{ $empresa->volumen_exportacion }}</p>

                    <span class="font-weight-bold">Destinos:</span>
                    <p>{{ $empresa->destinos }}</p>
                @endif

                <span class="font-weight-bold">Domicilio:</span>
                <p>{{ $empresa->domicilio }}</p>

                <span class="font-weight-bold">Telefono:</span>
                <p>{{ $empresa->telefono }}</p>
            <div>

            <button class="btn btn-info my-4" wire:click="verTabla">Volver al listado completo</button>
        @break
        @default
            <div class="box-header">
                <h3 class="box-title">Empresas</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'empresas',

                    'columnas'  =>
                        [
                            'nombre'                    => 'Nombre',
                            'localidad'                 => 'Localidad',
                            'año_de_origen'             => 'Nacionalidad',
                            'radicada_en_el_pais_desde' => 'Radicada desde'
                        ],

                    'evento'    =>
                        [
                            'nombre' => 'clickEnEmpresa',
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