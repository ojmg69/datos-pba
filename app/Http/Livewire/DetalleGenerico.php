<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetalleGenerico extends Component
{
    /**
     * Entidad detallada.
     */
    public $entidad;

    /**
     * Nombre del atributo de donde se sacara el titulo, etc.
     */
    public $titulo;
    public $subtitulo;

    /**
     * Arreglo con los nombres de los atributos que componen al cuerpo
     * del detalle. Una fila por cada uno con el nombre en negrita.
     */
    public $cuerpo;
    public $volver;
    public $actualizacion;
    public $boton;

    public $eventos = [];

    /**
     * volver = El nombre del evento que se emitira cuando se haga click en el
     * boton volver.
     *
     * actualizacion = El nombre del evento que se escuchara para saber que la
     * entidad detallada ha cambiado.
     *
     * nombre = El nombre del prefijo del evento de este detalle. Si es != null
     * este detalle escuchara al evento "prefijo.entidadActualizada"
     *
     * boton = Datos del boton extra de este detalle. Es un array con dos campos:
     * nombre y evento. El primero es el texto del boton, el segundo el evento de
     * su click.
     */
    public function mount(
        $titulo = '',
        $subtitulo = '',
        $cuerpo = [],
        $volver = 'verTabla',
        $actualizacion = 'entidadActualizada',
        $nombre = null,
        $boton = null
    )
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->cuerpo = $cuerpo;
        $this->volver = $volver;
        $this->actualizacion = $actualizacion;
        $this->eventos = [];
        if (is_null($nombre)) {
            $this->eventos[$actualizacion] = 'entidadActualizada';
        } else {
            $this->eventos[$actualizacion] = $nombre . '.' . 'entidadActualizada';
        }
        $this->boton = $boton;
    }

    public function entidadActualizada($entidad) {
        $this->entidad = $entidad;
    }

    public function clickVolver() {
        $this->emit($this->volver);
    }

    public function clickBoton() {
        $this->emit($this->boton['evento']);
    }

    public function getListeners() {
        return $this->eventos;
    }

    public function render()
    {
        return view('livewire.detalle-generico');
    }
}
