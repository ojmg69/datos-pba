<?php

namespace App\Http\Livewire;

use App\Conteo\ConteoCircuitosMesas;
use App\Conteo\ConteoElectores;
use App\Conteo\ConteoElectoresGrafica;
use App\Electores;
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

    public $validado;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones',
        'clickEnTodosLosMunicipios',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio'
    ];

    public function mount()
    {
        $this->vista = "tablero";
        $this->cargarDatosTablero();
        $this->actualizarTablero();
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }

    public function render()
    {
        return view('livewire.electoral-electores-inscriptos');
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->cargarDatosTablero(['idMunicipio' => $this->idMunicipio]);
        $this->actualizarTablero();
    }

    public function verDetalles($id)
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

    public function clickEnTodosLosMunicipios()
    {
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
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
