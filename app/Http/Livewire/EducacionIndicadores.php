<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\RegionEducativa;
use App\Formateado\NumerosRomanos;
use App\EstablecimientoEducativo;
use Livewire\Component;

class EducacionIndicadores extends Component
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
        $this->referencias = RegionEducativa::referencias('Region Educativa ', 'id', new NumerosRomanos());
    }
    
    public function render()
    {
        return view('livewire.educacion-indicadores');
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Indicadores', Seccion::find($id)->nombre]);
    }

    public function clickEnMunicipio($id){
        $formateador= new NumerosRomanos();
        $distrito= Distrito::find($id);
        $stringRegionEducativa= 'Región Educativa '. $formateador->convertir($distrito->region_educativa_id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Indicadores', $stringRegionEducativa, $distrito->nombre]);
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Indicadores']);
    }
}
