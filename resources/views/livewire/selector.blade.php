<div class="tabla__input">
    <select wire:change='valorActualizado($event.target.value)' class="form-control form-control-sm">
        <option value="todos.." selected>{{ $todos }}</option>
        @for ($i = 0; $i < count($opciones); $i++)
            @if ($valores[$i] == $valorInicial)
                <option value="{{ $valores[$i] }}" selected>{{ $opciones[$i] }}</option>
            @else
                <option value="{{ $valores[$i] }}">{{ $opciones[$i] }}</option>
            @endif
        @endfor
    </select>
</div>