<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Botones extends Component
{
    public $botones;

    public function mount($args)
    {
        foreach ($args as $boton) {
            if (!array_key_exists('nombre', $boton) || !array_key_exists('evento', $boton))
            {
                // throw new Exception('ERROR: Todos los botones deben tener nombre y evento');
            }
        }
        $this->botones = $args;
    }

    public function render()
    {
        return view('livewire.botones');
    }

    public function click($evento)
    {
        $this->emit($evento);
    }
}
