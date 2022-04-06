<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContadorGrande extends Component
{
    public $nombre;
    public $valor;
    public $idContador;
    private $eventos;

    public function mount($nombre, $valor, $idContador = null)
    {
        $this->nombre = strtoupper($nombre);
        $this->valor = $valor;

        $this->idContador = is_null($idContador)
            ? $nombre
            : $idContador;
    }

    protected function getListeners()
    {
        $evento = $this->idContador . '.valorActualizado';
        return [
            $evento => 'valorActualizado'
        ];
    }

    public function valorActualizado($valor)
    {
        $this->valor = $valor;
    }

    public function render()
    {
        return view('livewire.contador-grande');
    }
}
