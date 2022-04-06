<div class="col-12">
    <div class="box">
        <div class="box-header">
            @switch($vista)
            @case("autoridades")
            <h3 class="box-title">Autoridades</h3>
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver</button>
            @break
            @case("sedes")
            <h3 class="box-title">Sedes</h3>
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver</button>
            @break
            @endswitch
            <hr>
        </div>

        @switch($vista)
        @case("tablero")

        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Organismos con mayor número de sedes',
        'idGrafico' => 'organismosConMasSedes',
        'categorias' => $conteoPorOrganismoMasSede['categorias'],
        'valores' => $conteoPorOrganismoMasSede['valores'],
        'ordenar' => ['valores', 'asc']
        ])

        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Organismos por administración',
        'idGrafico' => 'organismosPorTipo',
        'categorias' => $conteoOrganismoNacionalProvincial['categorias'],
        'valores' => $conteoOrganismoNacionalProvincial['valores'],
        'ordenar' => ['valores', 'asc']
        ])

        @livewire('tablero-grafico-dona', [
        'nombre' => 'Gráfica por Organismos',
        'idGrafico' => 'graficoOrganismo',
        'categorias'=> $conteoPorOrganismoMasSedeGrafico['categorias'],
        'colores' => $conteoPorOrganismoMasSedeGrafico['colores'],
        'valores' => $conteoPorOrganismoMasSedeGrafico['valores']
        ])

        <div style="display: flex; justify-content: flex-end">
            <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
        </div>
        @break
        @case("detalle")
        <hr>
        <div class="box-body row">
            <h3>Módulo deshabilitado</h3>
            <hr>
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                al listado completo</button>
        </div>
        @break
        @case("autoridades")
        <div class="box-body">
            @livewire('tabla-generica', [
            'tabla' => 'organismo_autoridades',

            'joins' =>
            [
            'organismos' => ['organismo_id', ['nombre']]
            ],

            'columnas' =>
            [
            'organismos.nombre' => 'Organismo',
            'nombre' => 'Autoridad',
            'cargo' => 'Cargo',
            'contacto' => 'Contacto'
            ],

            'escucharMapa' => false,
            'selector' =>
            [
            'nombre' => 'organismosAutoridades',

            'porTabla' => [
            'tabla' => 'organismos',
            'opciones' => 'nombre',
            'valores' => 'id',
            ],

            'filtrarPor' => 'organismo.id',
            'textoDefecto' => 'Todos los organismos',

            'valorInicial' => $valorSelector
            ],

            'boton' => [ 'nombre' => 'Ver sedes', 'evento' => 'verSedes', 'resetPage' => true ],

            'buscador' => [ 'columna' => 'nombre', 'mensaje' => 'Buscar por autoridad'],
            ])
        </div>
        @break
        @case("sedes")
        <div class="box-body">
            @livewire('tabla-generica', [
            'tabla' => 'organismos_provinciales_nacionales',

            'joins' =>
            [
            'organismos' => ['organismo_id', ['nombre']],
            'distritos' => ['distrito_id', ['nombre']]
            ],

            'columnas' =>
            [
            'distritos.nombre' => 'Municipio',
            'organismos.nombre' => 'Organismo',
            'sedes' => 'Sedes',
            'contacto' => 'Contacto'
            ],

            'selector' =>
            [
            'nombre' => 'organismosSedes',

            'porTabla' => [
            'tabla' => 'organismos',
            'opciones' => 'nombre',
            'valores' => 'id',
            ],

            'filtrarPor' => 'organismo.id',
            'textoDefecto' => 'Todos los organismos',

            'valorInicial' => $valorSelector
            ],

            'preFiltrado' => [
            'columna'
            => 'distrito_id',

            'valor'
            => $idDistritoSeleccionado,

            'desactivarAlEnfocar'
            => true
            ],

            'escucharMapa' => true,

            'boton' => [ 'nombre' => 'Ver autoridades', 'evento' => 'verAutoridades', 'resetPage' => true ],

            'buscador' => [ 'columna' => 'distritos.municipio', 'mensaje' => 'Buscar por municipio'],
            ])
        </div>
        @break

        @endswitch

    </div>

    @push('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()

            const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
            mapa.agregarPines(pines);

            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
            mapa.agregarReferencias(referencias, 'municipios');
            mapa.agregarReferencias(referencias, 'secciones');
        });

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });
    </script>
    @endpush

</div>
