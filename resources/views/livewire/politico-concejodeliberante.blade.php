<div class="box">
    <div class="box-header" style="display: flex; justify-content: space-between;">
        <h3 class="box-title">Concejo Deliberante</h3>
        @if ($vista == 'concejales')
            <button class="btn btn-info" wire:click="verTablero">Volver a vista principal</button>
        @endif
    </div>
    <div class="box-body">
        @switch($vista)
            @case('tablero')
                <hr>
                @livewire('tablero-contadores-por-categoria', [
                    'nombre'        => 'Concejales y Concejalas en bloques mayoritarios',
                    'idGrafico'     => 'contadoresPorBloque',
                    'categorias'    => $conteoPorBloques['categorias'],
                    'valores'       => $conteoPorBloques['valores'],
                    'ordenar'       => ['categorias', 'asc']
                ])

                @livewire('tablero-contadores-por-categoria', [
                    'nombre'        => 'Clasificación por Género',
                    'idGrafico'     => 'contadoresPorGenero',
                    'categorias'    => $conteoPorGenero['categorias'],
                    'valores'       => $conteoPorGenero['valores'],
                ])

                @livewire('tablero-grafico-dona', [
                    'nombre'    =>  'Gráfico por bloques mayoritarios',
                    'idGrafico' =>  'graficoBloques',
                    'categorias'=>  $conteoPorBloques['categorias'],
                    'colores'   =>  $conteoPorBloques['colores'],
                    'valores'   =>  $conteoPorBloques['valores'],
                ])

                <div style="display: flex; justify-content: flex-end">
                    <button class="btn btn-info" wire:click="verDetalles">Ver detalles</button>
                </div>
            @break
            @case('concejales')
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

                        <div class="col-md-6">
                            <label>Ocupación de Bancas:</label>
                            @if(!is_null($distrito))
                                <img
                                    width="70%"
                                    src="{{ url('/img/img_hcd_v2/' . $distrito . 'hcd202.png') }}"
                                    alt="Image" />
                            @else
                                <img
                                    width="70%"
                                    src="{{ url('/img/img_hcd_v2/EDILES10.png') }}"
                                    alt="Image" />
                            @endif
                        </div>

                    </div>
                    <hr>
                @endif
                @livewire('lista-concejales', ['distrito' => $distrito, 'seccion' => $seccion])
            @break
        @endswitch
    </div>

    @push('js')
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
    @endpush
</div>
