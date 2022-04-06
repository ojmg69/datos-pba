<?php

namespace App\Http\Livewire;

use App\UniversidadOTerciario;
use App\Distrito;
use App\Seccion;
use Livewire\Component;

class EducacionUniversidadesTerciarios extends Component
{

    public $vista;
    public $idMunicipio;
    public $idSeccion;
    public $pines = [];

    public $listeners = [
        'clickEnEstablecimiento',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones' => 'restaurarMapa',
        'clickEnRestaurar' => 'restaurarMapa',
        'verTabla',
    ];
    
    public function render()
    {
        return view('livewire.educacion-universidades-terciarios');
    }

    public function mount() {
        $this->pines = UniversidadOTerciario::pines();
    }

    public function clickEnEstablecimiento($id) {
        $this->vista = 'detalle';
        $this->establecimiento = UniversidadOTerciario::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Universidades y Terciarios', $this->establecimiento->distrito->nombre]);
        $this->emit('entidadActualizada', $this->establecimiento);
        $this->dispatchBrowserEvent('enfocarCoordenadas', [
            'coords' => $this->establecimiento->pin(),
            'idMunicipio' => $this->establecimiento->distrito_id
        ]);
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Universidades y Terciarios']);
    }

    public function clickEnMunicipio($id){
        $this->idMunicipio = $id;
        $this->idSeccion = null;
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Universidades y Terciarios', Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Universidades y Terciarios', Seccion::find($id)->nombre]);
    }

    public function verTabla() {
        $this->vista = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Universidades y Terciarios']);
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        }else if($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        }else {
            $this->dispatchBrowserEvent('mostrarMunicipios');
        }
    }
}
