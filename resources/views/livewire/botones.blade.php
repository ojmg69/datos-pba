<div>
    @foreach($botones as $boton)
        <button class="btn btn-info btn-sm tabla__input" wire:click="click('{{ $boton[1] }}')">
            {{ $boton[0] }}
        </button>
    @endforeach
</div>
