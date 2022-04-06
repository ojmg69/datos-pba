<?php

namespace App\Http\Livewire;

use App\Pyme;
use App\AgrupamientoIndustrial;
use App\Conteo\ConteoAgrupamientosNumero;
use App\Conteo\ConteoAgrupamientosTipo;
use App\Conteo\ConteoAgrupamientosTipoGrafica;
use Livewire\Component;

class ProductivoAgrupamientosIndustriales extends Component
{
    public $vista;
    public $pines;
    public $seccion;
    public $idDistritoSeleccionado;
    public $conteoAgrupamientosNumero;
    public $conteoAgrupamientosTipo;
    public $conteoAgrupamientosTipGrafica;

    // Agrupamiento seleccionado o null
    public $agrupamiento;

    // PyME seleccionada o null
    public $pyme;

    protected $listeners = [
        'clickEnAgrupamiento',
        'clickBotonTablaPymes',
        'clickEnPyme',
        'verPyMEs',
        'clickEnTodosLosMunicipios',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
        'verAgrupamientos',
        'clickEnSeccion'
    ];

    public function mount()
    {
        $this->vista = 'tablero';
        // $this->pines = AgrupamientoIndustrial::pines();
        $this->pines = AgrupamientoIndustrial::pinesAgrupadosPorColumnaConConsulta(
            AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id'),
            "tipo",
            true
        );
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function render()
    {
        return view('livewire.productivo-agrupamientos-industriales');
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('agregarPines');
        if ($this->idDistritoSeleccionado) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idDistritoSeleccionado));
        }else if($this->seccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->seccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
        $data = $this->idDistritoSeleccionado ? ['idMunicipio' => $this->idDistritoSeleccionado] : ($this->seccion ? ['idSeccion' => $this->seccion] : null);
        $this->cargarDatosTablero($data);
        $this->actualizarTablero();
    }
    
    public function clickEnMunicipio($idMunicipio)
    {
        $this->idDistritoSeleccionado = $idMunicipio;
        $this->seccion = null;
        $this->pines = AgrupamientoIndustrial::pinesAgrupadosPorColumnaConConsulta(
            AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id'),
            "tipo",
            true
        );
        $this->cargarDatosTablero(['idMunicipio' => $idMunicipio]);
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
        $this->actualizarTablero();
    }

    public function clickEnTodosLosMunicipios()
    {
        $this->idDistritoSeleccionado = null;
        $this->seccion = null;
        $this->pines = AgrupamientoIndustrial::pinesAgrupadosPorColumnaConConsulta(
            AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id'),
            "tipo",
            true
        );
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->idDistritoSeleccionado = null;
        $this->seccion = null;
        $this->pines = AgrupamientoIndustrial::pinesAgrupadosPorColumnaConConsulta(
            AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id'),
            "tipo",
            true
        );
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnSeccion($seccion)
    {
        $this->idDistritoSeleccionado = NULL;
        $this->seccion = $seccion;
        $this->emit('seccionActualizada', $seccion);
        $this->cargarDatosTablero(['idSeccion' => $seccion]);
        $this->actualizarTablero();
    }

    public function clickEnRestaurar()
    {
        $this->idDistritoSeleccionado = null;
        $this->seccion = null;
        $this->pines = AgrupamientoIndustrial::pinesAgrupadosPorColumnaConConsulta(
            AgrupamientoIndustrial::join('agrupamientos_tipo', 'agrupamiento_industriales.tipo', '=', 'agrupamientos_tipo.id'),
            "tipo",
            true
        );
        $this->actualizarTablero();
    }

    public function clickEnAgrupamiento($id)
    {
        $this->agrupamiento = AgrupamientoIndustrial::find($id);

        $this->vista = 'detalle-agrupamiento';

        // Evento para DetalleGenerico
        $this->emit('entidadActualizada', $this->agrupamiento);

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Productivo', 'Agrupamientos Industriales', $this->agrupamiento->nombre]);

        // Enfocar mapa en coordenadas del agrupamiento
        $this->dispatchBrowserEvent('enfocarCoordenadas', [
            'coords' => $this->agrupamiento->pin(),
        ]);
    }

    public function clickBotonTablaPymes()
    {
        $this->clickEnAgrupamiento($this->agrupamiento->id);
    }

    public function verDetalles()
    {
        $this->vista = 'agrupamientos';
    }

    public function clickEnPyme($id)
    {
        $this->vista = 'detalle';
        $this->pyme = Pyme::find($id);

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Productivo', 'Agrupamientos Industriales', $this->agrupamiento->nombre, 'PyMEs', $this->pyme->nombre]);
    }

    public function verPyMEs()
    {
        $this->vista = 'pymes';
        $this->emit('agrupamientoActualizado', $this->agrupamiento->id);

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Productivo', 'Agrupamientos Industriales', $this->agrupamiento->nombre, 'PyMEs']);
    }

    public function verAgrupamientos()
    {
        $this->vista = 'agrupamientos';
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idDistritoSeleccionado) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idDistritoSeleccionado));
        }else if($this->seccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->seccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Productivo', 'Agrupamientos Industriales']);
    }

    public function restaurarMapa()
    {
        $this->vista = 'tablero';
        $this->dispatchBrowserEvent('mapaListo');
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Productivo', 'Agrupamientos Industriales']);
    }

    public function cargarDatosTablero($args = null)
    {
        $this->conteoAgrupamientosNumero = (new ConteoAgrupamientosNumero())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoAgrupamientosTipo = (new ConteoAgrupamientosTipo())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoAgrupamientosTipGrafica = (new ConteoAgrupamientosTipoGrafica())
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
        $this->emit('agrupamientoIndustrialNumero.parametrosActualizados', [
            'categorias'    => $this->conteoAgrupamientosNumero['categorias'],
            'valores'       => $this->conteoAgrupamientosNumero['valores']
        ]);

        $this->emit('agrupamientoIndustrialTipo.parametrosActualizados', [
            'categorias'    => $this->conteoAgrupamientosTipo['categorias'],
            'valores'       => $this->conteoAgrupamientosTipo['valores']
        ]);
    }

    private function actualizarGrafico($idSeccion = null)
    {
        $this->emit('agrupamientoGrafico.parametrosActualizados', [
            'categorias'    => $this->conteoAgrupamientosTipGrafica['categorias'],
            'valores'       => $this->conteoAgrupamientosTipGrafica['valores'],
            'colores'   =>  $this->conteoAgrupamientosTipGrafica['colores'],
        ]);
    }
}
