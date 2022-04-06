<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use Livewire\Component;

class EducacionMatricula extends Component
{
    public $vista;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnRestaurar'          => 'restaurarMapa',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
    ];
    
    public function render()
    {
        return view('livewire.educacion-matricula');
    }


    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Matriculas', Seccion::find($id)->nombre]);
    }

    public function clickEnMunicipio($id){
        $distrito= Distrito::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Matriculas', $distrito->nombre]);
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Matriculas']);
    }
}
