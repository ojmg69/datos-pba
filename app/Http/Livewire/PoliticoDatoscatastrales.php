<?php

namespace App\Http\Livewire;

use App\Conteo\conteoPoblacion;
use App\Conteo\conteoPoblacionGrafico;
use App\Conteo\conteoPoblacionProvincial;
use App\Distrito;
use App\Localidad;
use Livewire\Component;

class PoliticoDatoscatastrales extends Component
{

    public $datosCatastrales;
    public $vista;
    public $idsMunicipiosResaltados;
    public $validado;
    public $localidades;
    public $conteoPoblacion;
    public $conteoPoblacionProvincial;
    public $conteoPoblacionGrafico;
    public $idSeccion;
    public $idMunicipio;

    protected $listeners = [
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        'clickEnRestaurar'          => 'restaurarMapa',
        'verDetalle'
    ];

    public function mount()
    {
        $this->vista = "tablero";
        $this->cargarDatosTablero();
        $this->datosCatastrales = Distrito::all();
        $this->idsMunicipiosResaltados = $this->buscarMunicipiosQueResaltar();

        }


    public function render()
    {
        return view('livewire.politico-datoscatastrales');
    }

    public function mostrarTodosLosMunicipios() {
        $this->vista = "general";
        $this->datosCatastrales = Distrito::all();
    }

    public function obtenerVistaPrincipal()
    {
        $this->dispatchBrowserEvent('limpiarStorage', ['data' => '/politico-institucional/catastrales']);
    }

    public function verDetalle($id)
    {
        $this->datosCatastrales = Distrito::find($id);
        $this->localidades = Localidad::where('distrito_id','=',$id)->get();
        $this->vista = 'detalle';
        $this->dispatchBrowserEvent('clickEnLupita', $id);
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
        $this->datosCatastrales = Distrito::where('id', $id)->get();
        $this->localidades = Localidad::where('distrito_id','=',$id)->get();
    }
    
    public function clickEnSeccion($id)
    {
        $this->idSeccion = $id;
        $this->idMunicipio = null;
        $this->cargarDatosTablero(['idSeccion' => $id]);
        $this->actualizarTablero();
        $this->datosCatastrales = Distrito::where('seccion_id', $this->idSeccion)->get();
        $this->localidades = Localidad::where('distrito_id','=',$id)->get();
    }


    public function buscarMunicipiosQueResaltar() {
        return Distrito::select('id')
            ->where('hermanamientos','!=',"")
            ->get()
             ->map(function ($distrito) { return $distrito->id; })
            ->toArray();
    }

    public function verTablero()
    {
        $this->vista = 'tablero';
        $this->actualizarTablero();
    }

    public function cargarDatosTablero($args = null)
    {

        $this->conteoPoblacion = (new conteoPoblacion())
            ->cargar($args)
            ->aObjetoSimple();

        $this->conteoPoblacionProvincial = (new conteoPoblacionProvincial())
            ->cargar($args)
            ->aObjetoSimple();
        
        $this->conteoPoblacionGrafico = (new conteoPoblacionGrafico())
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
        $this->emit('conteoPoblacionGrafico.parametrosActualizados', [
            'categorias' =>  $this->conteoPoblacionGrafico['categorias'],
            'valores'   =>  $this->conteoPoblacionGrafico['valores'],
            'colores'   =>  $this->conteoPoblacionGrafico['colores'],
        ]);
    }

    private function actualizarContadores()
    {
        $this->emit('contadoresporPoblacion.parametrosActualizados', [
            'categorias'    => $this->conteoPoblacion['categorias'],
            'valores'       => $this->conteoPoblacion['valores']
        ]);

        $this->emit('contadoresporPoblacionProvincial.parametrosActualizados', [
            'categorias'    => $this->conteoPoblacionProvincial['categorias'],
            'valores'       => $this->conteoPoblacionProvincial['valores']
        ]);
    }

    public function verGeneral()
    {
        $this->vista = 'general';
        $this->datosCatastrales = $this->idMunicipio 
                ? Distrito::where('id', $this->idMunicipio)->get() 
                : ($this->idSeccion ? Distrito::where('seccion_id', $this->idSeccion)->get() 
                : Distrito::all());
    }
}
