<?php

namespace App\Http\Livewire;

use App\ConcejoDeliberante;
use App\Distrito;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListaConcejales extends Component
{
    use WithPagination;

    private $CONCEJALES_VISIBLES = 6;
    private $concejales;
    
    public $bloque = 'todos';
    public $distrito = null;
    public $seccion = null;
    public $autoridad = null;
    public $bloques;

    protected $listeners = [
        'municipioActualizado',
        'seccionActualizada',
        'selectorClickeado'
    ];

    public function mount($distrito, $seccion)
    {
        $this->distrito = $distrito;
        $this->seccion = $seccion;
    }

    public function render()
    {
        $this->concejales = $this->cargarConcejales($this->bloque, $this->distrito, $this->seccion);
        $this->bloques = $this->bloques($this->distrito, $this->seccion);
        return view(
            'livewire.lista-concejales',
            [
                'concejales' => $this->concejales
            ]
        );
    }

    
    public function municipioActualizado($municipio) {
        $this->distrito = $municipio;
        $this->seccion = null;
        $this->bloque = 'todos';
        $this->resetearPagina();
    }

    public function seccionActualizada($seccion) {
        $this->distrito = null;
        $this->seccion = $seccion;
        $this->bloque = 'todos';
        $this->resetearPagina();
    }

    private function cargarConcejales($bloque, $distrito, $seccion) {
        $consulta = ConcejoDeliberante::
            leftJoin('bloques', 'bloques.id', '=', 'concejo_deliberantes.bloque_id')
            ->select(
                'concejo_deliberantes.*',
                'bloques.nombre as bloque_nombre',
                'bloques.color as bloque_color'
            );
        
        $consulta = $bloque == 'todos'
            ? $consulta
            : $consulta->where('concejo_deliberantes.bloque_id', '=', $bloque);
        
        if ($this->autoridad != null)
        {
            $consulta = $consulta->where('concejo_deliberantes.cargo_id', '=', $this->autoridad);
        }
        
        if (!is_null($distrito)) {
            $consulta = $consulta->where('concejo_deliberantes.distrito_id', '=', $distrito);
        } else if (!is_null($seccion)) {
            $distritos = Distrito::
                where('seccion_id', '=', $this->seccion)
                ->select('id')
                ->get();
            $consulta = $consulta->whereIn('concejo_deliberantes.distrito_id', $distritos);
        }

        return $consulta->paginate($this->CONCEJALES_VISIBLES);
    }

    /**
     * Retorna los bloques ordenados por nombre. Si idDistrito != null devuelve solo
     * los bloques de ese distrito.
     */
    private function bloques($distrito, $seccion) {
        return $this->consultaBloques($distrito, $seccion)
            ->orderBy('bloques.nombre')
            ->get();
    }

    private function consultaBloques($distrito, $seccion) {
        $consulta = ConcejoDeliberante::
            leftJoin('bloques', 'concejo_deliberantes.bloque_id', '=', 'bloques.id')
            ->select('bloques.*', DB::raw('count(bloques.id) as concejales'))
            ->where('bloques.estado', '=', 'ACTIVO');
    
        if (!is_null($distrito)) {
            $consulta = $consulta->where('concejo_deliberantes.distrito_id', '=', $distrito);
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

    public function selectorClickeado($valor)
    {
        if ($valor == 'todos')
        {
            $this->autoridad = null;
        } else
        {
            $this->autoridad = $valor;
        }
    }

    public function resetearPagina()
    {
        $this->resetPage();
    }
}
