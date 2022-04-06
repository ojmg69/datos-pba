<?php

namespace App\Http\Livewire;

use App\Sede;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\WithPagination;

class TablaSedes extends Component
{

    use WithPagination;

    public $busqueda = '';

    public $departamentoId = null;

    private $sedes;

    protected $listeners = [
        'mostrarSedesDeDepto'
    ];

    public function render()
    {
        $this->sedes = Sede::join('departamentos', 'sedes.dpto_judicial_id', '=', 'departamentos.id')
            ->select('sedes.*', 'departamentos.nombre as dpto_nombre')
            ->whereNotNull('sedes.nombre')
            ->where('sedes.dpto_judicial_id', '=', $this->departamentoId)
            ->where('sedes.nombre', 'LIKE', '%' . $this->busqueda  . '%')
            ->paginate(Config::get('tablas.paginado.items_por_pagina'));

        return view('livewire.tabla-sedes', ['sedes' => $this->sedes]);
    }

    public function mostrarSedesDeDepto($id) {
        $this->departamentoId = $id;
    }

    public function verSede($id) {
        $this->emit('verSede', $id);
    }
}
