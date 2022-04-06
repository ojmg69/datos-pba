<?php

namespace App\Http\Livewire;

use App\Departamento;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\WithPagination;

class TablaDepartamentos extends Component
{
    use WithPagination;

    public $busqueda = '';

    private $departamentos;

    public function render()
    {
        $this->departamentos = Departamento::where('nombre', 'LIKE', "%" . $this->busqueda  . "%")
                ->paginate(Config::get('tablas.paginado.items_por_pagina'));

        return view(
            'livewire.tabla-departamentos',
            [ 'departamentos' => $this->departamentos ]
        );
    }

    public function emitir($departamentoId) {
        $this->emit('clickEnDepartamento', $departamentoId);
    }
}
