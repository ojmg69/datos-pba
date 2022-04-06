<?php

namespace App\Http\Livewire;

use App\ParqueEolico;
use Livewire\Component;

class ProductivoParquesEolicos extends Component
{
    public $vista = 'tabla';
    public $parque_eolico;
    public $pines;

    protected $listeners = [
        'clickEnParque',
        'clickEnRestaurar'              => 'verTabla',
        'clickEnTodasLasSecciones'      => 'verTabla',
        'clickEnTodosLosMunicipios'     => 'verTabla',
        // 'clickEnSeccion',
        'clickEnMunicipio',
        // 'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount() {
        $this->pines = ParqueEolico::pines();
    }

    public function render()
    {
        return view('livewire.productivo-parques-eolicos');
    }

    public function clickEnParque($id) {
        $this->vista = 'detalle';
        $this->parque_eolico = ParqueEolico::find($id);
        
        $coords = [
            'latitud'   =>  $this->parque_eolico->latitud,
            'longitud'  =>  $this->parque_eolico->longitud,
        ];

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $coords, 'idMunicipio' => $this->parque_eolico->distrito_id ]
        );
    }

    public function verTabla() {
        $this->vista = 'tabla';
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('agregarPines');
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
    }
}
