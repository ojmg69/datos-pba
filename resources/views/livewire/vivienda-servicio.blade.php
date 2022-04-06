<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Viviendas - Servicios</h3>
            <hr>
        </div>

        @if($municipio)
            <div>
                <h4 class="font-weight-bold">Conectividad</h4>
                @livewire('tabla-generica', [
                    'tabla' => 'servicio_conectividad',

                    'columnas' =>
                        [
                            'localidad'         =>  'Localidad',
                            'adsl'              =>  'ADSL',
                            'cablemodem'        =>  'Cable Módem',
                            'dial_up'           =>  'Dial Up',
                            'fibra_optica'      =>  'Fibra Óptica',
                            '4g'                =>  '4G',
                            '3g'                =>  '3G',
                            'telefonia_fija'    =>  'Telefonía Fija',
                            'wireless'          =>  'Wireless',
                            'satelital'         =>  'Satelital',
                        ],

                    'preFiltrado' => [ 'columna' => 'distrito_id', 'evento' => 'idMunicipioActualizado' ],
                ])
            </div>

            <div>
                <h4 class="font-weight-bold">Agua</h4>
                @livewire('tabla-generica', [
                    'tabla' => 'servicio_agua',

                    'columnas' =>
                        [
                            'poblacion_con_agua_potable'    => '% Población con agua potable',
                            'poblacion_sin_agua_potable'    => '% Población sin agua potable',
                            'poblicacion_con_cloacas'       => '% Población con cloacas',
                            'poblacion_sin_cloacas'         => '% Población sin cloacas',
                        ],

                    'preFiltrado' => [ 'columna' => 'distrito_id', 'evento' => 'idMunicipioActualizado' ],
                ])
            </div>

            @if($municipio->region_electrica)
                <div>
                    <h4 class="font-weight-bold">Región Eléctrica</h4>
                    <h7>*Datos correpondientes al total de la región eléctrica</h7>
                    @livewire('tabla-generica', [
                        'tabla' => 'region_electrica',

                        'columnas' =>
                            [
                                'nombre'                        => 'Nombre',
                                'concesionaria'                 => 'Concesionaria',
                                'usuarios'                      => 'Usuarios',
                                'usuarios_por_km'               => 'Usuarios por KM',
                                'usuarios_con_tarifa_social'    => 'Con tarifa social',
                                'consumo_mwh'                   => 'Consumo (MW/h)',
                                'km_de_red'                     => 'Red (Km)',
                            ],

                        'preFiltrado' => [ 'columna' => 'id', 'evento' => 'idRegionElectrica' ],
                    ])
                </div>
            @endif
        @else
            <h4 class="font-weight-bold">Seleccione un municipio</h4>
        @endif

        <div class="box-body">
        {{-- Datos de conectividad --}}

        {{-- Datos de agua --}}

        {{-- Datos de region electrica del municipio seleccionado --}}
        </div>
    </div>
    @section('js')
        <script>
            window.addEventListener('mapaListo', evento => {
                mapa.quitarEstilos()
                mapa.quitarPines();
                mapa.quitarReferencias();

                const estilosMunicipios = JSON.parse('{!!  json_encode($this->estilos) !!}')
                mapa.pintarMunicipios(estilosMunicipios);


                const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
                mapa.agregarReferencias(referencias, 'municipios','Regiones Eléctricas');
            });

            window.addEventListener('clickEnLupita', evento => {
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });

        </script>
    @stop

</div
