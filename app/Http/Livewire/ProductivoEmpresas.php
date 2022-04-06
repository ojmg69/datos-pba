<?php

namespace App\Http\Livewire;

use App\Empresa;
use Livewire\Component;

class ProductivoEmpresas extends Component
{
    public $vista = 'tabla';
    public $empresa;
    public $idMunicipio;
    public $idSeccion;
    public $urlLinda = '';
    public $pines;

    protected $listeners = [
        'clickEnEmpresa',
        'clickEnRestaurar' => 'restaurarMapa',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        // 'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnSeccion',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio',

    ];

    public function mount() {
        $this->pines = Empresa::pines();
    }

    public function render()
    {
        return view('livewire.productivo-empresas');
    }

    public function clickEnEmpresa($id) {
        $this->vista = 'detalle';
        $this->empresa = Empresa::find($id);
        $this->urlLinda = preg_replace('/https?:\/\//', '', $this->empresa->web);
        $this->urlLinda = preg_replace('/\//', '', $this->urlLinda);
        
        $coords = [
            'latitud'   =>  $this->empresa->latitud,
            'longitud'  =>  $this->empresa->longitud,
        ];

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $coords, 'idMunicipio' => $this->empresa->distrito_id ]
        );
    }

    public function restaurarMapa()
    {
        $this->idSeccion = null;
        $this->idMunicipio = null;
    }

    public function clickEnMunicipio($id){
        $this->idMunicipio = $id;
    }
    
    public function clickEnSeccion($id){
        $this->idSeccion = $id;
    }

    public function verTabla() {
        $this->vista = 'tabla';
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('agregarPines');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        }else if($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }
}
