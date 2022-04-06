<?php

namespace App\Http\Livewire;

use App\Conteo\ConteoFiestasPopulares;
use App\Conteo\ConteoFiestasPopulares2;
use App\Conteo\ConteoFiestasPopularesGrafico;
use App\Distrito;
use App\Fiesta;
use Livewire\Component;

class MunicipioFiestasPopulares extends Component
{
    public $datosFiestas;
    public $vista;
    public $idsMunicipiosResaltados;
    public $idMunicipio;
    public $idSeccion;
    public $conteoFiestasPopulares;
    public $conteoFiestasPopulares2;
    public $conteoFiestasPopularesGrafico;

    public $validado;

    protected $listeners = [
        'clickEnSeccion',
        'clickEnMunicipio',
        'clickEnTodasLasSecciones'      => 'restaurarMapa',
        'clickEnTodosLosMunicipios'     => 'restaurarMapa',
        'clickEnRestaurar'     => 'restaurarMapa',
        'verDetalle'
    ];

    public function mount()
    {
        $this->vista = "tablero";
        $this->cargarDatosTablero();
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();
    }

    public function render()
    {
        return view('livewire.municipio-fiestas-populares');
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => 'http://localhost/paraprueba/datospba/public/municipios/fiestas_populares']);
    }

    public function volver()
    {
        $this->vista = "general";
    }


    public function verDetalle($id)
    {
        $this->datosFiestas = Fiesta::find($id);
        $this->vista = "detalle";
        $this->dispatchBrowserEvent('clickEnLupita', intval($this->datosFiestas->distrito->id));
    }

    public function restaurarMapa()
    {
        $this->idSeccion = null;
        $this->idMunicipio = null;
        $this->cargarDatosTablero();
        $this->actualizarTablero();
    }

    public function clickEnMunicipio($id)
    {
        $this->idMunicipio = $id;
        $this->idSeccion = null;
        $this->cargarDatosTablero(['idMunicipio' => $id]);
        $this->actualizarTablero();
        $this->datosFiestas = Fiesta::where('distrito_id', '=', $id)->get();
    }

    public function mostrarTodasLasFiestas()
    {
        $this->mount();
    }

    public function verGeneral()
    {
        $this->vista = 'general';
    }

    public function clickEnSeccion($id)
    {
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->cargarDatosTablero(['idSeccion' => $id]);
        $this->actualizarTablero();
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->actualizarTablero();
    }

    public function buscarMunicipiosQueResaltar()
    {
        return Fiesta::join('distritos', 'fiestas.distrito_id', '=', 'distritos.id')
            ->select('distritos.id')
            ->groupBy('distritos.id')
            ->get()
            ->map(function ($distrito) {
                return $distrito->id;
            })
            ->toArray();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoFiestasPopulares = (new ConteoFiestasPopulares())
            ->cargar($args)
            ->aObjetoSimple();
            
        $this->conteoFiestasPopulares2 = (new ConteoFiestasPopulares2())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoFiestasPopularesGrafico = (new ConteoFiestasPopularesGrafico())
            ->cargar($args)
            ->aObjetoSimple();
    }

    private function actualizarTablero()
    {
        $this->actualizarContadores();
        $this->actualizarGrafico();
    }

    private function actualizarGrafico()
    {
        $this->emit('contadoresporFiestaGrafico.parametrosActualizados', [
            'categorias' =>  $this->conteoFiestasPopularesGrafico['categorias'],
            'valores'   =>  $this->conteoFiestasPopularesGrafico['valores'],
            'colores'   =>  $this->conteoFiestasPopularesGrafico['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresporFiesta.parametrosActualizados', [
            'categorias'    => $this->conteoFiestasPopulares['categorias'],
            'valores'       => $this->conteoFiestasPopulares['valores']
        ]);
        
        $this->emit('contadoresporFiesta2.parametrosActualizados', [
            'categorias'    => $this->conteoFiestasPopulares2['categorias'],
            'valores'       => $this->conteoFiestasPopulares2['valores']
        ]);

        // $this->emit('contadoresporPoblacionProvincial.parametrosActualizados', [
        //     'categorias'    => $this->conteoPoblacionProvincial['categorias'],
        //     'valores'       => $this->conteoPoblacionProvincial['valores']
        // ]);
    }
}
