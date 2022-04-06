<?php

namespace App\Http\Livewire;

use App\ComisariaMujer;
use App\Distrito;
use Livewire\Component;

class GeneroComisariasMujer extends Component
{
    public $pines;
    public $idMunicipio;
    public $idSeccion;

    protected $listeners = [
        'clickEnComisaria',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnRestaurar'              => 'restaurarMapa',
        'clickEnTodasLasSecciones',
        'clickEnTodosLosMunicipios'     => 'restaurarMapa',
    ];

    public function mount() {
        $this->pines = ComisariaMujer::pines();
    }

    public function clickEnComisaria($id) {
        $comisaria = ComisariaMujer::find($id);
        $pin = $comisaria->pin();

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $pin, 'idMunicipio' => $comisaria->distrito_id ]
        );
    }

    public function clickEnMunicipio($id){
        $this->idMunicipio = $id;
        $this->idSeccion = null;
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Comisarías de la Mujer', Distrito::find($id)->nombre]);
    }
    public function clickEnSeccion($id){
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->dispatchBrowserEvent('mostrarSeccion', intval($id));
    }

    public function restaurarMapa() {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Comisarías de la Mujer']);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function clickEnTodasLasSecciones() {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Comisarías de la Mujer']);
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        }else if($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }
    public function render()
    {
        return view('livewire.genero-comisarias-mujer');
    }
}
