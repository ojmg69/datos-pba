<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\PlanPolitico;
use Livewire\Component;

class MedioambientePoliticasLocales extends Component
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
        $climas = PlanPolitico::all();
        foreach ($climas as $clima) {
            $ref = [
                'nombre'    => $clima->nombre,
                'relleno'   => $clima->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }


    public function mount() {

        $this->referencias = $this->obtenerReferencias();
        $this->estilosMunicipios = Distrito::estilosSegunPlan(1);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunPlan($valorInicial);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Medioambiente', 'Políticas Locales', Seccion::find($id)->nombre]);
    }

    public function clickEnMunicipio($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Medioambiente', 'Políticas Locales', Distrito::find($id)->nombre]);
    }

    public function verTabla(){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Medioambiente', 'Políticas Locales']);
    }

    public function render()
    {
        return view('livewire.medioambiente-politicas-locales');
    }
}
