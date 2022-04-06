<?php

namespace App\Http\Livewire;

use App\TipoAsentamientos;
use App\Asentamientos;
use App\Conteo\ConteoViviendaAsentamiento;
use App\Conteo\ConteoViviendaAsentamiento2;
use App\Conteo\ConteoViviendaAsentamientoGrafico;
use App\Distrito;
use Livewire\Component;

class ViviendaAsentamiento extends Component
{
    public $vista;
    public $pines;
    public $conteoPorTipoAsentamiento;
    public $conteoPorTipoAsentamiento2;
    public $conteoPorTipoAsentamientoGrafico;
    public $idMunicipio;
    public $idSeccion;
    public $asentamiento;

    protected $listeners = [
        'clickEnAsentamiento',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        'clickEnRestaurar'          => 'restaurarMapa',
    ];

    public function mount()
    {
        $this->vista = 'tablero';
        $this->cargarDatosTablero();
        $this->pines = Asentamientos::pines();
    }

    public function clickEnAsentamiento($id)
    {
        $this->vista = 'detalle';
        $this->asentamiento = Asentamientos::find($id);

        $coords = [
            'latitud'   =>  $this->asentamiento->latitud,
            'longitud'  =>  $this->asentamiento->longitud,
        ];

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Asentamientos', $this->asentamiento->nombre]);

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            ['coords' => $coords, 'idMunicipio' => $this->asentamiento->distrito_id]
        );
    }

    public function verTabla()
    {
        $this->vista = 'tablero';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Vivienda', 'Asentamientos']);
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        } else if ($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        } else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }

    public function render()
    {
        return view('livewire.vivienda-asentamiento');
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
        $this->idSeccion = null;
        $this->cargarDatosTablero(['idMunicipio' => $idMunicipio]);
        $this->actualizarTablero();
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
    }

    public function clickEnSeccion($id)
    {
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->cargarDatosTablero(['idSeccion' => $id]);
        $this->actualizarTablero();
    }

    public function restaurarMapa()
    {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->actualizarTablero();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoPorTipoAsentamiento = (new ConteoViviendaAsentamiento())
            ->cargar($args)
            ->aObjetoSimple();
            
        $this->conteoPorTipoAsentamiento2 = (new ConteoViviendaAsentamiento2())
            ->cargar($args)
            ->aObjetoSimple();
        
        $this->conteoPorTipoAsentamientoGrafico = (new ConteoViviendaAsentamientoGrafico())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarGrafico()
    {
        $this->emit('contadoresporTipoAsentamientoGrafico.parametrosActualizados', [
            'categorias' =>  $this->conteoPorTipoAsentamientoGrafico['categorias'],
            'valores'   =>  $this->conteoPorTipoAsentamientoGrafico['valores'],
            'colores'   =>  $this->conteoPorTipoAsentamientoGrafico['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresporTipoAsentamiento.parametrosActualizados', [
            'categorias'    => $this->conteoPorTipoAsentamiento['categorias'],
            'valores'       => $this->conteoPorTipoAsentamiento['valores']
        ]);
        
        $this->emit('contadoresporTipoAsentamiento2.parametrosActualizados', [
            'categorias'    => $this->conteoPorTipoAsentamiento2['categorias'],
            'valores'       => $this->conteoPorTipoAsentamiento2['valores']
        ]);
    }

    public function verGeneral()
    {
        $this->vista = 'general';
    }
}
