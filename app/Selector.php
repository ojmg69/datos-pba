<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Selector extends Component
{
    use ConParametros;

    const TODOS = 'todos';

    public $tabla;
    public $colOpcion;
    public $colValor;
    public $filtrarPor;
    public $todos;

    public $opciones = [];
    public $valores = [];
    public $opcionesPorTabla;

    public $valorActual;
    public $valorInicial;

    /**
     * Nombre del evento que el selector emite cuando su valor
     * cambia por interaccion del usuario.
     */
    public $emitirAlClickear;

    /**
     * Nombre del evento que el selector escucha cuando su valor
     * es cambiado por otro componente.
     */
    public $escuchar;

    public function mount(
        /**
         * Parametro (opcional)
         * 
         * Nombre de este selector. Se usa para diferenciarlo de otros selectores
         * cuando se escuchan sus eventos o cuando se disparan eventos hacia el.
         * 
         * Si no se pasa este parametro el selector emite "selectorClickeado"
         * y escucha "selectorValorModificado". De lo contrario emite
         * "nombre.selectorClickeado" y escucha "nombre.selectorValorModificado".
         * 
         * Tipo: string
         */
        $nombre = null,

        /**
         * Parametro
         * 
         * Parametros para configurar al selector para obtener sus filas desde
         * una tabla en la DB. Recibe un mapa que debe tener los siguientes
         * campos:
         * 
         *      tabla => string: Nombre de la tabla que respalda al selector.
         * 
         *      opciones => string: Nombre de la columna de donde se obtendra el
         *      texto de las filas del selector.
         * 
         *      valores => string: Nombre de la columna de donde se obtendra el
         *      valor de las filas del selector.
         * 
         * NO PUEDE COEXISTIR CON EL PARAMETRO "porValores"
         * 
         * Tipo: Mapa
         */
        $porTabla = null,

        /**
         * Parametro
         * 
         * Parametros para configurar al selector para obtener sus filas desde
         * valores estaticos. Recibe un arreglo de pares [ texto, numero ].
         * Por cada par habra una fila en el selector.
         * 
         * NO PUEDE COEXISTIR CON EL PARAMETRO "porTabla"
         * 
         * Tipo: [string, number][]
         */
        $porValores = null,

        /**
         * Parametro (opcional)
         * 
         * Columna de la tabla que sera comparada con el valor del selector para
         * decidir que filas de la tablas se muestran. Solo se usa si este
         * selector es parte de una tabla. Usado por su cuenta, fuera de una tabla,
         * no tiene efecto.
         * 
         * Tipo: string
         */
        $filtrarPor = null,

        /**
         * Parametro
         * 
         * Texto que se usa para la fila inicial, por defecto, del selector.
         * Dicha fila significa que ninguno de los otros valores esta
         * seleccionado. Cuando se elige esta fila el selector emite el valor
         * "todos".
         * 
         * Tipo: string
         */
        $textoDefecto = null,

        /**
         * Parametro (opcional)
         * 
         * Valor inicial del selector.
         * 
         * Tipo: number
         */
        $valorInicial = null
    ) {
        $this->nombre = $nombre;

        $this->noNulo($textoDefecto, 'textoDefecto');

        $this->soloUno($porTabla, $porValores);

        if ($porTabla != null)
            $this->leerParamPorTabla($porTabla);
        else
            $this->leerParamPorValores($porValores);

        $this->todos = $textoDefecto;
        $this->valorInicial = $valorInicial;
        $this->filtrarPor = $filtrarPor;

        $eventos = Selector::NombreDeEventos($nombre);
        $this->emitirAlClickear = $eventos[0];
        $this->escuchar = $eventos[1];
    }

    public function render()
    {
        if ($this->opcionesPorTabla) {
            $this->opciones = DB::
                table($this->tabla)
                ->select($this->colOpcion)
                ->get()
                ->map(function ($o) { return $o->{ $this->colOpcion }; })
                ->toArray();
            
            $this->valores = DB::
                table($this->tabla)
                ->select($this->colValor)
                ->get()
                ->map(function ($v) { return $v->{ $this->colValor }; })
                ->toArray();
        }

        return view('livewire.selector');
    }

    public function valorActualizado($valor) {
        $this->valorActual = $valor;
        $this->emit($this->emitirAlClickear, $this->valorActual);
    }

    public function getListeners()
    {
        return [
            $this->escuchar => 'hola'
        ];
    }

    /**
     * Devuelve los nombres de los eventos escuchados y emitidos por este
     * selector dado un nombre que lo identifique respecto a otros
     * selectores. O, si no tiene nombre, null.
     */
    public static function NombreDeEventos($nombre)
    {
        return $nombre != null
            ? [$nombre . '.selectorClickeado', $nombre . '.selectorValorModificado']
            : ['selectorClickeado', 'selectorValorModificado'];
    }

    /**
     * Devuelve un mapa de los parametros de este componente con
     * todos los campos en null. Workaround para el hecho de que
     * hasta la version PHP 8.0 no se pueden desempaquetar mapas
     * con el operador "..."
     */
    public static function ParametrosNulos()
    {
        return [
            'nombre'        => null,
            'porTabla'      => null,
            'porValores'    => null,
            'filtrarPor'    => null,
            'textoDefecto'  => null,
            'valorInicial'  => null,
        ];
    }
    
    private function leerParamPorTabla($porTabla)
    {
        $this->opcionesPorTabla = true;
        $this->tabla = $porTabla['tabla'];
        $this->colOpcion = $porTabla['opciones'];
        $this->colValor = $porTabla['valores'];
    }
    
    private function leerParamPorValores($porValores)
    {
        $this->opcionesPorTabla = false;
        $opciones = [];
        $valores = [];
        foreach ($porValores as $par) {
            try {
                $opcion = $par[0];
                $valor = $par[1];

                array_push($opciones, $opcion);
                array_push($valores, $valor);
            }   catch (Exception $e)
            {
                throw new Exception("Uno de los pares no tiene texto o valor.");
            }
        }
        $this->opciones = $opciones;
        $this->valores = $valores;
    }
}
