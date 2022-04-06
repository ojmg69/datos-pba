<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\RegionElectrica;
use Livewire\Component;

class ViviendaServicio extends Component
{
    public $estilos;
    public $referencias;
    public $vista = "general";
    public $municipio;

    public $listeners = [
        'clickEnMunicipio',
        'clickEnTodosLosMunicipios' => 'deseleccionarMunicipio',
        'clickEnTodasLasSecciones' => 'deseleccionarMunicipio',
    ];
    
    public function mount() {
        $this->referencias =$this->obtenerReferencias();
        $this->estilos = Distrito::estilosSegunRegionElectrica();
    }

    public function render()
    {
        return view('livewire.vivienda-servicio');
    }

    public function obtenerReferencias()
    {
        $resultado = [];
        $region = RegionElectrica::all();
        foreach ($region as $region) {
            $ref = [
                'nombre'    => $region->nombre,
                'relleno'   => $region->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function clickEnMunicipio($id) {
        $this->municipio = Distrito::find($id);
        $this->emit('idMunicipioActualizado', $this->municipio->id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Servicios', $this->municipio->nombre]);
        if (!is_null($this->municipio->region_electrica)) {
            $this->emit('idRegionElectrica', $this->municipio->region_electrica->id);
        }
    }

    public function deseleccionarMunicipio() {
        $this->municipio = null;
        $this->emit('idMunicipioActualizado', null);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Servicios']);
        $this->emit('idRegionElectrica', null);
    }
}