<div>
    @if($activado)
        <button class="btn btn-info btn-sm tabla__input" wire:click="clickBoton">
            {{ $texto }}
        </button>
    @endif
</div>