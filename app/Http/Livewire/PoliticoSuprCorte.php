<?php

namespace App\Http\Livewire;

use App\SupremaCorte;
use Livewire\Component;

class PoliticoSuprCorte extends Component
{
    public $datosSupCorte;
    public $vista;

    public $estadoVerDetalle;
    public $validado;

    protected $listeners = [

        'limpio' => 'verficarStorage'
    ];
    public function verDetalleJs($datos)
    {
        $this->estadoVerDetalle = true;
        $this->verDetalle($datos['id']);
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/supr_corte']);
    }

    public function obtenerVistaDetalle()
    {
        return "detalle";
    }

    public function verDetalle($id)
    {
        $this->datosSupCorte = SupremaCorte::find($id);
        $this->vista = $this->obtenerVistaDetalle($this->datosSupCorte);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Suprema Corte', $this->datosSupCorte->tipo_autoridad]);
        if ($this->estadoVerDetalle == false) {
            // $this->dispatchBrowserEvent('show-map', ['data' => $this->datosSupCorte]);
        } else {
            $this->estadoVerDetalle = false;
        }
    }

    public function mount()
    {
        $this->vista = "general";
        
        $this->datosSupCorte = SupremaCorte::where('estado','=','ACTIVO')->get();
    }
    public function render()
    {
        return view('livewire.politico-supr-corte');
    }
}
