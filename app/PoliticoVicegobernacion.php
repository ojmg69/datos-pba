<?php

namespace App\Http\Livewire;

use App\Legislatura;
use Livewire\Component;

class PoliticoVicegobernacion extends Component
{
    public $datosLegislatura;
    public $descripcion;

    public function mostrarDescripcion()
    {
        $this->descripcion = true;
    }
    public function minimizar()
    {
        $this->descripcion = false;
        $this->verDetalle($this->datosLegislatura->id);
    }


    public function mount()
    {
        $this->datosLegislatura=Legislatura::where('tipo_autoridad','=','Presidenta')->first();
        /* dd($this->datosLegislatura); */
    }
    public function render()
    {
        return view('livewire.politico-vicegobernacion');
    }
}
