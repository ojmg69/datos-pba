<?php

namespace App\Http\Livewire;

use App\Funcionario;
use App\Ministerio;
use Livewire\Component;

class PoliticoMinisterio extends Component
{
    public $DatosFuncionarios;
    public $ministerios;
    public $id_ministerio;
    public $vista;
    public $detalle;
    public $orden;
    public $datosFuncionario;
    public $cantidadMinisterios;
    public $cantidadSubsecretarios;
    public $cantidadMinistras;
    public $cantidadMinistros;
    public $coloresGrafico;

    public function mount($id_ministerio)
    {
        $this->vista = "tablero";
        $this->detalle = 'no';
        $this->ministerios = Ministerio::all();
        $this->id_ministerio = $id_ministerio;
        $this->cargarDatosTablero();
    }

    public function obtenerFuncionarios($id_ministerio)
    {
        $funcionarios = Funcionario::
        where('ministerio_id','=',$id_ministerio)
        ->orderBy('orden','ASC')
        ->get();

        return $funcionarios;
    }

    public function render()
    {
        $this->orden = 1;
        $this->DatosFuncionarios = $this->obtenerFuncionarios($this->id_ministerio);
        return view('livewire.politico-ministerio');
    }

    public function verDetalle($id){
        $this->datosFuncionario = Funcionario::find($id);
        $this->detalle="si";
    }
    public function verGeneral(){
        $this->detalle = 'no';
        $this->vista = "general";
    }
    public function verTablero(){
        $this->detalle = 'no';
        $this->vista = "tablero";
        $this->emit('graficoGenero.parametrosActualizados', [
            'categorias'=>  ['MINISTROS', 'MINISTRAS'],
            'valores'   =>  [$this->cantidadMinistros ,$this->cantidadMinistras],
            'colores'   =>  $this->coloresGrafico,
        ]);
    }

    public function cargarDatosTablero(){
        $this->coloresGrafico = ['#64B5F6','#FFC0CB'];
        $this->cantidadMinisterios = Ministerio::cantidadMinisterios();
        $this->cantidadSubsecretarios = Funcionario::cantidadSubsecretarias();
        $this->cantidadMinistras = Funcionario::cantidadMinistras();
        $this->cantidadMinistros = Funcionario::cantidadMinistros();
    }
}
