<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Municipios - Consulados</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Autoridad:</b> {{ $datosConsulado->cargo }}</h4>
                    <hr>
                    <h4><b>Cargo:</b> {{ $datosConsulado->cargo }}</h4>
                    <hr>
                    <h4><b>Contacto:</b></h4>
                    <p>{{ $datosConsulado->contacto }}</p>
                    <h4><b>Direccion:</b></h4>
                    <p>{{ $datosConsulado->direccion }}</p>
                </div>
                <div class="col-5 justifiy-content-center">
                </div>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
                {{-- <a href="{{ route('politico.index', ['tipo' => 'ejecutivo']) }}"
                    class="btn btn-info" wire:click="">Volver
                    al listado completo</a> --}}
            </div>
            @break
            @case("general")
            <div class="box-body">
                @livewire('tabla-generica', [
                    'tabla'     => 'consulados',

                    'joins' =>
                        [
                            'distritos' => ['distrito_id', ['nombre']],
                            'paises'    => ['pais_id', ['nombre', 'img_bandera']]
                        ],

                    'columnas'  =>
                        [
                            'distritos.nombre'      => 'Municipio',
                            'paises.img_bandera'                =>
                                    [ 'encabezado'  => 'Bandera', 'tipo' => 'img', 'prefijoUrl' => 'img/banderas/' ],
                            'paises.nombre'         => 'País',
                            'cargo'                 => 'Cargo',
                            'nombre'                => 'Autoridad',
                            'contacto'              => 'Contacto'
                        ],

                    'escucharMapa'  => true,

                    'selector'  =>
                    [
                        'porTabla' => [
                            'tabla'         => 'paises',
                            'opciones'     => 'nombre',
                            'valores'      =>  'id',
                        ],
                        'filtrarPor'          => 'pais.id',
                        'textoDefecto'        => 'Todos los paises'
            ],
                    
                    'buscador'  => [ 'columna' => 'distritos.nombre', 'mensaje' => 'Buscar por municipio'],
                ])
            </div>
            @break
        @endswitch




    </div>

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()

            const idsMunicipiosResaltados = JSON.parse('{!! json_encode($idsMunicipiosResaltados) !!}')
            const relleno   = '{!! Config::get("constantes-mapa.estilos.resaltado.relleno") !!}'
            const borde     = '{!! Config::get("constantes-mapa.estilos.resaltado.borde") !!}'
            const estilos = idsMunicipiosResaltados.map(id => ({ id, relleno, borde }))

            mapa.pintarMunicipios(estilos)
            mapa.agregarReferencias([{ nombre: 'Municipios con consulados', relleno, borde }], 'municipios')
        });
        
        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });
    </script>
    @stop

</div>
