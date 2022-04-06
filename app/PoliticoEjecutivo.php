<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Intendente;
use Livewire\Component;

class PoliticoEjecutivo extends Component
{

    public $datosPoliticos;
    public $vista;


    public $estadoVerDetalle;
    public $validado;

    protected $listeners = [
        'verDetalle' => 'verDetalleJs',
        'limpio' => 'verficarStorage'
    ];
    public function verDetalleJs($datos)
    {
        $this->estadoVerDetalle = true;
        $this->verDetalle($datos['id']);
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/ejecutivo']);
    }

    public function obtenerVistaDetalle()
    {
        return "detalle";
    }

    public function verDetalle($id)
    {
        $this->datosPoliticos = Intendente::find($id);
        $this->vista = $this->obtenerVistaDetalle($this->datosPoliticos);
        if ($this->estadoVerDetalle == false) {
            $this->dispatchBrowserEvent('show-map', ['data' => $this->datosPoliticos]);
        } else {
            $this->estadoVerDetalle = false;
        }
    }


    public function mount()
    {
        
        $this->vista = "general";
        $this->datosPoliticos = Intendente::all();
    }

    public function render()
    {
        return view('livewire.politico-ejecutivo');
    }
}
