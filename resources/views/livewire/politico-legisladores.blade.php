<div class="box">
    <div class="box-header" style="display: flex; justify-content: space-between;">
        <h3 class="box-title">Legisladores</h3>
        @if ($vista == 'legisladores')
            <button class="btn btn-info mb-3" wire:click="verTablero">Volver a vista principal</button>
        @endif
    </div>
    <div class="box-body">
        @switch($vista)
        @case('tablero')
        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Diputados',
        'idGrafico' => 'conteoPorBloquesDiputados',
        'categorias' => $conteoPorBloquesDiputados['categorias'],
        'valores' => $conteoPorBloquesDiputados['valores'],
        'ordenar' => ['categorias', 'asc']
        ])
        @livewire('tablero-contadores-por-categoria', [
        'nombre' => 'Senadores',
        'idGrafico' => 'conteoPorBloquesSenadores',
        'categorias' => $conteoPorBloquesSenadores['categorias'],
        'valores' => $conteoPorBloquesSenadores['valores'],
        'ordenar' => ['categorias', 'asc']
        ])
        @livewire('tablero-grafico-dona', [
            'nombre'    =>  'Gráfico por partido politico',
            'idGrafico' =>  'graficoBloquesLegisladores',
            'categorias'=>  $conteoPorBloquesLegisladores['categorias'],
            'colores'   =>  $conteoPorBloquesLegisladores['colores'],
            'valores'   =>  $conteoPorBloquesLegisladores['valores'],
        ])

        <div style="display: flex; justify-content: flex-end">
            <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
        </div>
        @break
        @case('legisladores')
        @if (count($bloquesEnTop) > 0)
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h5 class="font-weight-bold">Bloques:</h5>
                <div>
                    @foreach ($bloquesEnTop as $bloque)
                    <h5 style="color: {{ $bloque->color }}">{{ $bloque->nombre }}
                        ({{ $bloque->concejales }})</h5>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        @endif

        @livewire('lista-legisladores', ['distrito' => $distrito, 'seccion' => $seccion])
        @break
        @endswitch

    </div>

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarPines();
            mapa.quitarReferencias();
        });

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
            mapa.mostrarMunicipio(id)
        });

    </script>
    @stop
</div>
