<div>
@if(!is_null($entidad))
    <div class="box-header">
        <h3 class="box-title font-weight-bold">{{ $entidad[$titulo] }}</h3>
        @if($subtitulo)
            <span>{{ $entidad[$subtitulo] }}</span>
        @endif
        <hr>
    </div>

    <div class="box-body">
        @foreach ($cuerpo as $item)
            <span class="font-weight-bold">
                {{ preg_replace('/_/', ' ', ucwords($item)) }}
            </span>
            <p>{{ $entidad[$item] }}</p>
        @endforeach
    <div>

    <button class="btn btn-info my-4" wire:click="clickVolver">Volver al listado completo</button>
    @if(!is_null($boton))
        <button class="btn btn-info my-4" wire:click="clickBoton">{{$boton['nombre']}}</button>
    @endif
@endif
</div>