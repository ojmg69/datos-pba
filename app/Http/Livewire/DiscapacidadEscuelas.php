<?php

namespace App\Http\Livewire;

use App\SectorEducativo;
use App\EstablecimientoEducativo;
use App\Discapacidad;
use App\Distrito;
use App\Seccion;
use Livewire\Component;

class EducacionEscuelas extends Component
{

    public $vista;
    public $pines = [];
    public $referencias;

    public $listeners = [
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
        'clickEnEstablecimiento',
        'verTabla',
    ];
    
    public function render()
    {
        return view('livewire.discapacidad-escuelas');
    }

    public function mount()
    {
        $this->referencias = SectorEducativo::referencias(' ');
        $this->cargarPines();
    }

    public function clickEnMunicipio($id) {
        $this->pines = EstablecimientoEducativo::pinesConConsulta(
            EstablecimientoEducativo::
                join('sector_educativo', 'sector_educativo.id', '=', 'establecimientos_educativos.sector_educativo_id')
                ->select('establecimientos_educativos.*')
                ->addSelect('sector_educativo.color as color')
                ->where('establecimientos_educativos.distrito_id', '=', $id)
        );
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas', Distrito::find($id)->nombre]);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function clickEnEstablecimiento($id) {
        $this->vista = 'detalle';
        $this->establecimiento = EstablecimientoEducativo::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas', $this->establecimiento->distrito->nombre]);
        $this->emit('entidadActualizada', $this->establecimiento);
        $color = $this->establecimiento->sector_educativo->color;
        $this->dispatchBrowserEvent('enfocarCoordenadas', [
            'coords' => $this->establecimiento->pin($color),
            'idMunicipio' => $this->establecimiento->distrito_id
        ]);
    }

    public function clickEnTodosLosMunicipios() {
        $this->cargarPines();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
        $this->vista = null;
    }

    public function clickEnTodasLasSecciones() {
        $this->cargarPines();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
        $this->vista = null;
    }

    public function clickEnRestaurar() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function verTabla() {
        $this->vista = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas']);
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('mostrarMunicipios');
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Discapacidad', 'Escuelas', Seccion::find($id)->nombre]);
    }

    private function cargarPines()
    {
        $escuelasConSector = EstablecimientoEducativo::
            join('sector_educativo', 'sector_educativo.id', '=', 'establecimientos_educativos.sector_educativo_id');

        $this->pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
            $escuelasConSector,
            'distrito_id'
        );
    }
}
