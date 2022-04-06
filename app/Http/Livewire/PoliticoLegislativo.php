<?php

namespace App\Http\Livewire;

use App\Legislatura;
use Livewire\Component;

class PoliticoLegislativo extends Component
{

    public $datosSenadores;
    public $datosDiputados;
    public $datosLegislatura;
    public $vista;
    public $salto;
    public $descripcion;
    public $tipo_leg;

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
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/legislativo']);
    }

    public function obtenerVistaDetalle()
    {
        return "detalle";
    }


    public function verDetalle($id)
    {
        $this->datosLegislatura = Legislatura::find($id);
        $this->vista = $this->obtenerVistaDetalle($this->datosLegislatura);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Legislativo', $this->datosLegislatura->tipo_autoridad]);
        if ($this->estadoVerDetalle == false) {
            // $this->dispatchBrowserEvent('show-map', ['data' => $this->datosLegislatura]);
        } else {
            $this->estadoVerDetalle = false;
        }
    }

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
        $this->tipo_leg = 'senadores';
        $this->descripcion = false;
        $this->salto = false;
        $this->vista = "general";
    }


    public function render()
    {
        $this->datosSenadores = Legislatura::where('organismo', 'LIKE', '%Senadores')->orderBy('organismo', 'DESC')->get();
        $this->datosDiputados = Legislatura::where('organismo', 'LIKE', '%Diputados')->orderBy('organismo', 'DESC')->get();
        return view('livewire.politico-legislativo');
    }
}
