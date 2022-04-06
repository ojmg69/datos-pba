<?php

namespace App\Http\Livewire;

use App\Gobernador;
use Livewire\Component;

class PoliticoGobernacion extends Component
{
    public $datosGobernacion;

    public function mount()
    {
        $this->datosGobernacion = Gobernador::first();
    }
    public function render()
    {
        return view('livewire.politico-gobernacion');
    }
}
