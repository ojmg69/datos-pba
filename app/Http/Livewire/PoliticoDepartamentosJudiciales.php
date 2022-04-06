<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Distrito;
use App\Departamento;
use Illuminate\Support\Facades\DB;

class PoliticoDepartamentosJudiciales extends Component
{
    public $estilos;
    public $referencias;
    public $vista = "departamentos";
    public $municipio;
    public $municipios;
    public $municipiosDetalles;
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
        $this->vista = "departamentos";
        $this->departamentos = Departamento::all();
        $this->dispatchBrowserEvent('mostrarMunicipios');
        // $this->dispatchBrowserEvent('limpiarStorage', ['data' => 'http://localhost/paraprueba/datospba/public/politico-institucional/departamentos-judiciales']);
    }

    public function verDetalle($departamentoId) {
        $this->vista = "municipios";
        $idsMunicipios = Distrito::
            where('departamento_id', '=', $departamentoId)
            ->get()
            ->map(function ($municipio) {
                return $municipio->id;
            })
            ->toArray();
        
        $this->municipios = Distrito::whereIn('id', $idsMunicipios)->get();
        $total_poblacion = Distrito::select(
            DB::raw('SUM(poblacion) as poblacion'),
        )->first();
        $total_poblacion_partidos = $this->municipios->map(function ($municipio){
            return (int)$municipio->poblacion;
        });
        $this->municipiosDetalles['total_poblacion'] = array_sum($total_poblacion_partidos->toArray());
        $this->municipiosDetalles['total_poblacion_porcentaje'] = (array_sum($total_poblacion_partidos->toArray()) * 100) / $total_poblacion->poblacion;
        $this->dispatchBrowserEvent('mostrarMunicipios', $idsMunicipios);
    }
}
