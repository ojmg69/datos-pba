<?php

namespace App\Conteo;

/**
 * Representa un conteo de entidades.
 * 
 * Puede usarse para alimentar los contadores y graficos de dona de los
 * tableros de los ejes. Para usarlo hay que extenderlo y sobrescribir
 * unos cuantos metodos que van a variar segun las entidades que se este
 * contando y segun como se las obtenga.
 */
abstract class Conteo
{
    public $categorias = [];
    public $valores = [];
    public $colores = [];

    /**
     * Es la cantidad de categorias que forman parte del "top". Si estamos
     * haciendo un top 10, debe ser 10.
     * 
     * Las categorias que sobren, si las hay, se agruparan en una nueva categoria que
     * las englobe.
     * 
     * Por defecto es INF (infinito), es decir, no hay top. Simplemente se
     * mostraran todas las categorias.
     */
    private $TOP = INF;

    /**
     * Setter para $TOP.
     */
    public function top($top)
    {
        $this->TOP = $top;
        return $this;
    }

    /**
     * Carga los atributos "categorias", "valores", y "colores" de este conteo.
     * 
     * Recibe un mapa de argumentos. Las claves que pueda tener dicho mapa dependen
     * de las clases que extiendan a esta. Cada una puede requerir argumentos diferentes.
     */
    public function cargar($args = null)
    {
        $this->categorias = [];
        $this->valores = [];
        $this->colores = [];

        $datos = $this->cargarDatos($args);

        for ($i=0; $i < count($datos) && $i < $this->TOP; $i++) {
            $dato = $datos[$i];
            array_push(
                $this->categorias,
                $this->getNombreDeCategoria($dato)
            );

            array_push(
                $this->colores,
                $this->getColorDeCategoria($dato)
            );

            array_push(
                $this->valores,
                $this->getValorDeCategoria($dato)
            );
        }

        if ($this->TOP != INF)
        {
            $suma = 0;
            for ($i= $this->TOP; $i < count($datos); $i++) { 
                $dato = $datos[$i];
                $suma += $this->getValorDeCategoria($dato);
            }

            array_push(
                $this->categorias,
                $this->getNombreDeCategoriaRestante()
            );

            array_push(
                $this->colores,
                $this->getColorDeCategoriaRestante()
            );

            array_push(
                $this->valores,
                $suma
            );
        }

        return $this;
    }

    public function aObjetoSimple()
    {
        return [
            'categorias' => $this->categorias,
            'valores' => $this->valores,
            'colores' => $this->colores,
        ];
    }

    /**
     * Debe devolver una lista de datos que se usaran para cargar el conteo.
     * 
     * Aca uno especifica si el conteo esta ordenado o no. Los datos pueden ser
     * estaticos, aleatorios, obtenidos con una consulta. Hay libertad total.
     * 
     * Es usado exclusivamente por el metodo publico "cargar". Recibe el mapa
     * que le fue pasado a dicho metodo. Por defecto ese mapa es null o sea
     * que antes de usarlo SIEMPRE hay que ver si es no nulo.
     */
    protected abstract function cargarDatos($args);

    /**
     * Dado un item de los devueltos por "cargarDatos" devuelve el nombre que le corresponde
     * a su categoria.
     * 
     * Reemplazar si tu entidad dato tiene su nombre en otra propiedad.
     */
    protected function getNombreDeCategoria($dato)
    {
        return $dato->nombre;
    }
    
    /**
     * Dado un item de los devueltos por "cargarDatos" devuelve el color que le corresponde
     * a su categoria.
     * 
     * Reemplazar si tu entidad dato tiene su color en otra propiedad.
     */
    protected function getColorDeCategoria($dato)
    {
        return $dato->color;
    }

    /**
     * Dado un item de los devueltos por "cargarDatos" devuelve el valor que le corresponde
     * a su categoria.
     */
    protected abstract function getValorDeCategoria($dato);
    
    /**
     * Devuelve el nombre de la categoria que engloba a las restantes, las que no entraron en el top.
     */
    protected function getNombreDeCategoriaRestante()
    {
        return 'Otros';
    }

    /**
     * Devuelve el color de la categoria que engloba a las restantes, las que no entraron en el top.
     */
    protected function getColorDeCategoriaRestante()
    {
        return null;
    }

    protected function tieneArgumento($nombre, $args)
    {
        return $args != null && array_key_exists($nombre, $args) && $args[$nombre] != null;
    }
}