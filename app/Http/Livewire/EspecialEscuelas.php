<?php

namespace App\Http\Livewire;

use App\Conteo\conteoClasificacionAdministracion;
use App\Conteo\conteoClasificacionAdministracionGrafica;
use App\Conteo\conteoClasificacionNiveles;
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
    public $idMunicipio;
    public $seccion;
    public $conteoClasificacionAdministracion;
    public $conteoClasificacionNivel;
    public $conteoClasificacionAdministracionGrafica;

    public $listeners = [
        'verEscuelasPorSector',
        'verEscuelasPorNivel',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar',
        'clickEnEstablecimiento',
        'verTabla',
        'selectorClickeado'
    ];

    public function render()
    {
        return view('livewire.especial-escuelas');
    }

    public function mount()
    {
        $this->vista = 'tablero';
        $this->referencias = SectorEducativo::referencias('Establecimiento');
        $this->cargarPines();
        $this->cargarDatosTablero();
    }

    public function clickEnMunicipio($id)
    {
        $this->pines = EstablecimientoEducativo::pinesConConsulta(
            EstablecimientoEducativo::join('sector_educativo', 'sector_educativo.id', '=', 'establecimientos_educativos.sector_educativo_id')
                ->select('establecimientos_educativos.*')
                ->addSelect('sector_educativo.color as color')
                ->where('establecimientos_educativos.distrito_id', '=', $id)
                ->where('establecimientos_educativos.modalidad', 'Educación Especial')
        );
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas', Distrito::find($id)->nombre]);
        $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
        $this->idMunicipio = $id;
        $this->seccion = null;
        $this->cargarDatosTablero(['idMunicipio' => $id]);
        $this->dispatchBrowserEvent('clickEnLupita', intval($id));
        $this->actualizarTablero();
    }

    public function clickEnEstablecimiento($id)
    {
        $this->vista = 'detalle';
        $this->establecimiento = EstablecimientoEducativo::find($id);
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Especial', 'Escuelas', $this->establecimiento->distrito->nombre]);
        $this->emit('entidadActualizada', $this->establecimiento);
        $color = $this->establecimiento->sector_educativo->color;
        $this->dispatchBrowserEvent('enfocarCoordenadas', [
            'coords' => $this->establecimiento->pin($color),
            'idMunicipio' => $this->establecimiento->distrito_id
        ]);
    }

    public function clickEnTodosLosMunicipios()
    {
        $this->cargarPines();
        $this->seccion = null;
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function clickEnTodasLasSecciones()
    {
        $this->cargarPines();
        $this->seccion = null;
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function clickEnRestaurar()
    {
        $this->cargarPines();
        $this->seccion = null;
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('agregarPines', $this->pines);
    }

    public function verDetalles()
    {
        $this->vista = 'escuelas-por-sector';
        $data = $this->idMunicipio ? ["idMunicipio" => $this->idMunicipio] : ($this->seccion ? ["idSeccion" => $this->seccion] : null);
        $this->cargarDatosTablero($data);
        $this->actualizarTablero();
    }
    
    public function verTabla()
    {
        $this->vista = 'escuelas-por-sector';
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas']);
        $this->dispatchBrowserEvent('mapaListo');
        if ($this->idMunicipio) {
            $this->dispatchBrowserEvent('clickEnLupita', intval($this->idMunicipio));
            $this->pines = EstablecimientoEducativo::pinesConConsulta(
                EstablecimientoEducativo::join('sector_educativo', 'sector_educativo.id', '=', 'establecimientos_educativos.sector_educativo_id')
                ->select('establecimientos_educativos.*')
                ->addSelect('sector_educativo.color as color')
                ->where('establecimientos_educativos.distrito_id', '=', $this->idMunicipio)
                ->where('establecimientos_educativos.modalidad', 'Educación Especial')
            );
            $this->dispatchBrowserEvent('pinesActualizados', $this->pines);
        } else if ($this->seccion) {
            $this->dispatchBrowserEvent('mostrarSeccion', intval($this->seccion));
        } else {
            $this->dispatchBrowserEvent('mostrarTodosLosMunicipios');
        }
    }

    public function selectorClickeado($id)
    {
        if ($this->vista === 'escuelas-por-sector') {
            if ($id == 'todos') {
                $escuelasConSector = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', 'sector_educativo.id')
                ->where('establecimientos_educativos.modalidad', 'Educación Especial');
    
                $pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
                    $escuelasConSector,
                    'distrito_id'
                );
            } else {
                $escuelasConSector = EstablecimientoEducativo::join('sector_educativo', 'establecimientos_educativos.sector_educativo_id', 'sector_educativo.id')
                ->where('establecimientos_educativos.sector_educativo_id', $id)
                ->where('establecimientos_educativos.modalidad', 'Educación Especial');
    
                $pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
                    $escuelasConSector,
                    'distrito_id'
                );
            }
        }
        
        if ($this->vista === 'escuelas-por-nivel') {
            if ($id == 'todos') {
                $escuelasConSector = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->where('establecimientos_educativos.modalidad', 'Educación Especial');
    
                $pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
                    $escuelasConSector,
                    'distrito_id'
                );
            } else {
                $escuelasConSector = EstablecimientoEducativo::join('tipo_establecimiento_educativo', 'establecimientos_educativos.tipo_establecimiento_id', '=', 'tipo_establecimiento_educativo.id')
                ->where('tipo_establecimiento_educativo.id', $id)
                ->where('establecimientos_educativos.modalidad', 'Educación Especial');
    
                $pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
                    $escuelasConSector,
                    'distrito_id'
                );
            }
        }

        $this->dispatchBrowserEvent('pinesActualizados', $pines);
    }

    public function verTablero()
    {
        $data = $this->idMunicipio ? ["idMunicipio" => $this->idMunicipio] : ($this->seccion ? ["idSeccion" => $this->seccion] : null);
        $this->vista = 'tablero';
        $this->cargarDatosTablero($data);
        $this->actualizarTablero();
    }

    public function clickEnSeccion($id)
    {
        $this->idMunicipio = null;
        $this->seccion = $id;
        $this->emit('seccionActualizada', $id);
        $this->cargarDatosTablero(['idSeccion' => $id]);
        $this->actualizarTablero();
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Educación', 'Escuelas', Seccion::find($id)->nombre]);
    }

    private function cargarPines()
    {
        $escuelasConSector = EstablecimientoEducativo::join('sector_educativo', 'sector_educativo.id', '=', 'establecimientos_educativos.sector_educativo_id')
            ->where('establecimientos_educativos.modalidad', 'Educación Especial');

        $this->pines = EstablecimientoEducativo::pinesAgrupadosPorColumnaConConsulta(
            $escuelasConSector,
            'distrito_id'
        );
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function cargarDatosTablero($args = null)
    {
        $args['Especial'] = 'Educación Especial';
        $this->conteoClasificacionAdministracion = (new conteoClasificacionAdministracion())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoClasificacionNivel = (new conteoClasificacionNiveles())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoClasificacionAdministracionGrafica = (new conteoClasificacionAdministracionGrafica())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarGrafico()
    {
        $this->emit('conteoClasificacionAdministracionGrafica.parametrosActualizados', [
            'categorias' => $this->conteoClasificacionAdministracionGrafica['categorias'],
            'valores'   =>  $this->conteoClasificacionAdministracionGrafica['valores'],
            'colores'   =>  $this->conteoClasificacionAdministracionGrafica['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('conteoClasificacionAdministracion.parametrosActualizados', [
            'categorias'    => $this->conteoClasificacionAdministracion['categorias'],
            'valores'       => $this->conteoClasificacionAdministracion['valores']
        ]);

        $this->emit('conteoClasificacionNivel.parametrosActualizados', [
            'categorias'    => $this->conteoClasificacionNivel['categorias'],
            'valores'       => $this->conteoClasificacionNivel['valores']
        ]);
    }

    public function verEscuelasPorSector()
    {
        $this->vista = 'escuelas-por-sector';
    }

    public function verEscuelasPorNivel()
    {
        $this->vista = 'escuelas-por-nivel';
    }
}
