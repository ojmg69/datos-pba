<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Transferencia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EconomicoGraficos extends Component
{
    public $idMunicipio;
    public $anos;

    public $etiquetasGrafico = [

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
        "clickEnMunicipio",
        "selectorClickeado"
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
        $años = DB::table('anos')->get();
        return view('livewire.economico-graficos', ['años' => json_decode($años, true)]);
    }
}
