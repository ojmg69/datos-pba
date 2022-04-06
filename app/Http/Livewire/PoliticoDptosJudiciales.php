<?php

namespace App\Http\Livewire;

use App\Departamento;
use Livewire\Component;

class PoliticoDptosJudiciales extends Component
{
    public $departamentos;

    protected $listeners = [
        'mapaListo'
    ];

    public function mapaListo() {
        $this->dispatchBrowserEvent('prueba', ['data' => $this->datosIntendentes]);
    }


    public function mount()
    {
        $this->departamentos = Departamento::join('distrito');
    }


    public function render()
    {
        return view('livewire.politico-dptos-judiciales');
    }
}
