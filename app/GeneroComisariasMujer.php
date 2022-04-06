<?php

namespace App\Http\Livewire;

use App\ComisariaMujer;
use App\Distrito;
use Livewire\Component;

class GeneroComisariasMujer extends Component
{
    public $pines;
    protected $listeners = [
        'clickEnComisaria',
        'clickEnMunicipio',
        'clickEnRestaurar'              => 'restaurarMapa',
        'clickEnTodasLasSecciones'      => 'restaurarMapa',
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
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Comisarías de la Mujer', Distrito::find($id)->nombre]);
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Comisarías de la Mujer']);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/genero/comisarias-mujer']);
    }
    public function render()
    {
        return view('livewire.genero-comisarias-mujer');
    }
}
