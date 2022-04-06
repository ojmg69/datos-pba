<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Distrito;
use App\Departamento;

class PoliticoDepartamentosJudiciales extends Component
{
    public $estilos;
    public $referencias;
    public $vista = "departamentos";
    public $municipio;
    public $departamentos;

    public $listeners = [
        'clickEnMunicipio',
        'verDetalleMunicipioGuardado' => 'clickEnMunicipio'
    ];
    
    public function mount() {
        $this->estilos = Distrito::estilosSegunDepartamentoJudicial();
        $this->referencias = Departamento::referenciasPorColor();
        $this->departamentos = Departamento::all();
    }

    public function render()
    {
        return view('livewire.politico-departamentos-judiciales');
    }

    public function clickEnMunicipio($id) {
        $this->vista = "municipio";
        $this->municipio = Distrito::join('departamentos', 'distritos.departamento_id', '=', 'departamentos.id')
            ->select('distritos.*', 'departamentos.nombre as depto_nombre')
            ->find($id);
    }

    public function verDepartamentos() {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/departamentos-judiciales']);
    }

    public function verDetalle($departamentoId) {
        $idsMunicipios = Distrito::
            where('departamento_id', '=', $departamentoId)
            ->get()
            ->map(function ($municipio) {
                return $municipio->id;
            })
            ->toArray();

        $this->dispatchBrowserEvent('mostrarMunicipios', $idsMunicipios);
    }
}
