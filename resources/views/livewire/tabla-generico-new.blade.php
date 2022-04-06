<div>
    <div class="tabla__controles">
        @if($filas->hasPages())
        <div class="tabla__paginador">
            @if ($filas->onFirstPage())
                <button class="btn btn-info btn-sm" wire:click="previousPage" disabled>
                    <i class="fas fa-arrow-left"></i>
                </button>
            @else
                <button class="btn btn-info btn-sm" wire:click="previousPage">
                    <i class="fas fa-arrow-left"></i>
                </button>
            @endif

            {{-- <span class="mx-2">Página {{ $filas->currentPage() }} de {{ $filas->lastPage() }}</span> --}}
            <span class="mx-2">Página {{ $filas->currentPage() }}</span>

            @if (!$filas->hasMorePages())
                <button class="btn btn-info btn-sm" wire:click="nextPage" disabled>
                    <i class="fas fa-arrow-right"></i>
                </button>
            @else
                <button class="btn btn-info btn-sm" wire:click="nextPage">
                    <i class="fas fa-arrow-right"></i>
                </button>
            @endif
        </div>
        @endif

        @if($boton)
            <button class="btn btn-info btn-sm tabla__input" wire:click="clickBoton">
                {{ $textoBoton }}
            </button>
        @endif

        @if($conSelector)
            @livewire('selector', [ 'args' => $selectorArgs ])
        @endif

        @if($conBusqueda)
            <div class="tabla__input tabla__input--derecho">
                <input
                    placeholder="{{ $mensajeBusqueda }}"
                    class="form-control form-control-sm"
                    type="search"
                    wire:model.debounce.250ms="valorBusqueda">
            </div>
        @endif
    </div>

    <table class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                @foreach ($encabezados as $encabezado)
                    <th>{{ $encabezado }}</th>
                @endforeach

                @if($conEvento)
                    @if ($labelOpciones)
                        <th>{{ $labelOpciones }}</th>
                    @else
                        <th>Más Información</th>
                    @endif
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($filas as $fila)
                <tr>
                    @for ($i = 0; $i < count($encabezados) ; $i++)
                        @if($metadatos[$i] != null)
                            @switch($metadatos[$i]['tipo'])
                                @case('img')
                                    <td>
                                        <img
                                            style="border-radius: 50%" width="50px" height="50px"
                                            src="{{ url( $metadatos[$i]['prefijoUrl'] . $fila->{ $columnas[$i] }) }}"
                                        />
                                    </td>
                                @break
                                @case('coloreada')
                                    <td style="color: {{ $fila->{ $metadatos[$i]['columnaColor'] } }}">
                                        <b> {{ $fila->{ $columnas[$i] } }} </b>
                                    </td>
                                @break
                            @endswitch
                        @else
                            <td> {{ $fila->{ $columnas[$i] } }}</td>
                        @endif
                    @endfor

                    @if($conEvento)
                        <td>
                            <button
                                type="submit"
                                wire:click="emitir({{ $fila->{ $columnaEvento } }})"
                                class="btn btn-info"
                            >
                                <i class="fas fa-search"></i>
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
