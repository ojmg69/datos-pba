<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\concejeros;
use Livewire\Component;
use App\RegionEducativa;
use App\Formateado\NumerosRomanos;
use App\EstablecimientoEducativo;

class EducacionMatricula extends Component
{
    public $vista;
    public $estilos;
    public $referencias;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnRestaurar'          => 'restaurarMapa',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
    ];
    
      public function mount() {
        $this->estilos = Distrito::estilosSegunRegionEducativa();
        $this->referencias = RegionEducativa::referencias(' ', 'id', new NumerosRomanos());
    }
    
    public function render()
    {
        return view('livewire.educacion-matricula');
    }


    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Consejeros', Seccion::find($id)->nombre]);
    }

    public function clickEnMunicipio($id){
        $distrito= Distrito::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Consejeros', $distrito->nombre]);
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Consejeros']);
    }
}
