<div>
    <div class="tabla__controles">
        @if($departamentos->hasPages())
        <div class="tabla__paginador">
            @if ($departamentos->onFirstPage())
                <button class="btn btn-info btn-sm" wire:click="previousPage" disabled>
                    <i class="fas fa-arrow-left"></i>
                </button>
            @else
                <button class="btn btn-info btn-sm" wire:click="previousPage">
                    <i class="fas fa-arrow-left"></i>
                </button>
            @endif

            <span class="mx-2">Página {{ $departamentos->currentPage() }} de {{ $departamentos->lastPage() }}</span>

            @if (!$departamentos->hasMorePages())
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
        <div class="tabla__buscador">
            <input
                placeholder="Buscar"
                class="tabla__buscador form-control form-control-sm" 
                type="search"
                wire:model="busqueda">
        </div>
    </div>

    <table class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Departamento</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($departamentos as $departamento)
                <tr>
                    <td>{{ $departamento->nombre }}</td>
                    <td>
                        <button
                            type="submit"
                            wire:click="emitir({{ $departamento->id }})"
                            class="btn btn-info">
                            <i class="fas fa-search"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
