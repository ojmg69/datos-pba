<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use App\ZonaHidrica;
use Livewire\Component;

class GeografiaZonasHidraulicas extends Component
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
        $zonas = ZonaHidrica::all();
        foreach ($zonas as $zona) {
            $ref = [
                'nombre'    => $zona->nombre,
                'relleno'   => $zona->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function mount() {

        $this->referencias = $this->obtenerReferencias();
        $this->estilosMunicipios = Distrito::estilosSegunZonaHidraulicas(1);
        $this->dispatchBrowserEvent('mapaListo');
    }

    public function selectorClickeado($valorInicial)
    {
        $this->estilosMunicipios = Distrito::estilosSegunZonaHidraulicas($valorInicial);
        $this->dispatchBrowserEvent('estilosActualizados', $this->estilosMunicipios);
    }
    public function render()
    {
        return view('livewire.geografia-zonas-hidraulicas');
    }

    public function verTabla() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Zonas Hidráulicas']);
    }

    public function clickEnMunicipio($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Zonas Hidráulicas', Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Geografía', 'Zonas Hidráulicas', Seccion::find($id)->nombre]);
    }
}
