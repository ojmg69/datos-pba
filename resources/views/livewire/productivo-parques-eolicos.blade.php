<div class="box">
    @switch($vista)
    @case('detalle')
    <div class="box-header">
        <h3 class="box-title font-weight-bold">{{ $parque_eolico->nombre }}</h3>
        <span>{{ $parque_eolico->desarrollador }}</span>
        <hr>
    </div>

    <div class="box-body">
        @if ($parque_eolico->observaciones)
        <span class="font-weight-bold">Observaciones:</span>
        <p>{{ $parque_eolico->observaciones }}</p>
        @endif

        @if ($parque_eolico->observaciones)
        <span class="font-weight-bold">Domicilio:</span>
        <p>{{ $parque_eolico->domicilio }}</p>
        @endif

        <div>

            <button class="btn btn-info my-4" wire:click="verTabla">Volver al listado completo</button>
            @break
            @default
            <div class="box-header">
                <h3 class="box-title">Parques Eólicos</h3>
            </div>
            <div class="box-body">
                @livewire('tabla-generica', [
                'tabla' => 'parques_eolicos',

                'joins' =>
                [
                'distritos' => ['distrito_id', ['nombre']]
                ],

                'columnas' =>
                [
                'nombre' => 'Nombre',
                'distritos.nombre' => 'Municipio',
                'desarrollador' => 'Desarrollador',
                ],

                'evento' =>
                [
                'nombre' => 'clickEnParque',
                'columna' => 'id'
                ],

                'escucharMapa' => true
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

                window.addEventListener('clickEnLupita', evento => {
                    const id = evento.detail;
                    mapa.mostrarMunicipio(id)
                });
            </script>
            @stop
        </div>
