<?php

namespace App\Http\Livewire;

use App\EspacioContencion;
use App\Distrito;
use Livewire\Component;

class GeneroEspaciosContencion extends Component
{
    public $vista;
    public $pines;
    public $idMunicipio;
    public $idSeccion;
    protected $listeners = [
        'clickEnEspacio',
        'clickEnMunicipio',
        'clickEnSeccion',
        'verTabla',
        'clickEnRestaurar'              => 'restaurarMapa',
        'clickEnTodasLasSecciones',
        'clickEnTodosLosMunicipios',
    ];

    public function mount() {
        $this->pines = EspacioContencion::pines();
    }

    public function clickEnEspacio($id) {

        $this->vista = 'detalle';
        $espacio = EspacioContencion::find($id);
        if (!$this->idSeccion) {
            $this->idMunicipio = $espacio->distrito_id;
        }
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención', $espacio->distrito->nombre]);
        $this->emit('entidadActualizada', $espacio);
        $pin = $espacio->pin();
        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $pin, 'idMunicipio' => $espacio->distrito_id ]
        );
    }

    public function clickEnMunicipio($id){
        $this->idMuncipio = $id;
        $this->idSeccion = null;
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención', Distrito::find($id)->nombre]);
    }
    
    public function clickEnSeccion($id){
        $this->idSeccion = $id;
        $this->idMunicipio = null;
    }
    
    public function clickEnTodasLasSecciones(){
        $this->idMunicipio = null;
        $this->idSeccion = null;
    }
    
    public function clickEnTodosLosMunicipios(){
        $this->idMunicipio = null;
        $this->idSeccion = null;
    }

    public function restaurarMapa() {
        $this->vista = null;
        $this->idMuncipio = null;
        $this->idSeccion = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención']);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function verTabla() {
        $this->dispatchBrowserEvent('mapaListo');
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención']);    
        $this->vista = null;
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
        return view('livewire.genero-espacios-contencion');
    }
}
