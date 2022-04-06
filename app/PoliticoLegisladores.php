<?php

namespace App\Http\Livewire;

use App\Bloque;
use App\Conteo\ConteoDeBloqueLegisladoresDiputados;
use App\Conteo\ConteoDeBloqueLegisladoresSenadores;
use App\Conteo\ConteoDeBloqueLegisladores;
use App\Legisladores;
use App\Distrito;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PoliticoLegisladores extends Component
{
    public $vista;
    public $TODOS_LOS_BLOQUES = "todos";
    public $BLOQUES_EN_EL_TOP = 3;

    public $bloquesEnTop;
    public $conteoPorBloquesSenadores;
    public $conteoPorBloquesDiputados;
    public $conteoPorBloquesLegisladores;
    public $distrito = NULL;
    public $seccion = NULL;

    protected $listeners = [
        'clickEnMunicipio',
        'clickEnSeccion',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio',
        'clickEnTodosLosMunicipios'     => 'mostrarTodosLosBloques',
        'clickEnTodasLasSecciones'      => 'mostrarTodosLosBloques',
        'clickEnRestaurar'              => 'mostrarTodosLosBloques'
    ];

    public function mount()
    {
        $this->vista = 'tablero';
        $this->cargarDatosDeTablero();
    }

    public function render()
    {
        $this->bloquesEnTop  = $this->bloquesTop($this->distrito, $this->BLOQUES_EN_EL_TOP, $this->seccion);
        return view('livewire.politico-legisladores');
    }

    public function verDetalles()
    {
        $this->vista = 'legisladores';
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->cargarDatosDeTablero(['idMunicipio' => $this->distrito]);
        $this->actualizarTablero();
    }

    public function clickEnMunicipio($distrito)
    {
        $this->distrito = $distrito;
        $this->seccion = null;
        $this->emit('municipioActualizado', $distrito);
        $this->cargarDatosDeTablero(['idMunicipio' => $distrito]);
        $this->actualizarTablero();
    }

    public function clickEnSeccion($seccion)
    {
        $this->distrito = NULL;
        $this->seccion = $seccion;
        $this->emit('seccionActualizada', $seccion);
        $this->cargarDatosDeTablero(['idSeccion' => $seccion]);
        $this->actualizarTablero();
    }

    public function mostrarTodosLosBloques()
    {
        $this->distrito = NULL;
        $this->seccion = NULL;
        $this->emit('municipioActualizado', NULL);
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
    }

    private function cargarDatosDeTablero($args = null)
    {
        $this->conteoPorBloquesSenadores = (new ConteoDeBloqueLegisladoresSenadores())
            ->top(2)
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoPorBloquesDiputados = (new ConteoDeBloqueLegisladoresDiputados())
            ->top(2)
            ->cargar($args)
            ->aObjetoSimple();

        $data = [
            0 => $this->conteoPorBloquesSenadores['valores'][0] + $this->conteoPorBloquesDiputados['valores'][0],
            1 => $this->conteoPorBloquesSenadores['valores'][1] + $this->conteoPorBloquesDiputados['valores'][1],
            2 => $this->conteoPorBloquesSenadores['valores'][2] + $this->conteoPorBloquesDiputados['valores'][2],
        ];

        $this->conteoPorBloquesLegisladores = [
            'categorias' => $this->conteoPorBloquesSenadores['categorias'],
            'valores'   =>  $data,
            'colores'   =>  $this->conteoPorBloquesSenadores['colores'],
        ];
    }


    /**
     * Retorna primeros "x" bloques con mas concejales. Si idDistrito != null retorna los bloques
     * pertenecientes al distrito correspondiente.
     */
    private function bloquesTop($idDistrito, $x, $seccion)
    {
        return $this->consultaBloques($idDistrito, $seccion)
            ->orderBy(DB::raw('count(bloques_legislativos.id)'), 'desc')
            ->limit($x)
            ->get();
    }

    private function consultaBloques($idDistrito, $seccion)
    {
        $consulta = Legisladores::leftJoin('bloques_legislativos', 'legisladores.bloque_leg_id', '=', 'bloques_legislativos.id')
            ->select('bloques_legislativos.*', DB::raw('count(bloques_legislativos.id) as concejales'))
            ->where('bloques_legislativos.estado', '=', 'ACTIVO');

        if (!is_null($idDistrito)) {
            $consulta = $consulta->where('legisladores.distrito_id', '=', $idDistrito);
        } else if (!is_null($seccion)) {
            $distritos = Distrito::where('seccion_id', '=', $this->seccion)
                ->select('id')
                ->get();
            $consulta = $consulta->whereIn('legisladores.distrito_id', $distritos);
        }

        return $consulta
            ->groupBy('bloques_legislativos.id');
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarGrafico()
    {
        $data = [
            0 => $this->conteoPorBloquesSenadores['valores'][0] + $this->conteoPorBloquesDiputados['valores'][0],
            1 => $this->conteoPorBloquesSenadores['valores'][1] + $this->conteoPorBloquesDiputados['valores'][1],
            2 => $this->conteoPorBloquesSenadores['valores'][2] + $this->conteoPorBloquesDiputados['valores'][2],
        ];

        $this->conteoPorBloquesLegisladores = [
            'categorias' => $this->conteoPorBloquesSenadores['categorias'],
            'valores'   =>  $data,
            'colores'   =>  $this->conteoPorBloquesSenadores['colores'],
        ];

        $this->emit('graficoBloquesLegisladores.parametrosActualizados', [
            'categorias' =>  $this->conteoPorBloquesLegisladores['categorias'],
            'valores'   =>  $this->conteoPorBloquesLegisladores['valores'],
            'colores'   =>  $this->conteoPorBloquesLegisladores['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('conteoPorBloquesDiputados.parametrosActualizados', [
            'categorias'    => $this->conteoPorBloquesDiputados['categorias'],
            'valores'       => $this->conteoPorBloquesDiputados['valores']
        ]);

        $this->emit('conteoPorBloquesSenadores.parametrosActualizados', [
            'categorias'    => $this->conteoPorBloquesSenadores['categorias'],
            'valores'       => $this->conteoPorBloquesSenadores['valores']
        ]);
    }
}
