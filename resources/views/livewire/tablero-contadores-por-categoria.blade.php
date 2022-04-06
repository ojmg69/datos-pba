<div class="tablero-seccion--container ">
    <span>{{$nombre}}</span>
    <div class="tablero-contadores--contadores">
        @for ($i = 0; $i < count($categorias); $i++)
            <div class="contador-grande--container">
                @if($categorias[$i] === 'concurrencia')
                <span class="contador-grande--valor">{{ number_format($valores[$i], 2, '.', ',') }}%</span>
                @elseif ($valorPorcentaje)
                <span class="contador-grande--valor">{{ number_format($valores[$i], 2, ',', '.') }}</span>
                @else
                <span class="contador-grande--valor">{{ number_format($valores[$i], 0, ',', '.') }}</span>
                @endif
                <span class="contador-grande--nombre">{{$categorias[$i]}}</span>
            </div>
        @endfor
    </div>
</div>
