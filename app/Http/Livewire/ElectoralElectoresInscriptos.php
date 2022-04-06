<?php

namespace App\Http\Livewire;

use App\Conteo\ConteoCircuitosMesas;
use App\Conteo\ConteoElectores;
use App\Conteo\ConteoElectoresGrafica;
use App\Electores;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ElectoralElectoresInscriptos extends Component
{


    public $datosElectores;
    public $datosElectoresLista;
    public $conteoElectores;
    public $conteoCircuitosMesas;
    public $conteoElectoresGrafico;
    public $vista;
    public $idsMunicipiosResaltados;
    public $idMunicipio;
    public $seccion;
    public $periodos = null;
    public $periodoSelected;

    public $validado;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones',
        'clickEnTodosLosMunicipios',
        'clickEnRestaurar' => 'clickEnTodosLosMunicipios',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount()
    {
        $this->vista = "tablero";
        $periodo = DB::table('periodo_eleccion')->select('id')->where('nombre', '2019')->first()->id;
        $this->periodoSelected = $periodo;
        $this->cargarDatosTablero(['idPeriodo' => $this->periodoSelected]);
        $this->actualizarTablero();
        $this->periodos = DB::table('periodo_eleccion')->get()->toArray();
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }

    public function render()
    {
        $this->periodos = DB::table('periodo_eleccion')->get()->toArray();
        return view('livewire.electoral-electores-inscriptos');
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->periodos = DB::table('periodo_eleccion')->get()->toArray();
        $data = $this->idMunicipio ? ['idMunicipio' => $this->idMunicipio] : ($this->seccion ? ['idSeccion' => $this->seccion] : null);
        $periodoYdata = is_null($data) ? ['idPeriodo' => $this->periodoSelected] : array_merge($data, ['idPeriodo' => $this->periodoSelected]);
        $this->cargarDatosTablero($periodoYdata);
        $this->actualizarTablero();
    }

    public function verDetalles()
    {
        $this->vista = 'general';
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
        $this->cargarDatosTablero(['idMunicipio' => $idMunicipio]);
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
        $this->actualizarTablero();
    }

    public function updatedPeriodoSelected($id)
    {
        $this->periodoSelected = $id;
        $data = $this->idMunicipio ? ['idMunicipio' => $this->idMunicipio] : ($this->seccion ? ['idSeccion' => $this->seccion] : null);
        $periodoYdata = is_null($data) ? ['idPeriodo' => $id] : array_merge($data, ['idPeriodo' => $id]);
        $this->cargarDatosTablero($periodoYdata);
        $this->actualizarTablero();

    }
    
    public function clickEnTodosLosMunicipios()
    {
        $this->idMunicipio = null;
        $this->seccion = null;
        $this->cargarDatosTablero(['idPeriodo' => $this->periodoSelected]);
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->idMunicipio = null;
        $this->seccion = null;
        $this->cargarDatosTablero(['idPeriodo' => $this->periodoSelected]);
        $this->actualizarTablero();
    }

    public function clickEnSeccion($seccion)
    {
        $this->idMunicipio = NULL;
        $this->seccion = $seccion;
        $this->emit('seccionActualizada', $seccion);
        $this->cargarDatosTablero(['idSeccion' => $seccion]);
        $this->actualizarTablero();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoElectores = (new ConteoElectores())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoElectoresGrafico = (new ConteoElectoresGrafica())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoCircuitosMesas = (new ConteoCircuitosMesas())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarContadores()
    {
        $this->emit('electoresVotantes.parametrosActualizados', [
            'categorias'    => $this->conteoElectores['categorias'],
            'valores'       => $this->conteoElectores['valores']
        ]);

        $this->emit('circuitosMesas.parametrosActualizados', [
            'categorias'    => $this->conteoCircuitosMesas['categorias'],
            'valores'       => $this->conteoCircuitosMesas['valores']
        ]);
    }

    private function actualizarGrafico($idSeccion = null)
    {
        $this->emit('graficoElectores.parametrosActualizados', [
            'categorias'    => $this->conteoElectoresGrafico['categorias'],
            'valores'       => $this->conteoElectoresGrafico['valores'],
            'colores'   =>  $this->conteoElectoresGrafico['colores'],
        ]);
    }

    public function buscarMunicipiosQueResaltar()
    {
        return Electores::join('distritos', 'electores.distrito_id', '=', 'distritos.id')
            ->select('distritos.id')
            ->groupBy('distritos.id')
            ->get()
            ->map(function ($distrito) {
                return $distrito->id;
            })
            ->toArray();
    }
}
