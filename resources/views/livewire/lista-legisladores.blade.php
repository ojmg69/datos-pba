<div class="d-flex flex-column justify-content-center" style="background-color: #ffffff; color:#3e444d; height: 550px;">
    @if (!$detalles)
        <div class="tabla__controles">
            @if ($legisladores->hasPages())
                <div class="tabla__paginador">
                    @if ($legisladores->onFirstPage())
                        <button class="btn btn-info btn-sm" wire:click="previousPage" disabled>
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    @else
                        <button class="btn btn-info btn-sm" wire:click="previousPage">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    @endif

                    <span class="mx-2">Página {{ $legisladores->currentPage() }} de
                        {{ $legisladores->lastPage() }}</span>

                    @if (!$legisladores->hasMorePages())
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

            @livewire('selector',
                [
                    'textoDefecto'  =>  'Todos los legisladores',
                    'porValores'    =>  [
                        [ 'Diputado/a', 'DIPUT' ],
                        [ 'Senador/a', 'SENAD' ]
                    ]
                ]
            )

            @if (count($bloques) > 0)
                <div class="lista-concejales__bloques">
                    <select wire:model="bloque" wire:change="resetearPagina()"
                        class="tabla__buscador form-control form-control-sm">
                        <option value="todos" selected>Todos los bloques</option>
                        @foreach ($bloques as $bloque)
                            <option value="{{ $bloque['id'] }}">{{ $bloque['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    @endif

    @if ($detalles)

        <div class="row">
            <div class="col-3 d-flex justify-content-center align-items-center">
                <img style="border-radius: 50%" width="100px" height="100px;"
                    src=" {{ url('/img/img_legisladores/' . $detallesLegislador['imagen']) }}"
                    alt="Foto de {{ $detallesLegislador['nombre'] }}">
            </div>
            <div class="col-9">
                <h5>{{ $detallesLegislador['tipo'] }}<b> {{ $detallesLegislador['nombre'] }}</b></h5>
                <hr class="bg-info">
                <h5><b>Partido: </b> {{ $detallesLegislador['bloque_nombre'] }}</h5>
                <h5><b>Municipio: </b> {{ $distritoLegislador->nombre }}</h5>
                <h5><b>Mandato: </b>{{ $detallesLegislador['mandato_inicio'] }} -
                    {{ $detallesLegislador['mandato_fin'] }}</h5>
                <hr class="bg-info">
                <h5><b>Reseña:</b></h5>
                <p style="text-align:justify"> 
                {!! nl2br ($detallesLegislador['descripcion']) !!}</p>

            </div>
            <hr>
            <button type="button" class="btn btn-info" wire:click='volverListado'>
                Volver al listado
            </button>

        </div>

    @else

        @if (count($legisladores) > 0)
            <div style="height: 100%; width: 100%;" class="lista-tarjetas">
                @foreach ($legisladores as $legislador)

                    <div class="card tarjeta-concejal" style="background-color: #ffffff; color:#3e444d;">
                        <img style="border-radius: 50%" width="50px" height="50px"
                            src=" {{ url('/img/img_legisladores/' . $legislador['imagen']) }}"
                            alt="Foto de {{ $legislador['nombre'] }}">

                        <div class="card-body d-flex flex-column align-items-center" style="text-align:center">
                            <p class="card-title font-weight-bold">{{ $legislador['nombre'] }}</p>

                            <span class="card-text">{{ $legislador['tipo'] }}</span>

                            @if ($legislador['bloque_nombre'] != null)
                                <span class="tarjeta-concejal--texto-largo"
                                    style="color: {{ $legislador['bloque_color'] }}">
                                    <b>{{ $legislador['bloque_nombre'] }}</b>
                                </span>
                            @endif

                            <span>{{ $legislador['mandato_inicio'] }} - {{ $legislador['mandato_fin'] }}</span>
                            <hr>
                            <button type="button" class="btn btn-info" wire:click="verDetalles({{ $legislador }})">
                                Ver detalles
                            </button>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="height: 100%; width: 100%;" class="lista-tarjetas lista-tarjetas--vacia">
                <div class="lista-tarjetas--mensaje">
                    <h2>No se han encontrado legisladores en el sistema</h2>
                </div>
            </div>
        @endif
    @endif
</div>
