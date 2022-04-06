<?php

namespace App\Http\Livewire;

use App\Distrito;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TablaGenericoNew extends Component
{
    use WithPagination;

    /**
     * Tabla principal de donde se sacaran los datos.
     */
    public $tabla;

    /**
     * Indica si esta tabla tiene joins con otras
     */
    public $joins = [];

    /**
     * Encabezados que aparecen al tope de las columnas de las tablas.
     */
    public $encabezados = [];

    /**
     * Metadatos sobre las columnas. Dicen, por ejemplo, si esta columna
     * representa una imagen, o si su texto debe ser coloreado.
     */
    public $metadatos = [];

    /**
     * Nombres de las columnas/props de donde se sacaran los valores de
     * las celdas de cada fila. Deben corresponderse con los items de
     * $encabezados.
     */
    public $columnas = [];

    /**
     * Indica si todas las filas tienen un boton que emite un evento al
     * hacerle click.
     */
    public $conEvento = false;

    /**
     * Nombre del evento que se emitira.
     */
    public $nombreEvento;

    /**
     * Indica el nombre de la columna/prop de la cual sacar el valor que se
     * emitira con el evento.
     */
    public $columnaEvento;

    /**
     * Indica si la tabla tiene un filtro select
     */
    public $conSelector = false;

    public $selectorArgs;

    public $tablaSelect;
    public $columnaSelect;

    /**
     * Valor del filtro select
     */
    public $opcion;

    /**
     * Indica si el contenido de la tabla deberia filtrarse antes de
     * mostrarla.
     *
     * Este filtro esta pensado para controlarse desde el componente
     * que usa la tabla. Util cuando al hacer click en una fila de
     * una tabla debe mostrarse otra tabla filtrada segun la fila que
     * fue clickeada antes.
     */
    public $conPreFiltrado = false;
    public $columnaPreFiltrado;
    public $valorPreFiltrado;

    /**
     * Indica si la tabla tiene un buscador
     */
    public $conBusqueda = false;
    public $columnaBusqueda;
    public $valorBusqueda;
    public $mensajeBusqueda;

    /**
     * Indica si la tabla escucha los eventos del mapa o no
     */
    public $escucharMapa = false;
    /**
     * Indica que municipio esta visible en el mapa. Puede ser
     * int o null.
     */
    public $municipioMapa;
    /**
     * Indica que seccion esta visible en el mapa. Puede ser
     * int o null.
     */
    public $seccionMapa;

    public $boton = false;
    public $textoBoton;

    /**
     * Columnas segun las cuales se ordenara. Cada item de este arreglo es
     * un arreglo [ columna, sentido ]. El segundo parametro puede ser
     * "asc" o "desc".
     */
    public $ordenarPor = [];

    /**
     * Nombre para la columna que por defecto se llama "Mas Informacion"
     */
    public $labelOpciones;

    /**
     * Paginador con filas que se mostraran.
     */
    private $filas;

    public $eventos = [];

    public function mount(
        $tabla
        , $columnas
        , $evento = null
        , $joins = null
        , $selector = null
        , $preFiltrado = null
        , $buscador = null
        , $escucharMapa = null
        , $boton = null
        , $ordenarPor = null
        , $labelOpciones = null
    )
    {
        $this->tabla = $tabla;
        $this->columnas = $this->agregarPrefijo($tabla, array_keys($columnas));
        $this->getEncabezados_y_Metadatos(array_values($columnas));
        if (!is_null($joins)) {
            $this->joins = $joins;
        } else {
            $this->joins = [];
        }
        if (!is_null($evento)) {
            $this->conEvento = true;
            $this->nombreEvento = $evento['nombre'];
            $this->columnaEvento = $evento['columna'];
        }
        if (!is_null($selector)) {
            $this->conSelector = true;
            $this->selectorArgs = $selector;
            $this->opcion = array_key_exists('valorInicial', $selector)
                ?   $selector['valorInicial']
                :   'todos';
            $this->tablaSelect = $selector['tabla'];
            $this->columnaSelect = preg_replace('/\./', '_', $selector['filtrarPor']);
            array_push($this->eventos, 'selectorActualizado');
        }
        if (!is_null($preFiltrado)) {
            $this->conPreFiltrado = true;
            $this->columnaPreFiltrado = $preFiltrado['columna'];
            if (array_key_exists('evento', $preFiltrado)) {
                $this->eventos[$preFiltrado['evento']] = 'preFiltroActualizado';
            } else if (array_key_exists('valor', $preFiltrado)) {
                $this->valorPreFiltrado = $preFiltrado['valor'];
            } else {
                throw new Exception(
                    'ERROR: preFiltrado necesita el argumento "valor" o el argumento "evento". No pasaste ninguno.'
                );
            }
        }
        if (!is_null($buscador)) {
            $this->conBusqueda = true;
            $this->columnaBusqueda = $buscador['columna'];
            $this->mensajeBusqueda = $buscador['mensaje'];
        }
        if (!is_null($escucharMapa) && $escucharMapa) {
            $this->escucharMapa = true;
            array_push($this->eventos, 'clickEnSeccion');
            array_push($this->eventos, 'clickEnMunicipio');
            array_push($this->eventos, 'clickEnTodasLasSecciones');
            array_push($this->eventos, 'clickEnTodosLosMunicipios');
        }
        if (!is_null($boton)) {
            $this->boton = true;
            $this->textoBoton = $boton;
        }
        if (!is_null($ordenarPor) && count($ordenarPor) > 0) {
            $this->ordenarPor = $ordenarPor;
        }
        if (!is_null($labelOpciones))
        {
            $this->labelOpciones = $labelOpciones;
        }
    }

    public function render()
    {
        $filas = $this->consulta($this->tabla, $this->joins);
        return view('livewire.tabla-generica', [ 'filas' => $filas ]);
    }

    public function emitir($valor)
    {
        $this->emit($this->nombreEvento, $valor);
    }

    public function selectorActualizado($valor) {
        $this->opcion = $valor;
        $this->resetPage();
    }

    public function preFiltroActualizado($valor) {
        $this->valorPreFiltrado = $valor;
        $this->resetPage();
    }

    public function clickEnSeccion($id) {
        $this->municipioMapa = null;
        $this->seccionMapa = $id;
        $this->resetPage();
    }

    public function clickEnMunicipio($id) {
        $this->municipioMapa = $id;
        $this->seccionMapa = null;
        $this->resetPage();
    }

    public function clickEnTodasLasSecciones() {
        $this->municipioMapa = null;
        $this->seccionMapa = null;
        $this->resetPage();
    }

    public function clickEnTodosLosMunicipios() {
        $this->municipioMapa = null;
        $this->seccionMapa = null;
        $this->resetPage();
    }

    public function clickBoton() {
        $this->emit('clickBotonTabla' . ucwords($this->tabla));
    }

    protected function getListeners() {
        return $this->eventos;
    }

    private function consulta($tabla, $joins) {
        $consulta = DB::table($tabla)->select($tabla . '.*');

        foreach ($joins as $tablaUnida => $claveYcolumnas) {
            $clave = $claveYcolumnas[0];
            $columnas = $claveYcolumnas[1];

            $consulta->leftJoin(
                $tablaUnida,
                $tabla . '.' . $clave,
                '=',
                $tablaUnida . '.' . 'id'
            );

            foreach ($columnas as $columna) {
                $consulta->addSelect(
                    $tablaUnida . '.' . $columna . ' as ' . $tablaUnida . '_' . $columna
                );
            }
        }

        if ($this->conSelector && $this->opcion != 'todos') {
            $consulta = $this->igualar(
                $consulta
                , $this->columnaSelect
                , $this->opcion
            );
        }

        if ($this->conPreFiltrado && !is_null($this->valorPreFiltrado)) {
            $consulta = $this->igualar(
                $consulta
                , $this->columnaPreFiltrado
                , $this->valorPreFiltrado
            );
        }

        if ($this->conBusqueda && !is_null($this->valorBusqueda)) {
            $consulta = $this->like(
                $consulta
                , $this->columnaBusqueda
                , $this->valorBusqueda
            );
        }

        if ($this->escucharMapa) {
            if (!is_null($this->municipioMapa)) {
                if ($this->tabla == 'distritos' ){
                    $consulta->where(
                        $this->tabla . '.id'
                        , '='
                        , $this->municipioMapa
                    );
                }else {
                    $consulta->where(
                        $this->tabla . '.distrito_id'
                        , '='
                        , $this->municipioMapa
                    );
                }

            } else if (!is_null($this->seccionMapa)) {
                if ($this->tabla == 'distritos' ){
                    $distritos = Distrito::
                    where('seccion_id', '=', $this->seccionMapa)
                    ->select('id')
                    ->get();

                    $consulta->whereIn($this->tabla . '.id', $distritos);
                }else{
                    $distritos = Distrito::
                    where('seccion_id', '=', $this->seccionMapa)
                    ->select('id')
                    ->get();

                    $consulta->whereIn($this->tabla . '.distrito_id', $distritos);
                }

            }
        }

        if (count($this->ordenarPor) > 0) {
            foreach ($this->ordenarPor as $orden) {
                if (count($orden) == 2) {
                    $columna = $orden[0];
                    $sentido = $orden[1];
                    if ($sentido != 'asc' && $sentido != 'desc') {
                        throw new Exception('ERROR: el segundo elemento de ordenarPor debe ser "asc" o "desc"');
                    }
                    $consulta->orderBy($columna, $sentido)->whereNotNull($columna);
                } else {
                    $consulta->orderBy($columna, 'asc')->whereNotNull($columna);
                }
            }
        }

        return $consulta->simplePaginate(Config::get('tablas.paginado.items_por_pagina'));
    }

    private function agregarPrefijo($tabla, $columnas) {
        return array_map(
            function ($columna) use ($tabla) {
                return preg_replace('/\./', '_', $columna);
            },
            $columnas
        );
    }

    /**
     * Reemplaza un punto (.) en una cadena por un guion bajo (_).
     *
     * Sirve para convertir un acceso a una columna de un join
     * como "tabla.columna" en "tabla_columna".
     */
    private function reemplazarPunto($cadena) {
        return preg_replace('/\./', '_', $cadena);
    }

    private function igualar($consulta, $columna, $valor) {
        if (preg_match('/\./', $columna) == 1) {
            return $consulta->having($this->reemplazarPunto($columna), '=', $valor);
        } else {
            return $consulta->where($this->tabla . '.' . $columna, '=', $valor);
        }
    }

    private function like($consulta, $columna, $valor) {
        if (preg_match('/\./', $columna) == 1) {
            return $consulta->having($this->reemplazarPunto($columna), 'LIKE', "%" . $valor  . "%");
        } else {
            return $consulta->where($this->tabla . '.' . $columna, 'LIKE', "%" . $valor  . "%");
        }
    }

    /**
     * Genera el arreglo de encabezados y metadatos de las columnas
     *
     * Los metadatos se usan en caso de que una columna no contenga
     * texto sino una imagen, o que tenga que tener texto de un color.
     */
    private function getEncabezados_y_Metadatos($encabezadosYmetadatos)
    {
        for ($i=0; $i < count($encabezadosYmetadatos); $i++) {
            $item = $encabezadosYmetadatos[$i];

            if (gettype($item) == 'string')
            {
                array_push($this->encabezados, $item);
                array_push($this->metadatos, null);
            } else {
                array_push($this->encabezados, $item['encabezado']);
                array_push($this->metadatos, $this->formatearAccesoDeColumnas($item));
            }
        }
    }

    /**
     * Recorre todos los metadatos y formatea aquellos que tengan campos que accedan a una
     * columna.
     *
     * Seran formateados todos los parametros de metadato cuyo nombre arranque con "columna".
     */
    private function formatearAccesoDeColumnas($meta)
    {
        foreach ($meta as $clave => $valor) {
            if ($clave != 'tipo')
            {
                if (preg_match('/^columna/', $clave) == 1)
                {
                    $meta[$clave] = $this->reemplazarPunto($valor);
                }
            }
        }

        return $meta;
    }
}
