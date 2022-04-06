<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Gasto;
use Livewire\Component;

class EconomicoComposicionGastos extends Component
{


    public $localidad;
    public $modo;
    public $criterio;
    public $visual;
    public $transferencias;
    public $detalleTransf;

    public function mount()
    {
        $this->localidad = Distrito::find(93);

        $this->dispatchBrowserEvent('show-map', ['data' => $this->localidad]);

        $this->criterio = "composicion_egresos";
        $this->detalleTransf = null;
        $this->visual = $this->vistaInicio();;
    }


    public function vistaInicio()
    {
        return $this->visual = "general";
    }

    public function refreshMe()
    {
        $this->render();
    }

    public function vistaTablaCompleta()
    {
        $this->visual = "tablaCompleta";
    }

    public function cambiarVista()
    {
        switch ($this->criterio) {
            case 'composicion_ingresos':
                return redirect(route('economico.index'));
                break;
            case 'composicion_gastos':
                return redirect(route('economico.comp_gastos'));
            default:
                # code...
                break;
        }
    }


    public function render()
    {
        $localidad = Distrito::find(93);

        $this->dispatchBrowserEvent('show-map', ['data' => $localidad]);
        return view('livewire.economico-composicion-gastos');
    }
}
