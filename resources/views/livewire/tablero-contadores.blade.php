<div class="tablero-seccion--container ">
    <span>{{$nombre}}</span>
    <div class="tablero-contadores--contadores">
        @foreach ($contadores as $parametros)
            @livewire('contador-grande', $parametros)
        @endforeach
    </div>
</div>
