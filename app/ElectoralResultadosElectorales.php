<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ResultadosElectoralesProvisorio;
use App\Distrito;

class ElectoralResultadosElectorales extends Component
{

    public $datosResultados;
    public $datosElectoresLista;
    public $vista;
    public $resultado;
    public $idsMunicipiosResaltados;
    public $tipo_resultado;
    public $distrito_id;

    public $validado;

    protected $listeners = [
        'limpio'    => 'verficarStorage',
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones'      => 'mount',
        'clickEnTodosLosMunicipios'     => 'mount',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount()
    {
        $this->tipo_resultado = 1;
        $this->vista = "general";
        $this->datosResultados = ResultadosElectoralesProvisorio::groupBy('distrito_id')->get();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Electoral', 'Resultados Electorales']);
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }

    public function render()
    {
        $this->resultado = ResultadosElectoralesProvisorio::where('distrito_id', '=', $this->distrito_id)
            ->where('tipo_eleccion_id', '=', $this->tipo_resultado)
            ->get();
        return view('livewire.electoral-resultados-electorales');
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/electoral/resultados']);
    }

    public function verDetalle($id)
    {
        $this->distrito_id = $id;
        $this->resultado = ResultadosElectoralesProvisorio::where('distrito_id', '=', $id)
            ->where('tipo_eleccion_id', '=', $this->tipo_resultado)
            ->get();
        $this->vista = 'detalle';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Electoral', 'Resultados Electorales', $this->obtenerNombreDistrito($id)]);
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
    }

    
    public function clickEnMunicipio($id)
    {
        $this->verDetalle($id);
    }

    public function clickEnSeccion($seccionId)
    {
        $this->vista = "general";
        $this->datosResultados = ResultadosElectoralesProvisorio::join('distritos', 'resultados_electorales_provisorios.distrito_id', '=', 'distritos.id')
            ->join('secciones', 'distritos.seccion_id', '=', 'secciones.id')
            ->select('resultados_electorales_provisorios.*')
            ->where('distritos.seccion_id', '=', $seccionId)
            ->get();
    }

    public function buscarMunicipiosQueResaltar()
    {
        return ResultadosElectoralesProvisorio::join('distritos', 'resultados_electorales_provisorios.distrito_id', '=', 'distritos.id')
            ->select('distritos.id')
            ->groupBy('distritos.id')
            ->get()
            ->map(function ($distrito) {
                return $distrito->id;
            })
            ->toArray();
    }

    public function obtenerNombreDistrito($id){
        return Distrito::find($id)->nombre;
    }
}
