<?php

namespace App\Http\Livewire;

use App\Conteo\ConteoTribunalesJuzgados;
use App\Conteo\ConteoTribunalesJuzgadosGrafica;
use Livewire\Component;
use Illuminate\Support\Facades\Config;
use App\Sede;
use App\Departamento;
use App\Distrito;

class PoliticoTribunalesJuzgados extends Component
{
    public $vista;

    public $pines;

    public $deptoJudicialId = null;

    public $distritoSeleccionadoId = null;
    public $seccion;
    public $conteoTribunalesJuzgados;
    public $conteoTribunalesJuzgadosGrafica;

    public $sede;
    
    public $listeners = [
        'clickEnMunicipio',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
        'clickEnDepartamento',
        'botonVerDeptoEntero.Click'     => 'verDepartamentoEntero',
        'verSede',
        'clickEnSeccion'
    ];

    public function mount()
    {
        $this->vista = 'tablero';
        $this->cargarDatosTablero();
        $this->pines = Sede::pines();
    }

    public function render()
    {
        return view('livewire.politico-tribunales-juzgados');
    }

    public function verGeneral()
    {
        $this->vista = 'tablero';
        $data = $this->distritoSeleccionadoId ? ['idMunicipio' => $this->distritoSeleccionadoId] : ($this->seccion ? ['idSeccion' => $this->seccion] : null);
        $this->cargarDatosTablero($data);
        $this->actualizarTablero();
    }
    
    public function verDetalles()
    {
        $this->vista = 'sedes';
        $this->dispatchBrowserEvent('clickEnLupita', intval($this->distritoSeleccionadoId));
    }
        /**
     * Se ejecuta cuando uno hace click en el detalle de un item de la tabla
     * "Departamentos".
     */
    public function mostrarMunicipiosDeDepto($deptoId)
    {
        $this->vista = 'sedes';

        // Buscar los IDs de los municipios del dpto judicial seleccionado
        $idsMunicipios = Distrito::
            where('departamento_id', '=', $deptoId)
            ->get()
            ->map(function ($municipio) {
                return $municipio->id;
            })
            ->toArray();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados', $this->obtenerNombreDepartamento($deptoId)]);
        $this->dispatchBrowserEvent('mostrarMunicipios', $idsMunicipios);
    }

    /**
     * Se ejecuta cuando uno hace click en el detalle de un item de la tabla
     * "Departamentos".
     */
    public function clickEnDepartamento($id) {
        $this->vista = 'sedes';

        $this->deptoJudicialId = $id;

        // Mostrar solo los distritos del departamento judicial seleccionado
        $idsMunicipios = Distrito::
            where('departamento_id', '=', $id)
            ->get()
            ->map(function ($municipio) {
                return $municipio->id;
            })
            ->toArray();

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados', $this->obtenerNombreDepartamento($id)]);

        $this->dispatchBrowserEvent('mostrarMunicipios', $idsMunicipios);
    }

    /**
     * Se ejecuta cuando uno hace click en el detalle de un item de la tabla
     * "Sedes".
     */
    public function verSede($sedeId)
    {
        $this->vista = 'sede';
        $this->busqueda = '';

        // Buscar los datos de la sede clickeada
        $sede = Sede::
            join('departamentos', 'sedes.dpto_judicial_id', '=', 'departamentos.id')
            ->select('sedes.*', 'departamentos.nombre as dpto_nombre')
            ->where('sedes.id', '=', $sedeId)
            ->first();

        $this->sede = $sede;

        $this->emit(
            'arbol-navegabilidad.rutaActualizada',
            [
                'Eje Institucional',
                'Judicial',
                'Tribunales y Juzgados',
                $this->obtenerNombreDepartamento($sede->dpto_judicial_id),
                $sede->nombre
            ]
        );

        // Armar ubicacion del pin de la sede
        $coords = [
            'latitud'   =>  $sede->latitud,
            'longitud'  =>  $sede->longitud,
        ];

        // Mostrar pin en el mapa
        $distritoId = $this->sede->distrito_id;
        $this->dispatchBrowserEvent(
            'enfocarCoordenadas',
            [ 'coords' => $coords, 'idMunicipio' => $distritoId ]
        );
    }
    
