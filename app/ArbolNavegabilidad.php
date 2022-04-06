<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ArbolNavegabilidad extends Component
{

    public $ruta = [];

    protected $listeners= [
        'arbol-navegabilidad.rutaActualizada' => 'rutaActualizada'
    ];

    public function mount($ruta)
    {
        $this->ruta = $ruta;
    }

    public function render()
    {
        return view('livewire.arbol-navegabilidad');
    }

    public function rutaActualizada($ruta)
    {
        $this->ruta = $ruta;
    }
}
