<?php

namespace App\Http\Livewire;

use App\Cultivo_Fauna;
use App\Distrito;
use Livewire\Component;

class GeografiaFaunaCultivos extends Component
{
    public $vista = 'tabla';
    public $puerto;
    public $urlLinda = 'linda.com';
    public $distritos;
    public $estilosMunicipios;
    public $referencias;

    protected $listeners = [
        'selectorClickeado',
        /* 'clickEnRestaurar'           => 'verTabla',
        'clickEnTodasLasSecciones'      => 'verTabla',
        'clickEnTodosLosMunicipios'     => 'verTabla', */
        // 'clickEnSeccion',
        // 'clickEnMunicipio',
        // 'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];


    public function obtenerReferencias()
    {
        $resultado = [];
        $cultivos_faunas = Cultivo_Fauna::all();
        foreach ($cultivos_faunas as $cf) {
            $ref = [
                'nombre'    => $cf->nombre,
                'relleno'   => $cf->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function mount() {

       
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunViento($valorInicial);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }

    public function render()
    {
        return view('livewire.geografia-fauna-cultivos');
    }
}
