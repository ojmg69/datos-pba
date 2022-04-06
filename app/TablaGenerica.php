<?php

namespace App\Http\Livewire;

use App\Distrito;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TablaGenerica extends Component
{
    use WithPagination;
    use ConParametros;

    public $debug = false;
    public $cantidadFilas = 0;
    public $consultaSql = '';

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

    public $botonTablaArgs = null;

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
    public $preFiltrado = [
        'activado'                      => false,
        'columna'                       => null,
        'valor'                         => null,
        'desactivarAlEnfocar'           => false,
        'resetearMunicipioAlActualizar' => false,
    ];

    public $preFiltradoDos = [
        'activado'                      => false,
        'columna'                       => null,
        'valor'                         => null,
        'desactivarAlEnfocar'           => false,
        'resetearMunicipioAlActualizar' => false,
    ];

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
    public $eventoBoton;
    public $resetPageBoton = false;

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
        , $debug = false
        , $columnas
        , $evento = null
        , $joins = null

        /**
         * Parametro (opcional)
         * 
         * Agrega un selector que filtra la tabla cunado el usario selecciona
         * un valor. Es un mapa con los parametros de configuracion del selector,
         * consultar Selector.php para ver su documentacion.
         * 
         * Tipo: mapa de parametros
         */
        , $selector = null

        /**
         * Parametro (opcional)
         * 
         * Permite filtrar las filas de la tabla por el valor de una de sus
         * columnas. Esto ocurre antes de que se apliquen otros filtros como
         * la busqueda o el selector.
         * 
         * Tipo: mapa con los siguientes campos
         *      
         *      columna => string: Indica la columna por la cual se filtrara.
         * 
         *      evento => string: El evento que cambia el valor que se usara
         *      para el filtrado. Permite actualizar el valor de comparacion
         *      emitiendo un evento.
         * 
         *      valor => number | string => valor estatico que se usara para
         *      el filtrado. Solo se usa si no se especifica un evento.
         */
        , $preFiltrado = null
        , $preFiltradoDos = null
        , $buscador = null
        , $escucharMapa = null
        , $boton = null
        , $ordenarPor = null
        , $labelOpciones = null

        /**
         * Parametro (opcional)
         * 
         * Agrega una instancia de BotonTabla a la tabla. Este param puede
         * ser el sucesor del param "boton". Ver sus parametros en la clase
         * BotonTabla.
         */
        , $botonTabla = null
        , $seccionMapa = null
        , $municipioMapa = null
    )
    {
        $this->tabla = $tabla;
        $this->debug = $debug;
        $this->seccionMapa = $seccionMapa;
        $this->municipioMapa = $municipioMapa;
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
    
        if ($selector != null) $this->leerParamSelector($selector);
        $this->leerParamPrefiltrado($preFiltrado);
        $this->leerParamPrefiltradoDos($preFiltradoDos);
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
        $this->leerParamBoton($boton);
        if (!is_null($ordenarPor) && count($ordenarPor) > 0) {
            $this->ordenarPor = $ordenarPor;
        }
        if (!is_null($labelOpciones))
        {
            $this->labelOpciones = $labelOpciones;
        }
        $this->leerParamBotonTabla($botonTabla);

        $this->eventos['TablaGenerica.ResetearPagina'] = 'resetearPagina';
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
        $this->preFiltrado['valor'] = $valor;

        if ($this->preFiltrado['resetearMunicipioAlActualizar'])
            $this->municipioMapa = null;

        $this->resetPage();
    }

    public function preFiltroDosActualizado($valor) {
        $this->preFiltradoDos['valor'] = $valor;

        if ($this->preFiltradoDos['resetearMunicipioAlActualizar'])
            $this->municipioMapa = null;

        $this->resetPage();
    }

    public function clickEnSeccion($id) {
        $this->municipioMapa = null;
        $this->seccionMapa = $id;
        $this->resetPage();

        if ($this->preFiltrado['desactivarAlEnfocar'])
        {
            $this->preFiltrado['activado'] = false;
        }
    }

    public function clickEnMunicipio($id) {
        $this->municipioMapa = $id;
        $this->seccionMapa = null;
        $this->resetPage();

        if ($this->preFiltrado['desactivarAlEnfocar'])
        {
            $this->preFiltrado['activado'] = false;
        }
    }

    public function clickEnTodasLasSecciones() {
        $this->municipioMapa = null;
        $this->seccionMapa = null;
        $this->resetPage();

        if ($this->preFiltrado['desactivarAlEnfocar'])
        {
            $this->preFiltrado['activado'] = false;
        }
    }

    public function clickEnTodosLosMunicipios() {
        $this->municipioMapa = null;
        $this->seccionMapa = null;
        $this->resetPage();

        if ($this->preFiltrado['desactivarAlEnfocar'])
        {
            $this->preFiltrado['activado'] = false;
        }
    }

    public function clickBoton() {
        if ($this->resetPageBoton) $this->resetPage();
        $this->emit($this->eventoBoton);
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

        if ($this->preFiltrado['activado'] && !is_null($this->preFiltrado['valor'])) {
            $consulta = $this->igualar(
                $consulta
                , $this->preFiltrado['columna']
                , $this->preFiltrado['valor']
            );
        }

        if ($this->preFiltradoDos['activado'] && !is_null($this->preFiltradoDos['valor'])) {
            $consulta = $this->igualar(
                $consulta
                , $this->preFiltradoDos['columna']
                , $this->preFiltradoDos['valor']
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
            if ($this->municipioMapa != null) {
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

        if ($this->debug)
        {
            $this->cantidadFilas = (clone $consulta)->get()->count();
            $this->consultaSql = TablaGenerica::ConsultaConParametros($consulta);
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

    private function leerParamBoton($boton)
    {
        if ($boton != null) {
            $this->boton = true;

            if (is_array($boton))
            {
                $this->textoBoton = $boton['nombre'];
                $this->eventoBoton = $boton['evento'];
                if (array_key_exists('resetPage', $boton))
                {
                    $this->resetPageBoton = $boton['resetPage'];
                }
            } else
            {
                $this->textoBoton = $boton;
                $this->eventoBoton = 'clickBotonTabla' . ucwords($this->tabla);
            }
        }
    }

    private function leerParamSelector($selector)
    {
    
        $this->conSelector = true;

        $this->selectorArgs = array_merge(
            Selector::ParametrosNulos(),
            $selector
        );
        
        $this->opcion = array_key_exists('valorInicial', $selector)
            ?   $selector['valorInicial']
            :   'todos';

        
        $this->tablaSelect = $selector['porTabla']['tabla'];

        $this->columnaSelect = preg_replace('/\./', '_', $selector['filtrarPor']);

        $eventoDelSelector = array_key_exists('nombre', $selector)
            ? Selector::NombreDeEventos($selector['nombre'])
            : Selector::NombreDeEventos(null);
        $this->eventos[$eventoDelSelector[0]] = 'selectorActualizado';
    }

    private function leerParamPrefiltrado($preFiltrado)
    {
        if (!is_null($preFiltrado)) {
            $this->preFiltrado['activado'] = true;
            $this->preFiltrado['columna'] = $preFiltrado['columna'];

            if (array_key_exists('desactivarAlEnfocar', $preFiltrado))
            {
                $this->preFiltrado['desactivarAlEnfocar'] = $preFiltrado['desactivarAlEnfocar'];
            }

            $conEvento = array_key_exists('evento', $preFiltrado);
            $conValor = array_key_exists('valor', $preFiltrado);

            if (!$conEvento && !$conValor)
                throw new Exception(
                    'ERROR: preFiltrado necesita el argumento "valor" o el argumento "evento". No pasaste ninguno.'
                );
            
            if ($conValor)
                $this->preFiltrado['valor'] = $preFiltrado['valor'];

            if ($conEvento)
                $this->eventos[$preFiltrado['evento']] = 'preFiltroActualizado';
            
            if (array_key_exists('resetearMunicipioAlActualizar', $preFiltrado))
                $this->preFiltrado['resetearMunicipioAlActualizar'] =
                    $preFiltrado['resetearMunicipioAlActualizar'];
        }
    }

    private function leerParamPrefiltradoDos($preFiltradoDos)
    {
        if (!is_null($preFiltradoDos)) {
            $this->preFiltradoDos['activado'] = true;
            $this->preFiltradoDos['columna'] = $preFiltradoDos['columna'];

            if (array_key_exists('desactivarAlEnfocar', $preFiltradoDos))
            {
                $this->preFiltradoDos['desactivarAlEnfocar'] = $preFiltradoDos['desactivarAlEnfocar'];
            }

            $conEvento = array_key_exists('evento', $preFiltradoDos);
            $conValor = array_key_exists('valor', $preFiltradoDos);

            if (!$conEvento && !$conValor)
                throw new Exception(
                    'ERROR: preFiltradoDos necesita el argumento "valor" o el argumento "evento". No pasaste ninguno.'
                );
            
            if ($conValor)
                $this->preFiltradoDos['valor'] = $preFiltradoDos['valor'];

            if ($conEvento)
                $this->eventos[$preFiltradoDos['evento']] = 'preFiltroDosActualizado';
            
            if (array_key_exists('resetearMunicipioAlActualizar', $preFiltradoDos))
                $this->preFiltradoDos['resetearMunicipioAlActualizar'] =
                    $preFiltradoDos['resetearMunicipioAlActualizar'];
        }
    }

    private function leerParamBotonTabla($botonTabla)
    {
        if ($botonTabla != null)
        {
            $this->botonTablaArgs = array_merge(
                BotonTabla::ParametrosNulos(),
                $botonTabla
            );
        }
    }

    public function resetearPagina()
    {
        $this->resetPage();
    }

    /**
     * Combines SQL and its bindings.
     * 
     * Tomado de: https://stackoverflow.com/questions/20045732/how-can-i-get-the-raw-query-string-from-laravels-query-builder-before-executing
     *
     * @param \Eloquent $query
     * @return string
     */
    public static function ConsultaConParametros($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            $binding = addslashes($binding);
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }
}
