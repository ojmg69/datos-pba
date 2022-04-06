<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableroContadoresPorCategoria extends Component
{
    public $nombre;

    public $idGrafico;

    public $eventoParametrosActualizados;

    public $categorias;

    public $valores;

    public $ordenar = null;

    public $categoriasEstaticas;

    public $valorPorcentaje;

    public function mount(
        /**
         * Parametro
         * 
         * Cadena que se usa como titulo de este componente en la vista
         */
        $nombre,

        /**
         * Parametro
         * 
         * Cadenas que se usaran como nombre de los contadores a mostrar
         * 
         * La primer cadena corresponde con el primer valor, etc.
         * 
         * Tipo: string[]
         */
        $categorias,

        /**
         * Parametro
         * 
         * Numeros que se usaran como valor de los contadores a mostrar
         * 
         * El primer valor corresponde con la primer cadena, etc.
         * 
         * Tipo: number[]
         */
        $valores,

        /**
         * Parametro
         * 
         * ID que debe usarse como prefijo cuando se emite un evento para actualizar
         * este componente. Por defecto es null, en cuyo caso el ID de este componente
         * es su nombre en minuscula.
         */
        $idGrafico = null,

        /**
         * Parametro
         * 
         * Cambia el orden en que se muestran los contadores.
         * 
         * Tipo: [ "valores" | "categorias", "asc" | "desc" ]
         * 
         * Por defecto es null.
         */
        $ordenar = null,

        /**
         * Parametro (opcional)
         * 
         * Hace que los nombres de las categorias no cambien
         */
        $categoriasEstaticas = false,
        
        /**
         * Parametro (opcional)
         * 
         * Para que no te saque la coma y sea porcentaje
         */
        $valorPorcentaje = false

    )
    {
        $this->nombre = $nombre;
        $this->categorias = $categorias;
        $this->valores = $valores;
        $this->categoriasEstaticas = $categoriasEstaticas;
        $this->valorPorcentaje = $valorPorcentaje;

        $this->idGrafico = is_null($idGrafico)
            ?   str_replace(' ', '', strtolower($nombre))
            :   $idGrafico;

        $this->eventoParametrosActualizados = $this->idGrafico . '.parametrosActualizados';

        $this->ordenar = $ordenar;

        if ($this->ordenar != null) $this->ordenarDatos();
    }

    public function render()
    {
        return view('livewire.tablero-contadores-por-categoria');
    }

    public function getListeners()
    {
        return [
            $this->eventoParametrosActualizados => 'parametrosActualizados'
        ];
    }

    public function parametrosActualizados($parametros)
    {
        
        if (!$this->categoriasEstaticas)
            $this->categorias = $parametros['categorias'];

        $this->valores = $parametros['valores'];
        
        if ($this->ordenar != null) $this->ordenarDatos();
    }

    private function ordenarDatos()
    {
        switch ($this->ordenar[0]) {
            case 'valores':
                $this->ordenarPorValores();
                break;
            case 'categorias':
                $this->ordenarPorCategorias();
                break;
            default:
                throw new Exception('ERROR: no se puede ordenar por "' . $this->ordenar[0] . '."');
        }
    }

    private function ordenarPorValores()
    {
        $sentido = $this->ordenar[1] == 'asc'
            ? SORT_ASC
            : SORT_DESC;
        
        array_multisort(
            $this->valores, $sentido, SORT_NUMERIC,
            $this->categorias
        );
    }

    private function ordenarPorCategorias()
    {
        $sentido = $this->ordenar[1] == 'asc'
            ? SORT_ASC
            : SORT_DESC;
        
        array_multisort(
            $this->categorias, $sentido, SORT_STRING,
            $this->valores
        );
    }
}