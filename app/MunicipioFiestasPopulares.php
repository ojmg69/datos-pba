<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Fiesta;
use Livewire\Component;

class MunicipioFiestasPopulares extends Component
{
    public $datosFiestas;
    public $vista;
    public $idsMunicipiosResaltados;
    public $idDistrito;
    public $idSeccion;
    
    public $validado;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones'      => 'mostrarTodasLasFiestas',
        'clickEnTodosLosMunicipios'     => 'mostrarTodasLasFiestas',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio',
        'verDetalle'
    ];

    public function mount()
    {
        $this->vista = "general";
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }

    public function render()
    {
        return view('livewire.municipio-fiestas-populares');
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => 'http://localhost/paraprueba/datospba/public/municipios/fiestas_populares']);
    }
    
    public function volver()
    {
        $this->vista = "general";
    }


    public function verDetalle($id)
    {
        $this->datosFiestas = Fiesta::find($id);
        $this->vista = "detalle";
        $this->dispatchBrowserEvent('clickEnLupita', intval($this->datosFiestas->distrito->id));
    }

    public function clickEnMunicipio($id)
    {
        $this->idDistrito = $id;
        $this->vista = "general";
        $this->datosFiestas = Fiesta::where('distrito_id','=',$id)->get();
        
    }

    public function mostrarTodasLasFiestas() {
        $this->mount();
    }

    public function clickEnSeccion($seccionId)
    {
        $this->idSeccion = $seccionId;
        $this->vista = "general";
    }

    public function buscarMunicipiosQueResaltar() {
        return Fiesta::
            join('distritos', 'fiestas.distrito_id', '=', 'distritos.id')
            ->select('distritos.id')
            ->groupBy('distritos.id')
            ->get()
            ->map(function ($distrito) { return $distrito->id; })
            ->toArray();
    }
}
