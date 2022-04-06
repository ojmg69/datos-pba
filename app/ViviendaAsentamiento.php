<?php

namespace App\Http\Livewire;

use App\TipoAsentamientos;
use App\Asentamientos;
use App\Distrito;
use Livewire\Component;

class ViviendaAsentamiento extends Component
{
    public $vista;
    public $pines;
    public $idMunicipio;
    public $idSeccion;
    public $asentamiento;

    protected $listeners = [
        'clickEnAsentamiento',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        'clickEnRestaurar'          => 'restaurarMapa',
    ];

    public function mount()
    {
        $this->pines = Asentamientos::pines();
    }

    public function clickEnAsentamiento($id) {
        $this->vista = 'detalle';
        $this->asentamiento = Asentamientos::find($id);
        
        $coords = [
            'latitud'   =>  $this->asentamiento->latitud,
            'longitud'  =>  $this->asentamiento->longitud,
        ];

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Asentamientos', $this->asentamiento->nombre]);

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $coords, 'idMunicipio' => $this->asentamiento->distrito_id ]
        );
    }

    public function verTabla() {
        $this->vista = 'tabla';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Asentamientos']);
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
        return view('livewire.vivienda-asentamiento');
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
    }

    public function clickEnSeccion($id)
    {
        $this->idSeccion = $id;
    }

    public function restaurarMapa()
    {
        $this->idSeccion = null;
        $this->idMunicipio = null;
    }
}
