<?php

namespace App\Http\Livewire;

use App\Organismo;
use App\TipoOrganismo;
use Livewire\Component;

class PoliticoSedes extends Component
{

    public $datosOrganismo;
    public $datosOrganismoLista;
    public $datosCatastrales;
    public $vista;
    public $pines;
    public $referencias;
    public $tiposOrganismo;
    
    public $validado;

    protected $listeners = [
        'verDetalleDeMunicipioGuardado',
        'clickEnMunicipio' => 'verDetalleDeMunicipioGuardado'
    ];

    public function obtenerVistaPrincipal()
    {
        $this->vista= 'general';
    }

    public function obtenerVistaDetalle()
    {
        return "detalle";
    }

    public function zoomEnOrganismo($organismoId) {
        $organismo = Organismo::find($organismoId);
        $coords = [
            'latitud'   =>  $organismo->lat,
            'longitud'  =>  $organismo->lng,
        ];
        $this->dispatchBrowserEvent('clickEnLupita', $coords);
    }

    public function verDetalle($id)
    {
        $this->datosOrganismoLista = Organismo::where('distrito_id','=',$id)->get();
        $this->vista = 'lista';
       
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
    }

    public function verDetalleDeMunicipioGuardado($id)
    {
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->datosOrganismoLista = Organismo::where('distrito_id','=',$id)->get();
        $this->vista = 'lista';
    }

    public function obtenerPines($organismos) {
        $resultado = [];

        foreach ($organismos as $organismo) {
            $pin = [
                'latitud' => $organismo->lat,
                'longitud' => $organismo->lng,
                'relleno' => $organismo->organismo->color,
            ];
            array_push($resultado, $pin);
        }

        return $resultado;
    }

    public function obtenerReferencias() {
        $tiposOrganismo = TipoOrganismo::all();

        $resultado = [];

        foreach ($tiposOrganismo as $tipo) {
            $ref = [
                'nombre' => $tipo->nombre,
                'relleno' => $tipo->color,
            ];
            array_push($resultado, $ref);
        }

        return $resultado;
    }

    public function obtenerTiposOrganismos()
    {
        $tiposOrg = TipoOrganismo::where('estado','=','ACTIVO')
        ->orderBy('nombre','ASC')
        ->get();
        
        return $tiposOrg;
    }
    public function mount()
    {
        $this->tiposOrganismo = $this->obtenerTiposOrganismos();
        $this->vista = "general";
        $this->datosOrganismo = Organismo::orderBy('organismo_id','ASC')->get();
        $this->pines = $this->obtenerPines($this->datosOrganismo);
        $this->referencias = $this->obtenerReferencias();
    }
    public function render()
    {
        return view('livewire.politico-sedes');
    }
}
