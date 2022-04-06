<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableroContadores extends Component
{
    public $nombre;
    public $contadores;

    public function mount(
        $nombre,
        $contadores
    )
    {
        $this->nombre = $nombre;
        $this->contadores = $contadores;
    }

    public function render()
    {
        return view('livewire.tablero-contadores');
    }
}
