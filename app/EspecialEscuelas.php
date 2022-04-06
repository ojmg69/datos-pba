<?php

namespace App\Http\Livewire;

use App\Discapacitado;
use App\Distrito;
use App\EstablecimientoEducativo;
use App\Seccion;
use App\SectorEducativo;
use Livewire\Component;

class EspecialEscuelas extends Component
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
        return view('livewire.especial-escuelas');
    }

    public function mount()
    {
        $this->referencias = SectorEducativo::referencias('Establecimiento ');
        $this->cargarPines();
    }

    public function clickEnMunicipio($id) {
        $this->pines = Discapacitado::pinesConConsulta(
            Discapacitado::
                join('sector_educativo', 'sector_educativo.id', '=', 'discapacitados.sector_educativo_id')
                ->select('discapacitados.*')
                ->addSelect('sector_educativo.color as color')
                ->where('discapacitados.distrito_id', '=', $id)
        );
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas', Distrito::find($id)->nombre]);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function clickEnEstablecimiento($id) {
        $this->vista = 'detalle';
        $this->establecimiento = Discapacitado::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Especial', 'Escuelas', $this->establecimiento->distrito->nombre]);
        $this->emit('entidadActualizada', $this->establecimiento);
        $color = $this->establecimiento->sector_educativo->color;
        $this->dispatchBrowserEvent('enfocarCoordenadas', [
            'coords' => $this->establecimiento->pin($color),
            'idMunicipio' => $this->establecimiento->distrito_id
        ]);
    }

    public function clickEnTodosLosMunicipios() {
        $this->cargarPines();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
        $this->vista = null;
    }

    public function clickEnTodasLasSecciones() {
        $this->cargarPines();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
        $this->vista = null;
    }

    public function clickEnRestaurar() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function verTabla() {
        $this->vista = null;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('mapaListo');
        $this->dispatchBrowserEvent('mostrarMunicipios');
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas', Seccion::find($id)->nombre]);
    }

    private function cargarPines()
    {
        $escuelasConSector = Discapacitado::
            join('sector_educativo', 'sector_educativo.id', '=', 'discapacitados.sector_educativo_id');

        $this->pines = Discapacitado::pinesAgrupadosPorColumnaConConsulta(
            $escuelasConSector,
            'distrito_id'
        );
    }
}
