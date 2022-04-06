<div class="box">
    <div class="box-header">
        <h3 class="box-title">Comisarías de la Mujer</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
        'tabla' => 'comisarias_mujer',

        'columnas' =>
        [
        'distritos.nombre' => 'Municipio',
        'localidad' => 'Localidad',
        'direccion' => 'Dirección',
        'telefono' => 'Teléfono',
        ],

        'joins' =>
        [
        'distritos' => ['distrito_id', ['nombre']],
        ],

        'buscador' => [ 'columna' => 'localidad', 'mensaje' => 'Buscar por localidad' ],

        'labelOpciones' => "Ver en Mapa",

        'escucharMapa' => true,

        'evento' => ['nombre' => 'clickEnComisaria', 'columna' => 'id'],
        ])
    </div>

    <div>
        <button type="button" wire:click='obtenerVistaPrincipal' class="btn btn-info">Volver al listado</button>
    </div>

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

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });

        window.addEventListener('mostrarSeccion', evento => {
            const id = evento.detail;
            mapa.enfocarMunicipiosDeSeccion(id);
        });

        window.addEventListener('mostrarTodosLosMunicipios', function () {
            mapa.municipios();
        });
    </script>
    @stop
</div>
