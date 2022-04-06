<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Legisladores;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListaLegisladores extends Component
{
    use WithPagination;

    private $LEGISLADORES_VISIBLES = 6;
    private $legisladores;

    public $bloque = 'todos';
    public $distrito = null;
    public $seccion = null;
    public $tipoLegisladores = 'todos';
    public $bloques;
    public $detalles;
    public $detallesLegislador;
    public $distritoLegislador;

    protected $listeners = [
        'municipioActualizado',
        'seccionActualizada',
        'selectorClickeado',
    ];

    public function mount($distrito, $seccion)
    {
        $this->distrito = $distrito;
        $this->seccion = $seccion;
        $this->detalle = false;
    }

    public function verDetalles($legislador)
    {
        $this->detallesLegislador = $legislador;
        $this->distritoLegislador = Distrito::
        where('id','=',$legislador['distrito_id'])
        ->first();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Legislativo', 'Legisladores',$legislador['tipo'] , $legislador['nombre']]);
        $this->detalles = true;
    }

    public function volverListado()
    {
        $this->detalles = false;
        $this->detalleLegislador = null;
        $this->distritoLegislador = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Legislativo', 'Legisladores']);
    }
    public function render()
    {
        $this->legisladores = $this->cargarLegisladores($this->bloque, $this->distrito, $this->seccion, $this->tipoLegisladores);
        $this->bloques = $this->bloques($this->distrito, $this->seccion);
        return view(
            'livewire.lista-legisladores',
            [
                'legisladores' => $this->legisladores
            ]
        );
    }

    public function municipioActualizado($municipio) {
        $this->volverListado();
        $this->distrito = $municipio;
        $this->seccion = null;
        $this->bloque = 'todos';
        $this->resetearPagina();
    }

    public function seccionActualizada($seccion) {
        $this->volverListado();
        $this->distrito = null;
        $this->seccion = $seccion;
        $this->bloque = 'todos';
        $this->resetearPagina();
    }

    public function selectorClickeado($tipoLegisladores) {
        $this->tipoLegisladores = $tipoLegisladores;
        $this->resetearPagina();
    }

    private function cargarLegisladores($bloque, $distrito, $seccion, $tipoLegisladores) {
        $consulta = Legisladores::
            leftJoin('bloques_legislativos', 'bloques_legislativos.id', '=', 'legisladores.bloque_leg_id')
            ->select(
                'legisladores.*',
                'bloques_legislativos.nombre as bloque_nombre',
                'bloques_legislativos.color as bloque_color'
            );

        // Filtrar por bloque
        $consulta = $bloque == 'todos'
            ? $consulta
            : $consulta->where('legisladores.bloque_leg_id', '=', $bloque);


            // Filtrar por tipo de legisladaor
        $consulta = $tipoLegisladores == 'todos'
            ? $consulta
            : $consulta->where('legisladores.tipo', 'LIKE', "%". $tipoLegisladores ."%");

        // Filtrar por distrito o seccion
        if (!is_null($distrito)) {
            $consulta = $consulta->where('legisladores.distrito_id', '=', $distrito);
        } else if (!is_null($seccion)) {
            $distritos = Distrito::
                where('seccion_id', '=', $this->seccion)
                ->select('id')
                ->get();
            $consulta = $consulta->whereIn('legisladores.distrito_id', $distritos);
        }

        return $consulta->paginate($this->LEGISLADORES_VISIBLES);
    }

    /**
     * Retorna los bloques ordenados por nombre. Si idDistrito != null devuelve solo
     * los bloques de ese distrito.
     */
    private function bloques($idDistrito, $seccion) {
        return $this->consultaBloques($idDistrito, $seccion)
            ->orderBy('bloques_legislativos.nombre')
            ->get();
    }

    private function consultaBloques($distrito, $seccion) {
        $consulta = Legisladores::
            leftJoin('bloques_legislativos', 'legisladores.bloque_leg_id', '=', 'bloques_legislativos.id')
            ->select('bloques_legislativos.*', DB::raw('count(bloques_legislativos.id) as concejales'))
            ->where('bloques_legislativos.estado', '=', 'ACTIVO');

        if (!is_null($distrito)) {
            $consulta = $consulta->where('legisladores.distrito_id', '=', $distrito);
        } else if (!is_null($seccion)) {
            $distritos = Distrito::
                where('seccion_id', '=', $this->seccion)
                ->select('id')
                ->get();
            $consulta = $consulta->whereIn('legisladores.distrito_id', $distritos);
        }

        return $consulta
            ->groupBy('bloques_legislativos.id');
    }

    public function resetearPagina()
    {
        $this->resetPage();
    }
}
