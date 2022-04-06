<?php

namespace App\Http\Livewire;

use App\EspacioCultural;
use App\Distrito;
use Livewire\Component;

class CulturaEspaciosCulturales extends Component
{
    public $vista;
    public $pines;
    public $idMunicipio;
    public $idSeccion;

    public $listeners = [
        'clickEnEntidad',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
        'verTabla',
    ];

    public function render()
    {
        $pines = EspacioCultural::pines();
        $this->pines = $pines;
        return view('livewire.cultura-espacios-culturales', [ 'pines' => $pines ]);
    }

    public function clickEnEntidad($id) {
        $this->vista = 'detalle';
        $espacio = EspacioCultural::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales', $espacio->distrito->nombre]);
        $this->emit('entidadActualizada', $espacio);
        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $espacio->pin(), 'idMunicipio' => $espacio->distrito_id ]
        );
    }

    public function clickEnMunicipio($id){
        $distrito= Distrito::find($id);
        $this->idMunicipio = $id;
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales', $distrito->nombre]);
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
    }
    
    public function clickEnSeccion($id){
        $this->idSeccion = $id;
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
    }

    public function clickEnTodosLosMunicipios() {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales']);
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
    }

    public function clickEnTodasLasSecciones() {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales']);
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
    }

    public function clickEnRestaurar() {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales']);
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
    }

    public function verTabla() {
        $this->dispatchBrowserEvent('mapaListo');
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Cultural', 'Espacios Culturales']);    
        $this->vista = null;
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        }else if($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }
}
