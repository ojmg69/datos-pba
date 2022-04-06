<div class="box">
    <div class="box-header">
        <h3 class="box-title">Regiones Sanitarias</h3>
    </div>
    <div class="box-body">
        @livewire('tabla-generica', [
            'tabla'     => 'regiones_sanitarias',

            'columnas'  =>
                [
                    'nombre'        =>  'Región',
                    'autoridad' =>  'Autoridad',
                    'cargo'     =>  'Cargo',
                    'direccion' =>  'Dirección',
                    'contacto'  =>  'Contacto',
                ],

            'buscador'  => [
                'columna'   => 'autoridad',
                'mensaje'   => 'Buscar por autoridad'
            ],

            'labelOpciones' => 'Ver en Mapa',

            'evento'    => [ 'nombre' => 'clickEnRegion', 'columna' => 'id' ],

            'preFiltrado'   => ['columna' => 'id', 'evento' => 'regionActualizada'],
        ])
    </div>

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipiosSiNoHayFoco()

            const estilosMunicipios = JSON.parse('{!!  json_encode($this->estilosMunicipios) !!}')
            mapa.pintarMunicipios(estilosMunicipios);


            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
                mapa.agregarReferencias(referencias, 'municipios', 'Regiones Sanitarias');
        });

        window.addEventListener('mostrarRegion', evento => {
            mapa.enfocarMunicipios(evento.detail)
        })
    </script>
    @stop
</div>