    public function verDepartamentoEntero()
    {
        $distrito = Distrito::find($this->distritoSeleccionadoId);

        $this->deptoJudicialId = $distrito->departamento_id;

        $this->distritoSeleccionadoId = null;

        $this->emit('deptoJudicialActualizado', $this->deptoJudicialId);
        $this->emit('distritoSeleccionadoActualizado', $this->distritoSeleccionadoId);

        $this->emit(
            'botonVerDeptoEntero.ParametrosActualizados',
            [ 'activado' => false ]
        );

        $this->clickEnDepartamento($distrito->departamento_id);
    }

    public function clickEnTodasLasSecciones() {
        $this->vista = 'tablero';

        $this->deptoJudicialId = null;
        $this->distritoSeleccionadoId = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados']);
        $this->pines = Sede::pines();
        $this->dispatchBrowserEvent('agregarPines');
    }

    public function clickEnTodosLosMunicipios() {
        $this->vista = 'tablero';

        $this->deptoJudicialId = null;
        $this->distritoSeleccionadoId = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados']);
        
        $this->pines = Sede::pines();
        $this->dispatchBrowserEvent('agregarPines');
    }

    public function clickEnMunicipio($distritoId)
    {
        $this->distritoSeleccionadoId = $distritoId;
        $this->dispatchBrowserEvent('clickEnLupita', intval($distritoId));
        $this->cargarDatosTablero(['idMunicipio' => $distritoId]);
        $this->actualizarTablero();
    
        // $this->emit(
        //     'botonVerDeptoEntero.ParametrosActualizados',
        //     [ 'activado' => true ]
        // );

        $nombre = Distrito::find($distritoId)->nombre;

        $this->emit(
            'arbol-navegabilidad.rutaActualizada',
            [
                'Eje Institucional',
                'Judicial',
                'Tribunales y Juzgados',
                'Sedes de ' . ucwords(strtolower($nombre))
            ]
        );
    }

    public function clickEnSeccion($seccion)
    {
        $this->distritoSeleccionadoId = NULL;
        $this->seccion = $seccion;
        $this->emit('seccionActualizada', $seccion);
        $this->cargarDatosTablero(['idSeccion' => $seccion]);
        $this->actualizarTablero();
    }

    public function obtenerNombreDepartamento($id){
        return Departamento::find($id)->nombre;
    }

    public function clickEnRestaurar() {
        $this->vista = 'tablero';

        $this->deptoJudicialId = null;
        $this->distritoSeleccionadoId = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados']);

        $this->dispatchBrowserEvent('mapaListo');
    }

    public function verDepartamentos()
    {
        $this->vista = 'departamentos';

        $this->deptoJudicialId = null;
        $this->emit('deptoJudicialActualizado', $this->deptoJudicialId);
        $this->emit('distritoSeleccionadoActualizado', null);

        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados']);

        $this->dispatchBrowserEvent('mapaListo');
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    public function cargarDatosTablero($args = null)
    {
        $this->conteoTribunalesJuzgados = (new ConteoTribunalesJuzgados())
            ->cargar($args)
            ->aObjetoSimple();
        
        $this->conteoTribunalesJuzgadosGrafica = (new ConteoTribunalesJuzgadosGrafica())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarContadores()
    {
        $this->emit('conteoTribunalesJuzgados.parametrosActualizados', [
            'categorias'    => $this->conteoTribunalesJuzgados['categorias'],
            'valores'       => $this->conteoTribunalesJuzgados['valores']
        ]);
    }

    private function actualizarGrafico()
    {
        $this->emit('agrupamientoGrafico.parametrosActualizados', [
            'categorias'    => $this->conteoTribunalesJuzgadosGrafica['categorias'],
            'valores'       => $this->conteoTribunalesJuzgadosGrafica['valores'],
            'colores'   =>  $this->conteoTribunalesJuzgadosGrafica['colores'],
        ]);
    }
}
