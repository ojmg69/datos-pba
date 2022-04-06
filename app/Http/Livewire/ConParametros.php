<?php

namespace App\Http\Livewire;

trait ConParametros
{

    /**
     * Tira una excepcion si una parametro NO NULO es igual a null
     */
    public function noNulo($param, $nombre = null)
    {
        $existe = $param != null;

        if (!$existe)
        {
            $metodo = debug_backtrace()[1]['class'] . '::' . debug_backtrace()[1]['function'];

            $mensaje = $nombre == null
                ? "$metodo: El parametro NO NULO '$nombre' es igual a null"
                : "$metodo: Un parametro NO NULLO es igual a null";
                
            throw new \Exception($mensaje);
        }
    }

    public function soloUno($a, $b)
    {
        if ($a == null && $b == null) throw new Exception("Se necesita uno de estos dos parametros");
        if ($a != null && $b != null) throw new Exception("Se recibieron dos parametros excluyentes");
    }
}