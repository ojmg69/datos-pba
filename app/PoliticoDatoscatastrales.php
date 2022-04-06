<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Localidad;
use Livewire\Component;

class PoliticoDatoscatastrales extends Component
{

    public $datosCatastrales;
    public $vista;
    public $idsMunicipiosResaltados;
    public $validado;
    public $localidades;

    protected $listeners = [
        'clickEnMunicipio',
        'clickEnTodosLosMunicipios'     => 'mostrarTodosLosMunicipios',
        'clickEnTodasLasSecciones'      => 'mostrarTodosLosMunicipios',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio',
        'verDetalle'
    ];

    public function mount()
    {
        $this->vista = "general";
        $this->datosCatastrales = Distrito::all();
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();

        }


    public function render()
    {
        return view('livewire.politico-datoscatastrales');
    }

    public function mostrarTodosLosMunicipios() {
        $this->vista = "general";
        $this->datosCatastrales = Distrito::all();
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/catastrales']);
    }

    public function verDetalle($id)
    {
        $this->datosCatastrales = Distrito::find($id);
        $this->localidades = Localidad::where('distrito_id','=',$id)->get();
        $this->vista = 'detalle';
        $this->dispatchBrowserEvent('clickEnLupita', $id);
    }

    public function clickEnMunicipio($id)
    {
        $this->datosCatastrales = Distrito::find($id);
        $this->localidades = Localidad::where('distrito_id','=',$id)->get();
        $this->vista = 'detalle';
    }


    public function buscarMunicipiosQueResaltar() {
        return Distrito::select('id')
            ->where('hermanamientos','!=',"")
            ->get()
             ->map(function ($distrito) { return $distrito->id; })
            ->toArray();
    }
}
