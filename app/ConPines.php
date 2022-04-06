<?php

namespace App;

trait ConPines {

    /**
     * Devuelve un objeto con los datos necesarios para dibujar el pin de
     * esta entidad. El color se tomara de la entidad, si tiene una propiedad/columna
     * "color". Si no la tiene se usara rojo por defecto u otro color que se pase.
     * 
     * @param color color del pin, rojo (#f00) por defecto.
     */
    public function pin($color = '#f00') {
        $colorPin = !is_null($this->color)
            ?   $this->color
            :   $color;
        
        return [
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'relleno' => $colorPin,
        ];
    }

    /**
     * Devuelve un arreglo de los pines de todas las entidades de este tipo
     * listo para mandarselo al mapa y dibujarlos. Tiene un limite de 600.
     * Mas de eso podria ralentizar el mapa.
     * 
     * @param color rojo por defecto o el valor de la prop "color", si existe
     */
    public static function pines($color = '#f00') {
        $resultado = [];

        $entidades = parent::limit(10000)->get();

        foreach ($entidades as $entidad) {
            $colorPin = !is_null($entidad->color)
                ?   $entidad->color
                :   $color;

            $pin = [
                'latitud' => $entidad->latitud,
                'longitud' => $entidad->longitud,
                'relleno' => $colorPin,
            ];
            array_push($resultado, $pin);
        }

        return $resultado;
    }

    /**
     * Lo mismo que "pines" pero esta vez toma una consulta creada con el 
     * query builder. Util cuando no hacen falta TODOS los pines sino una
     * porcion de ellos. Util tambien cuando el color viene de otra tabla
     * que se obtiene con un join.
     * 
     * @param consulta consulta personalizada con where (o lo que sea)
     * @param color rojo por defecto o el valor de la prop "color", si existe
     */
    public static function pinesConConsulta($consulta, $color = '#f00') {
        $resultado = [];

        $entidades = $consulta->get();

        foreach ($entidades as $entidad) {
            $colorPin = !is_null($entidad->color)
                ?   $entidad->color
                :   $color;

            $pin = [
                'latitud' => $entidad->latitud,
                'longitud' => $entidad->longitud,
                'relleno' => $colorPin,
            ];
            array_push($resultado, $pin);
        }

        return $resultado;
    }

    /**
     * Agrupa los pines por una columna/atributo de la clase. Se devolvera un maximo
     * de 600 pines. La cantidad de pines por grupo varia segun la cantidad de grupos
     * que haya. 
     * 
     * IMPORTANTE: Los pines se seleccionan aleatoriamente. Es decir que dos llamados
     * diferentes a este metodo devuelven dos resultados distintos. Esto tiene sentido
     * en el caso de uso original (mostrar los pines de establecimientos educativos).
     */
    public static function pinesAgrupadosPorColumna($columna, $color = '#f00')
    {
        $resultado = [];

        $MAX_ENTIDADES = 10000;

        $grupos = parent::select($columna)->groupBy($columna)->get();

        $MAX_POR_GRUPO = intdiv($MAX_ENTIDADES, $grupos->count());

        foreach ($grupos as $grupo) {
            $entidadesDelGrupo = parent
                ::where($columna, '=', $grupo->{$columna})
                ->limit($MAX_POR_GRUPO)
                ->get();
            
            foreach ($entidadesDelGrupo as $entidad) {
                array_push($resultado, self::convertirEnPin($entidad), $color);
            }
        }

        return $resultado;
    }

    /**
     * Agrupa los pines por una columna/atributo de la clase. Se devolvera un maximo
     * de 600 pines. La cantidad de pines por grupo varia segun la cantidad de grupos
     * que haya.
     * 
     * IMPORTANTE: Los pines se seleccionan aleatoriamente. Es decir que dos llamados
     * diferentes a este metodo devuelven dos resultados distintos. Esto tiene sentido
     * en el caso de uso original (mostrar los pines de establecimientos educativos).
     * 
     * Este metodo permite pasar una consulta que se usara para obtener las entidades. Es util
     * cuando es necesario hacer un join con otra tabla, o cuando las entidades deben filtrarse.
     */
    public static function pinesAgrupadosPorColumnaConConsulta($consulta, $columna, $sinLimite = false, $color = '#f00')
    {
        $resultado = [];

        $MAX_ENTIDADES = 10000;

        $grupos = parent::select($columna)->groupBy($columna)->get();

        $MAX_POR_GRUPO = intdiv($MAX_ENTIDADES, $grupos->count());

        $counta = 0;

        foreach ($grupos as $k => $grupo) {
            $entidadesDelGrupo;

            if ($sinLimite)
            {
                $entidadesDelGrupo = (clone $consulta)
                    ->where($columna, '=', $grupo->{$columna})
                    ->get();
            } else 
            {
                $entidadesDelGrupo = (clone $consulta)
                    ->where($columna, '=', $grupo->{$columna})
                    ->limit($MAX_POR_GRUPO)
                    ->get();
            }
            
            foreach ($entidadesDelGrupo as $entidad) {
                array_push($resultado, self::convertirEnPin($entidad, $color));
            }
        }

        return $resultado;
    }

    private static function convertirEnPin($entidad, $color)
    {
        $colorPin = !is_null($entidad->color)
            ?   $entidad->color
            :   $color;

        return [
            'latitud' => $entidad->latitud,
            'longitud' => $entidad->longitud,
            'relleno' => $colorPin,
        ];
    }
}