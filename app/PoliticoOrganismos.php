<?php

namespace App\Http\Livewire;

use App\Conteo\ConteoOrganismoMasSede;
use App\Conteo\ConteoOrganismoNacionalProvincial;
use Livewire\Component;
use App\Organismo;
use App\TipoOrganismo;

class PoliticoOrganismos extends Component
{
    public $vista;
    public $pines;
    public $referencias;
    public $conteoPorOrganismoMasSede;
    public $conteoPorOrganismoMasSedeGrafico;
    public $conteoOrganismoNacionalProvincial;
    public $idDistritoSeleccionado = null;

    protected $listeners = [
        'verSedes',
        'verAutoridades',
        'organismosAutoridades.selectorClickeado' => 'selectorActualizado',
        'organismosSedes.selectorClickeado' => 'selectorActualizado',
        'clickEnMunicipio',
        'clickEnTodosLosMunicipios',
        'clickEnTodasLasSecciones',
        'clickEnRestaurar'
    ];

    public $valorSelector = Selector::TODOS;

    public function mount($vista)
    {
        $this->vista = 'tablero';
        $this->pines = Organismo::pinesConConsulta(
            Organismo::leftJoin(
                'organismos',
                'organismos_provinciales_nacionales.organismo_id',
                '=',
                'organismos.id'
            )
        );
        $this->referencias = TipoOrganismo::referencias();
        $this->setBreadcrumbs($vista);
        $this->cargarDatosTablero();
    }

    public function render()
    {
        return view('livewire.politico-organismos');
    }

    public function verDetalles()
    {
        $this->vista = 'sedes';
    }
    
    public function obtenerVistaPrincipal()
    {
        $this->vista = 'tablero';
        $this->cargarDatosTablero(['idMunicipio' => $this->idDistritoSeleccionado]);
        $this->actualizarTablero();
    }

    public function verSedes()
    {
        $this->vista = 'sedes';
        $this->setBreadcrumbs();
    }

    public function verAutoridades()
    {
        $this->vista = 'autoridades';
        $this->setBreadcrumbs();
    }

    public function selectorActualizado($valor)
    {
        $this->valorSelector = $valor;
    }

    public function clickEnMunicipio($idMunicipio)
    {
        $this->idDistritoSeleccionado = $idMunicipio;
        $this->cargarDatosTablero(['idMunicipio' => $idMunicipio]);
        $this->dispatchBrowserEvent('clickEnLupita', intval($idMunicipio));
        $this->actualizarTablero();
    }

    public function clickEnTodosLosMunicipios()
    {
        $this->idDistritoSeleccionado = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnTodasLasSecciones()
    {
        $this->idDistritoSeleccionado = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnRestaurar()
    {
        $this->idDistritoSeleccionado = null;
        $this->actualizarTablero();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoPorOrganismoMasSede = (new ConteoOrganismoMasSede())
            ->top(3)
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoPorOrganismoMasSedeGrafico = (new ConteoOrganismoMasSede())
            ->top(3)
            ->cargar($args)
            ->aObjetoSimple();

        
        $this->conteoOrganismoNacionalProvincial = (new ConteoOrganismoNacionalProvincial())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarContadores()
    {
        $this->emit('organismosConMasSedes.parametrosActualizados', [
            'categorias'    => $this->conteoPorOrganismoMasSede['categorias'],
            'valores'       => $this->conteoPorOrganismoMasSede['valores']
        ]);

        $this->emit('organismosPorTipo.parametrosActualizados', [
            'categorias'    => $this->conteoOrganismoNacionalProvincial['categorias'],
            'valores'       => $this->conteoOrganismoNacionalProvincial['valores']
        ]);
    }

    private function actualizarGrafico($idSeccion = null)
    {
        $this->emit('graficoOrganismo.parametrosActualizados', [
            'categorias'    => $this->conteoPorOrganismoMasSedeGrafico['categorias'],
            'valores'       => $this->conteoPorOrganismoMasSedeGrafico['valores'],
            'colores'   =>  $this->conteoPorOrganismoMasSedeGrafico['colores'],
        ]);
    }

    private function setBreadcrumbs()
    {
        $ultimoNivel = $this->vista == 'autoridades'
            ? 'Autoridades'
            : 'Sedes';

        $this->emit(
            'arbol-navegabilidad.rutaActualizada',
            ['Eje Institucional', 'Ejecutivo', 'Organismos Nac. y Prov.', $ultimoNivel]
        );
    }
}
