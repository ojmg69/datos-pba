<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EtiquetaGrafico extends Component
{
    public $texto;

    public $color;

    public function mount($texto, $color)
    {
        $this->texto = $texto;
        $this->color = $color;
    }
    public function render()
    {
        return view('livewire.etiqueta-grafico');
    }
}
