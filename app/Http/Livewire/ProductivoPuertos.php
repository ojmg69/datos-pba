<?php

namespace App\Http\Livewire;

use App\Puerto;
use Livewire\Component;

class ProductivoPuertos extends Component
{
    public $vista = 'tabla';
    public $puerto;
    public $urlLinda = 'linda.com';
    public $pines;

    protected $listeners = [
        'clickEnPuerto',
        'clickEnRestaurar'              => 'verTabla',
        'clickEnTodasLasSecciones'      => 'verTabla',
        'clickEnTodosLosMunicipios'     => 'verTabla',
        // 'clickEnSeccion',
        'clickEnMunicipio',
        // 'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount() {
        $this->pines = Puerto::pines();
    }

    public function render()
    {
        return view('livewire.productivo-puertos');
    }

    public function clickEnPuerto($id) {
        $this->vista = 'detalle';
        $this->puerto = Puerto::find($id);
        $this->urlLinda = preg_replace('/https?:\/\//', '', $this->puerto->web);
        $this->urlLinda = preg_replace('/\//', '', $this->urlLinda);

        $coords = [
            'latitud'   =>  $this->puerto->latitud,
            'longitud'  =>  $this->puerto->longitud,
        ];

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $coords, 'idMunicipio' => $this->puerto->distrito_id ]
        );
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
    }

    public function verTabla() {
        $this->vista = 'tabla';
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('agregarPines');
    }
}
