<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\Viento;
use Livewire\Component;

class GeografiaVientos extends Component
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
        $vientos = Viento::all();
        foreach ($vientos as $viento) {
            $ref = [
                'nombre'    => $viento->nombre . ' km/h',
                'relleno'   => $viento->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function mount() {

        $this->referencias = $this->obtenerReferencias();
        $this->estilosMunicipios = Distrito::estilosSegunViento(1);

        $this->dispatchBrowserEvent('mapaListo');
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunViento($valorInicial);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }

    public function verTabla() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Vientos']);
    }

    public function clickEnMunicipio($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Vientos', Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Vientos', Seccion::find($id)->nombre]);
    }

    public function render()
    {
        return view('livewire.geografia-vientos');
    }
}
