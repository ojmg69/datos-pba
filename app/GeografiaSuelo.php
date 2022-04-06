<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\Suelo;
use Livewire\Component;

class GeografiaSuelo extends Component
{

    public $vista = 'tabla';
    public $puerto;
    public $urlLinda = 'linda.com';
    public $distritos;
    public $estilosMunicipios;
    public $referencias;

    protected $listeners = [
        'selectorClickeado',
        'clickEnRestaurar'              => 'verTabla',
        'clickEnTodasLasSecciones'      => 'verTabla',
        'clickEnTodosLosMunicipios'     => 'verTabla',
        'clickEnSeccion',
        'clickEnMunicipio',
        // 'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function obtenerReferencias()
    {
        $resultado = [];
        $suelos = Suelo::all();
        foreach ($suelos as $suelo) {
            $ref = [
                'nombre'    => $suelo->nombre,
                'relleno'   => $suelo->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function mount() {

        $this->referencias = $this->obtenerReferencias();
        $this->estilosMunicipios = Distrito::estilosSegunSuelo(1);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunSuelo($valorInicial);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }

    public function verTabla() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Suelos']);
    }

    public function clickEnMunicipio($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Suelos', Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Suelos', Seccion::find($id)->nombre]);
    }

    public function render()
    {
        return view('livewire.geografia-suelo');
    }
}
