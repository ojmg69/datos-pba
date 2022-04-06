<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableroGraficoDona extends Component
{
    public $nombre;

    public $idGrafico;

    public $dataset = null;

    public $referencias;

    public $eventoListoParaDibujar;

    public $eventoParametrosActualizados;

    public function mount(
        $nombre,
        $categorias,
        $colores,
        $valores,
        $idGrafico = null
    ) {
        $this->nombre = $nombre;

        $this->dataset = [
            'nombre'    => $nombre,
            'etiquetas' => $categorias,
            'valores'   => $valores,
            'colores'  => $colores,
        ];

        $this->idGrafico = is_null($idGrafico)
            ?   str_replace(' ', '', strtolower($nombre))
            :   $idGrafico;

        $this->referencias = $this->crearReferencias($categorias, $colores);

        $this->eventoListoParaDibujar = $this->idGrafico . '.listoParaDibujar';

        $this->eventoParametrosActualizados = $this->idGrafico . '.parametrosActualizados';
    }

    public function render()
    {
        return view('livewire.tablero-grafico-dona');
    }

    public function getListeners()
    {
        return [
            $this->eventoParametrosActualizados => 'parametrosActualizados'
        ];
    }

    public function parametrosActualizados($parametros)
    {
        $this->referencias = $this->crearReferencias($parametros['categorias'], $parametros['colores']);

        $data = [
            'nombre'    => $this->nombre,
            'etiquetas' => $parametros['categorias'],
            'valores'   => $parametros['valores'],
            'colores'  => $parametros['colores'],
        ];

        $this->dispatchBrowserEvent($this->eventoListoParaDibujar, $data);
    }

    private function crearReferencias($categorias, $colores)
    {
        $resultado = [];
        for ($i = 0; $i < count($categorias); $i++) {
            $parametros = [
                'texto' => $categorias[$i],
                'color' => $colores[$i]
            ];
            array_push($resultado, $parametros);
        }
        return $resultado;
    }
}
