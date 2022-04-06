<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Intendente;
use App\RegionSanitaria;
use App\Formateado\NumerosRomanos;
use Livewire\Component;

class SanitarioRegiones extends Component
{
    public $estilosMunicipios = [];

    protected $listeners = [
        'clickEnRegion',
        'clickEnMunicipio',
        'clickEnRestaurar'          => 'restaurarTabla',
        'clickEnTodosLosMunicipios' => 'restaurarTabla',
        'clickEnTodasLasSecciones'  => 'restaurarTabla',
    ];
    public $referencias;

    private $formateador;

    public function clickEnRegion($id)
    {
        $idsMunicipios = collect(RegionSanitaria::find($id)->distritos)
            ->map(function ($municipio) {
                return $municipio->id;
            })
            ->toArray();
        $this->formateador = new NumerosRomanos();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Regiones Sanitarias', 'Region '. $this->formateador->convertir($id)]);
        $this->dispatchBrowserEvent('mostrarRegion', $idsMunicipios);
    }

    public function clickEnMunicipio($id)
    {
        $region = Distrito::find($id)->regiones_sanitarias[0];
        $this->clickEnRegion($region->id);
        $this->emit('regionActualizada', $region->id);
    }

    public function restaurarTabla() {
        $this->emit('regionActualizada', null);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Sanitario', 'Regiones Sanitarias']);
    }

    public function obtenerReferencias()
    {
        $resultado = [];
        $region = RegionSanitaria::all();
        foreach ($region as $region) {
            $ref = [
                'nombre'    => ' ' . $this->formateador->convertir($region->id),
                'relleno'   => $region->color_seccion
            ];
            array_push($resultado, $ref);
        }
        return $resultado;
    }

    public function mount() {
        $this->formateador = new NumerosRomanos();
        $this->referencias =$this->obtenerReferencias();
        $this->estilosMunicipios = Distrito::estilosSegunRegionSanitaria();
    }

    public function render()
    {
        return view('livewire.sanitario-regiones');
    }
}
