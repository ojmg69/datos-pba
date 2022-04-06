<?php

namespace App\Http\Livewire;

use App\Consulado;
use App\Distrito;
use Livewire\Component;

class MunicipioConsulado extends Component
{
    public $datosConsulado;
    public $datosConsuladoLista;
    public $vista;
    public $idsMunicipiosResaltados;

    public $validado;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones'      => 'mount',
        'clickEnTodosLosMunicipios'     => 'mount',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount()
    {
        $this->vista = "general";
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }
    
    public function render()
    {
        return view('livewire.municipio-consulado');
    }

    public function obtenerVistaPrincipal(){}

    public function verDetalle($id)
    {
        $this->datosConsuladoLista = Consulado::where('distrito_id', '=', $id)->get();
        $this->vista = 'lista';
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
    }

    public function clickEnMunicipio($id)
    {
        $this->vista = 'general';
    }

    public function clickEnSeccion($seccionId) {
        $this->vista = "general";
    }

    public function buscarMunicipiosQueResaltar() {
        return Consulado::
            join('distritos', 'consulados.distrito_id', '=', 'distritos.id')
            ->select('distritos.id')
            ->groupBy('distritos.id')
            ->get()
            ->map(function ($distrito) { return $distrito->id; })
            ->toArray();
    }
}
