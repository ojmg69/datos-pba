<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Transferencia;

class EconomicoTransferencias extends Component
{
    public $transferencias;
    public $distrito;
    public $vista;

    public function mount(){
       
        $this->distrito = null;
        $this->transferencias = Transferencia::get();
    }



    public function render()
    {
        return view('livewire.economico-transferencias');
    }
}
