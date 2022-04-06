<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Intendente;
use App\Seccion;
use App\Distrito;
use App\Partido;
use App\Conteo\ConteoDePartidos;
use App\Conteo\ConteoDeIntendentesPorGenero;

class MunicipioIntendentes extends Component
{
    public $vista;

    public $intendente;

    public $referencias;

    public $idSeccion;

    public $estilos = [];

    public $conteoPorPartidos;
    public $conteoIntendentesPorGenero;

    protected $listeners = [
        'verDetalleDeMunicipioGuardado',
        'clickEnMunicipio' => 'verDetalleDeMunicipioGuardado',
        'verDetalleIntendente',
        'clickEnSeccion',
        'clickEnTodasLasSecciones',
        'clickEnTodosLosMunicipios'
    ];

    public function mount()
    {
        // Inicializacion de la vista
        $this->vista = "tablero";
        $this->cargarDatosDeTablero();

        // Calculo de estilos y referencias del mapa. Tal vez estos
        // metodos no deban estar aqui...

        $distritos = $this->obtenerDistritosIntendentas();
        $this->estilos = $this->estilosDeMunicipios($distritos);
        $this->referencias = $this->obtenerReferencias();
    }

    public function verDetalleIntendente($idIntendente)
    {
        $this->vista = "detalle";
        $this->intendente = Intendente::find($idIntendente);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes', 'Información']);
        $this->dispatchBrowserEvent('clickEnLupita', $this->intendente->distrito_id);
    }

    public function verDetalleDeMunicipioGuardado($idMunicipio)
    {
        $this->vista = "detalle";
        $this->intendente = Distrito::find($idMunicipio)->intendente;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes', 'Información']);
    }

    public function render()
    {
        return view('livewire.municipio-intendentes');
    }

    public function verGeneral()
    {
        $this->vista = 'general';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes']);
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes']);
    }

    public function clickEnSeccion($idSeccion)
    {
        $this->idSeccion = $idSeccion;
        $this->cargarDatosDeTablero($idSeccion);
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes']);
    }

    public function clickEnTodosLosMunicipios()
    {
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Municipios', 'Intendentes']);
    }

    /*************************************************************** */

    private function cargarDatosDeTablero($idSeccion = null)
    {
        $this->conteoPorPartidos = (new ConteoDePartidos())
            ->top(2)
            ->cargar(['idSeccion' => $idSeccion])
            ->aObjetoSimple();

        $this->conteoIntendentesPorGenero = (new ConteoDeIntendentesPorGenero())
            ->cargar(['idSeccion' => $idSeccion])
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarGrafico($idSeccion = null)
    {
        $this->emit('graficoPartidos.parametrosActualizados', [
            'categorias'=>  $this->conteoPorPartidos['categorias'],
            'valores'   =>  $this->conteoPorPartidos['valores'],
            'colores'   =>  $this->conteoPorPartidos['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresPorPartido.parametrosActualizados', [
            'categorias'    => $this->conteoPorPartidos['categorias'],
            'valores'       => $this->conteoPorPartidos['valores']
        ]);

        $this->emit('contadoresPorGenero.parametrosActualizados', [
            'categorias'    => $this->conteoIntendentesPorGenero['categorias'],
            'valores'       => $this->conteoIntendentesPorGenero['valores']
        ]);
    }

    private function obtenerReferencias()
    {
        $resultado = [];
        $partidos = Partido::all();
        foreach ($partidos as $partido) {
            $ref = [
                'nombre'    => $partido->nombre,
                'relleno'   => $partido->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    private function obtenerDistritosIntendentas()
    {
        $resultado = [];
        $intendentes = Intendente::all();
        foreach ($intendentes as $intendente) {
            if($intendente->genero == "femenino")
            {
                array_push($resultado, $intendente->distrito_id);
            }
        }
        return $resultado;
    }

    private function estilosDeMunicipios($distritosConBorde)
    {
        $intendentes = Intendente::join('partidos', 'intendentes.partido_id', '=', 'partidos.id')->get();
        $estilos = [];
        foreach ($intendentes as $intendente) {
            $estilo = [
                'id'        => intval($intendente->distrito_id),
                'relleno'   => $intendente->partido->color
            ];
            if (in_array($intendente->distrito_id, $distritosConBorde)) {
                $estilo['borde'] = "#8E44AD";
                $estilo['bordeGrueso'] = true;
            }
            array_push($estilos, $estilo);
        }
        return $estilos;
    }
}
