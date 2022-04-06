<?php

namespace App\Http\Livewire;

use App\Bloque;
use App\Conteo\ConteoDeBloquesHCD;
use App\Conteo\ConteoDeIntendentesPorGenero;
use App\Conteo\ConteoDeConcejalesPorGeneroHCD;
use App\ConcejoDeliberante;
use App\Distrito;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PoliticoConcejodeliberante extends Component
{
    public $vista;

    public $TODOS_LOS_BLOQUES = "todos";
    public $BLOQUES_EN_EL_TOP = 12;

    public $bloquesEnTop;
    public $distrito = NULL;
    public $seccion = NULL;

    public $conteoPorBloques;
    public $conteoPorGenero;

    protected $listeners = [
        'clickEnMunicipio',
        'clickEnSeccion',
        'verDetalleDeMunicipioGuardado' => 'clickEnMunicipio',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
    ];

    public function mount()
    {
        $this->vista = 'tablero';
        $this->cargarDatosDeTablero();
    }

    public function render()
    {
        $this->bloquesEnTop  = $this->bloquesTop($this->distrito, $this->BLOQUES_EN_EL_TOP, $this->seccion);
        return view('livewire.politico-concejodeliberante');
    }

    public function clickEnMunicipio($distrito) {
        $this->distrito = $distrito;
        $this->seccion = null;
        $this->emit('municipioActualizado', $distrito);
        $this->cargarDatosDeTablero([ 'idMunicipio' => $distrito ]);
        $this->actualizarTablero();
    }

    public function clickEnSeccion($seccion) {
        $this->seccion = $seccion;
        $this->distrito = null;
        $this->emit('seccionActualizada', $seccion);
        $this->cargarDatosDeTablero([ 'idSeccion' => $seccion ]);
        $this->actualizarTablero();
    }

    public function clickEnTodosLosMunicipios()
    {
        $this->mostrarTodosLosBloques();
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->mostrarTodosLosBloques();
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
    }

    public function clickEnRestaurar()
    {
        $this->mostrarTodosLosBloques();
        $this->cargarDatosDeTablero();
        $this->actualizarTablero();
    }

    public function mostrarTodosLosBloques() {
        $this->distrito = NULL;
        $this->emit('municipioActualizado', NULL);
    }

    public function verBloque($bloque) {
        $this->emit('bloqueActualizado', $bloque);
    }

    public function verDetalles()
    {
        $this->vista = 'concejales';
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $data = $this->distrito ? [ 'idMunicipio' => $this->distrito ] : ($this->seccion ? [ 'idSeccion' => $this->seccion ] : null);
        $this->cargarDatosDeTablero($data);
        $this->actualizarTablero();
    }

    /**
     * Retorna primeros "x" bloques con mas concejales. Si idDistrito != null retorna los bloques
     * pertenecientes al distrito correspondiente.
     */
    private function bloquesTop($idDistrito, $x, $seccion) {
        return $this->consultaBloques($idDistrito, $seccion)
            ->orderBy(DB::raw('count(bloques.id)'), 'desc')
            ->limit($x)
            ->get();
    }

    private function consultaBloques($idDistrito, $seccion) {
        $consulta = ConcejoDeliberante::
            leftJoin('bloques', 'concejo_deliberantes.bloque_id', '=', 'bloques.id')
            ->select('bloques.*', DB::raw('count(bloques.id) as concejales'))
            ->where('bloques.estado', '=', 'ACTIVO');
    
        if (!is_null($idDistrito)) {
            $consulta = $consulta->where('concejo_deliberantes.distrito_id', '=', $idDistrito);
        } else if (!is_null($seccion)) {
            $distritos = Distrito::
                where('seccion_id', '=', $this->seccion)
                ->select('id')
                ->get();
            $consulta = $consulta->whereIn('concejo_deliberantes.distrito_id', $distritos);
        }

        return $consulta
            ->groupBy('bloques.id');
    }

    private function cargarDatosDeTablero($args = null)
    {
        $this->conteoPorBloques = (new ConteoDeBloquesHCD())
            ->top(2)
            ->cargar($args)
            ->aObjetoSimple();
        
        $this->conteoPorGenero = (new ConteoDeConcejalesPorGeneroHCD())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarGrafico($idSeccion = null)
    {
        $this->emit('graficoBloques.parametrosActualizados', [
            'categorias'=>  $this->conteoPorBloques['categorias'],
            'valores'   =>  $this->conteoPorBloques['valores'],
            'colores'   =>  $this->conteoPorBloques['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresPorBloque.parametrosActualizados', [
            'categorias'    => $this->conteoPorBloques['categorias'],
            'valores'       => $this->conteoPorBloques['valores']
        ]);
        
        $this->emit('contadoresPorGenero.parametrosActualizados', [
            'categorias'    => $this->conteoPorGenero['categorias'],
            'valores'       => $this->conteoPorGenero['valores']
        ]);
    }
}