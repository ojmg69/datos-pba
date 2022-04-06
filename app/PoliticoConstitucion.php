<?php

namespace App\Http\Livewire;

use App\OrganismoConstitucion;
use Livewire\Component;

class PoliticoConstitucion extends Component
{

    public $datosConstitucion;
    public $vista;

    public $estadoVerDetalle;
    public $validado;

    protected $listeners = [
        'clickEnTodosLosMunicipios' => 'obtenerVistaPrincipal',
        'clickEnTodasLasSecciones'  => 'obtenerVistaPrincipal',
        'clickEnRestaurar'          => 'obtenerVistaPrincipal'
    ];
    public function verDetalleJs($datos)
    {
        $this->estadoVerDetalle = true;
        $this->verDetalle($datos['id']);
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/constitucion']);
    }

    public function obtenerVistaDetalle()
    {
        return "detalle";
    }

    public function verDetalle($id)
    {
        $this->datosConstitucion = OrganismoConstitucion::find($id);
        $this->vista = $this->obtenerVistaDetalle($this->datosConstitucion);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Ejecutivo', 'Org. de la Constitución', $this->datosConstitucion->autoridad]);
        if ($this->estadoVerDetalle == false) {
           // $this->dispatchBrowserEvent('show-map', ['data' => $this->datosConstitucion]);
        } else {
            $this->estadoVerDetalle = false;
        }
    }

    public function mount(){
        $this->vista = "general";
        $this->datosConstitucion = OrganismoConstitucion::all();
    }
    public function render()
    {
        return view('livewire.politico-constitucion');
    }
}
