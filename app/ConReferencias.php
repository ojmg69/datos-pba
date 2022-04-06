<?php

namespace App;

trait ConReferencias {
    public static function referencias($prefijo = '', $colNombre = 'nombre', $formateador = null)
    {
        $resultado = [];
        $entidades = parent::all();
        foreach ($entidades as $entidad) {
            $nombre = is_null($formateador)
                ? $prefijo . $entidad->{ $colNombre }
                : $prefijo . $formateador->convertir($entidad->{ $colNombre });

            $ref = [
                'nombre'    => $nombre,
                'relleno'   => $entidad->color
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }
}