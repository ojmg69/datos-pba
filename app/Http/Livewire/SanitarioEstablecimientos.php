<?php

namespace App\Http\Livewire;

use App\EstablecimientoSanitario;
use App\CategoriaEstablecimiento;
use App\TipoEstablecimiento;
use App\Conteo\ConteoTipoSanitario;
use App\Conteo\ConteoCategoriaSanitario;
use App\Distrito;
use App\Seccion;
use Livewire\Component;

class SanitarioEstablecimientos extends Component
{
    public $vista;
    public $pines;
    public $establecimiento;
    public $referencias;
    public $conteoPorTipo;
    public $conteoPorCategoria;
    public $idSeccion;
    public $idMunicipio;

    protected $listeners = [
        'clickEnEstablecimiento',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        'clickEnRestaurar'          => 'restaurarMapa',
        'selectorClickeado'
    ];

    public function mount()
    {
        $this->pines = EstablecimientoSanitario::pinesAgrupadosPorColumnaConConsulta(
            EstablecimientoSanitario::join('categorias_establecimientos', 'establecimientos_sanitarios.categorias_establecimientos_id', '=', 'categorias_establecimientos.id'),
            "categorias_establecimientos_id",
            true
        );
        $this->cargarDatosTablero();
        $this->vista = 'tablero';
        $this->referencias = CategoriaEstablecimiento::referencias();
    }

    public function render()
    {
        return view('livewire.sanitario-establecimientos');
    }

    public function verTabla()
    {
        $this->vista = 'general';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Establecimientos Sanitarios']);
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        }else if($this->idSeccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->idSeccion));
        }else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }

    public function clickEnEstablecimiento($id)
    {
        $this->vista = 'detalle';
        $this->establecimiento = EstablecimientoSanitario::find($id);
        $this->cargarDatosTablero(['idMunicipio' => $this->establecimiento->distrito->id]);
        $nombreDistrito = $this->establecimiento->distrito->nombre;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Establecimientos Sanitarios', $nombreDistrito]);
        $coords = [
            'latitud'   =>  $this->establecimiento->latitud,
            'longitud'  =>  $this->establecimiento->longitud,
        ];

        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            ['coords' => $coords, 'idMunicipio' => $this->establecimiento->distrito_id]
        );
    }

    public function clickEnMunicipio($id)
    {
        $this->idMunicipio = $id;
        $this->idSeccion = null;
        $this->cargarDatosTablero(['idMunicipio' => $this->idMunicipio]);
        $this->actualizarTablero();
        $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Establecimientos Sanitarios', Distrito::find($this->idMunicipio)->nombre]);
    }

    public function clickEnSeccion($id)
    {        
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->cargarDatosTablero(['idSeccion' => $this->idSeccion]);
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Establecimientos Sanitarios', Seccion::find($this->idSeccion)->nombre]);
    }

    public function restaurarMapa()
    {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->pines = EstablecimientoSanitario::pinesAgrupadosPorColumnaConConsulta(
            EstablecimientoSanitario::join('categorias_establecimientos', 'establecimientos_sanitarios.categorias_establecimientos_id', '=', 'categorias_establecimientos.id'),
            "categorias_establecimientos_id",
            true
        );
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
        $this->cargarDatosTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Establecimientos Sanitarios']);
    }

    public function selectorClickeado($idCategoriaEstablecimiento)
    {
        if ($idCategoriaEstablecimiento == 'todos') {
            $pines = EstablecimientoSanitario::pinesAgrupadosPorColumnaConConsulta(
                EstablecimientoSanitario::join('categorias_establecimientos', 'establecimientos_sanitarios.categorias_establecimientos_id', '=', 'categorias_establecimientos.id'),
                "categorias_establecimientos_id",
                true
            );
        } else {
            $pines = EstablecimientoSanitario::pinesAgrupadosPorColumnaConConsulta(
                EstablecimientoSanitario::join('categorias_establecimientos', 'establecimientos_sanitarios.categorias_establecimientos_id', '=', 'categorias_establecimientos.id')
                    ->where('categorias_establecimientos.id', '=', $idCategoriaEstablecimiento),
                "categorias_establecimientos_id",
                true
            );
        }

        $this->dispatchBrowserEvent('pinesActualizados', $pines);
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->actualizarTablero();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoPorTipo = (new ConteoTipoSanitario())
            ->top(3)
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoPorCategoria = (new ConteoCategoriaSanitario())
            ->top(4)
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
        $this->emit('graficoPorCategoria.parametrosActualizados', [
            'categorias' =>  $this->conteoPorCategoria['categorias'],
            'valores'   =>  $this->conteoPorCategoria['valores'],
            'colores'   =>  $this->conteoPorCategoria['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresporTipoEstablecimiento.parametrosActualizados', [
            'categorias'    => $this->conteoPorTipo['categorias'],
            'valores'       => $this->conteoPorTipo['valores']
        ]);

        $this->emit('contadoresPorCategoria.parametrosActualizados', [
            'categorias'    => $this->conteoPorCategoria['categorias'],
            'valores'       => $this->conteoPorCategoria['valores']
        ]);
    }

    public function verGeneral()
    {
        $this->vista = 'general';
        $data = $this->idMunicipio ? ['idMunicipio' => $this->idMunicipio] : ($this->idSeccion ? ['idSeccion' => $this->idSeccion] : null);
        $this->cargarDatosTablero($data);
    }
}
