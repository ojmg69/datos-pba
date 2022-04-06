<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Transferencia;
use Livewire\Component;

class EconomicoGraficos extends Component
{
    public $idMunicipio;

    public $etiquetasGrafico = [
        'Distrito'                  ,
        'Coparticipación'           ,
        'Omisión Copart. 2019'      ,
        'Descentralización'         ,
        'Juegos de Azar'            ,
        'FFPS'                      ,
        'FSA'                       ,
        'Fondo Fort. Rec. Muni.'    ,
        'Fondo Inclusión Social'    ,
        'Fondo Fina. Educ.'         ,
        'Fondo Infra. Muni. 2017'   ,
        'Fondo Ley 14890'           ,
    ];

    public $listeners = [
        "clickEnMunicipio"
    ];

    public function mount()
    {
        $this->localidad = Distrito::find(93);
    }

    public function clickEnMunicipio($idMunicipio) {
        $this->idMunicipio = $idMunicipio;

        $this->dispatchBrowserEvent('municipioListoParaGraficar', $idMunicipio);
    }

    public function render()
    {
        return view('livewire.economico-graficos');
    }
}
