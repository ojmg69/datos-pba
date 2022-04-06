<div   
    class="d-flex flex-column justify-content-center"
    style="background-color: #ffffff; color:#3E444D; height: 550px;">

    <div class="tabla__controles">
        @if($concejales->hasPages())
        <div class="tabla__paginador">
            @if ($concejales->onFirstPage())
                <button class="btn btn-info btn-sm" wire:click="previousPage" disabled>
                    <i class="fas fa-arrow-left"></i>
                </button>
            @else
                <button class="btn btn-info btn-sm" wire:click="previousPage">
                    <i class="fas fa-arrow-left"></i>
                </button>
            @endif

            <span class="mx-2">Página {{ $concejales->currentPage() }} de {{ $concejales->lastPage() }}</span>

            @if (!$concejales->hasMorePages())
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

        @if(count($bloques) > 0)
            <div class="tabla__input">
                <select wire:model="bloque" wire:change="resetearPagina()" class="tabla__buscador form-control form-control-sm">
                    <option value="todos" selected>Todos los bloques</option>
                    @foreach ($bloques as $bloque)
                        <option value="{{ $bloque['id'] }}">{{ $bloque['nombre'] }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="tabla__input tabla__input--derecho">
            @livewire('selector',
                [
                    'porValores' => [
                        ['Presidencias HCD', '1'],
                        ['Presidencias HCD y Bloque', '2'],
                        ['Presidencias Bloques', '3'],
                        ['Concejales y Concejalas', '4']
                    ],
                    'textoDefecto'  => 'Todas las autoridades'
                ]
            )
        </div>
    </div>

    @if(count($concejales) > 0)
        <div
            style="height: 100%; width: 100%;" 
            class="lista-tarjetas">

        @foreach ($concejales as $concejal)
            <div class="card tarjeta-concejal" style="background-color: #ffffff; color:#3E444D">
                <img src=" {{ asset('/img/users_img.png') }}" class="card-img-top" style="width: 50px" alt="Foto de {{ $concejal['concejal'] }}">

                <div class="card-body d-flex flex-column align-items-center" style="text-align:center">
                    <p class="card-title font-weight-bold">{{ $concejal['concejal'] }}</p>

                    <span class="card-text">{{ $concejal['distrito_nombre'] }}</span>

                    @if ($concejal['bloque_nombre'] != null)
                        <span
                            class="tarjeta-concejal--texto-largo"
                            style="color: {{ $concejal['bloque_color'] }}">
                            <b>{{ $concejal['bloque_nombre'] }}</b>
                        </span>
                    @endif

                    <span>{{ $concejal['mandato_inicio'] }} - {{ $concejal['mandato_fin'] }}</span>
                    <br> <span>
                        
                        <b> <font size=2>{{ $concejal['tipo_autoridad'] }}</font></b>
                        </span>
                    <span>
                        
                         <font size=1> {{$concejal ['localidad']}}</font>
                        </span>
                </div>
            </div>
        @endforeach
        </div>
    @else
        <div
            style="height: 100%; width: 100%;" 
            class="lista-tarjetas lista-tarjetas--vacia">
            <div class="lista-tarjetas--mensaje">
                <h2>Sin concejales</h2>
            </div>
        </div>
    @endif
</div>