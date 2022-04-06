<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BotonTabla extends Component
{
    public $activado;
    public $resetPage;
    public $texto;
    public $nombre;

    public function mount(
        $nombre     = null,
        $texto      = null,
        $activado   = true,
        $resetPage  = false
    )
    {
        $this->nombre       = $nombre;
        $this->texto        = $texto;
        $this->activado     = $activado;
        $this->resetPage    = $resetPage;
    }

    public function render()
    {
        return view('livewire.boton-tabla');
    }

    public function getListeners()
    {
        if ($this->nombre != null)
        {
            $eventoParametrosActualizados = $this->nombre . '.ParametrosActualizados';

            return [
                $eventoParametrosActualizados => 'parametrosActualizados'
            ];
        } else 
        {
            return [];
        }
    }

    public function parametrosActualizados($params)
    {
        if (array_key_exists('nombre', $params))
            $this->nombre = $params['nombre'];

        if (array_key_exists('texto', $params))
            $this->texto = $params['texto'];

        if (array_key_exists('evento', $params))
            $this->evento = $params['evento'];

        if (array_key_exists('activado', $params))
            $this->activado = $params['activado'];

        if (array_key_exists('resetPage', $params))
            $this->resetPage = $params['resetPage'];
    }

    public function clickBoton()
    {
        if ($this->resetPage){
            $this->emit('TablaGenerica.ResetearPagina');
        }
        
        $this->emit($this->nombre . '.Click');
    }

    public static function ParametrosNulos()
    {
        return [
            'nombre'     => null,
            'texto'      => null,
            'activado'   => null,
            'resetPage'  => null,
        ];
    }
}