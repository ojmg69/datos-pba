<?php

namespace App\Http\Livewire;

use App\Clima;
use App\Distrito;
use App\Seccion;
use Livewire\Component;

class GeografiaClima extends Component
{

    public $vista = 'tabla';
    public $puerto;
    public $urlLinda = 'linda.com';
    public $distritos;
    public $estilosMunicipios;
    public $referencias;
    public $clima;

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
        $climas = Clima::all();
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
        $this->estilosMunicipios = Distrito::estilosSegunClima(0);
        $this->clima = Clima::find(1)->nombre;
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunClima($valorInicial);
        if($valorInicial == 'todos'){
            $this->clima= Clima::find(1)->nombre;
        } else{
            $this->clima = Clima::find($valorInicial)->nombre;
        }
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Climas', $this->clima]);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }

    public function verTabla() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Climas', $this->clima]);
    }

    public function clickEnMunicipio($id){
        $climasMunicipio = Clima::nombreClimaSegunDistrito($id);
        $climaEnMunicipio = null;
        if(count($climasMunicipio) == 1){
            $climaEnMunicipio = $climasMunicipio[0];
        } else{
            foreach($climasMunicipio as $climaMunicipio){
                if($climaMunicipio == $this->clima){
                    $climaEnMunicipio = $this->clima; 
                }
            }
        }
        if($climaEnMunicipio == null){
            $climaEnMunicipio = $climasMunicipio[0];
        }
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Climas', $climaEnMunicipio, Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Climas', $this->clima, Seccion::find($id)->nombre]);
    }


    public function render()
    {
        return view('livewire.geografia-clima');
    }
}
