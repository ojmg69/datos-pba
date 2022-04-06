<?php

namespace App\Http\Livewire;

use App\Distrito;
use App\Seccion;
use Livewire\Component;

class GeneroRepresentatividadPolitica extends Component
{
    public $vista = 'todos';
    public $municipio;
    public $pines = [];
    public $estilos = [];
    public $RESALTADO = "#8E44AD";
    public $referencias;
    public $listeners = [
        'selectorClickeado',
        'clickEnMunicipio',
        'clickEnSeccion',
        'clickEnTodosLosMunicipios' => 'restaurarMapa',
        'clickEnTodasLasSecciones'  => 'restaurarMapa',
        'clickEnRestaurar'          => 'restaurarMapa'
    ];

    public function mount()
    {
        $this->estilos = $this->pintarDistritos('todos');
        $this->referencias = [[
            'nombre'    =>  'Con Paridad de Género en HCD',
            'relleno'   =>  $this->RESALTADO
        ]];
    }

    public function render()
    {
        return view('livewire.genero-representatividad-politica');
    }

    public function selectorClickeado($valor)
    {
        switch ($valor) {
            case 'todos':
                $this->vista = 'todos';
                break;
            case 'FDT':
                $this->vista = 'fdt';
                break;
            case 'JXC':
                $this->vista = 'jxc';
                break;
            case 'Otros':
                $this->vista = 'otros';
                break;
        }
        $this->emit('cambioTabla', $this->municipio);
        $this->estilos = $this->pintarDistritos($this->vista);
        $this->dispatchBrowserEvent('pintarEstilos', $this->estilos);
    }

    /**
     * Pinta los distritos con mayoria de concejalas de un color
     * 
     * $partido: toma el valor del partido a tener en cuenta (todos, fdt, jxc, otros)
     */
    private function pintarDistritos($partido)
    {
        $tablas_por_partido = [
            "todos"     => [ "total_concejales", "concejalas" ],
            "fdt"       => [ "total_concejales_fdt", "concejalas_fdt" ],
            "jxc"       => [ "total_concejales_jxc", "concejalas_jxc" ],
            "otros"     => [ "total_concejales_otros_partidos", "concejalas_otros_partidos" ],
        ];

        $tablas = $tablas_por_partido[$partido];

        $distritos = Distrito::
            join('representatividad_politica', 'representatividad_politica.distrito_id', '=', 'distritos.id')
            ->select(
                'distritos.*',
                'representatividad_politica.' . $tablas[0],
                'representatividad_politica.' . $tablas[1],
            )
            ->get();

        $estilos = [];

        foreach ($distritos as $distrito) {
            $concejales = $distrito->total_concejales;
            $concejalas = $distrito->concejalas;
            $porcentaje = $concejales > 0
                ?   $concejalas / $concejales
                :   0;

            if ($porcentaje > 0.49)
            {
                $estilo = [
                    'id'        => $distrito->id,
                    'relleno'   => $this->RESALTADO
                ];
                array_push($estilos, $estilo);
            }
        }

        return $estilos;
    }

    public function restaurarMapa() {
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención']);
        $this->municipio= null;
        $this->emit('cambioTabla', $this->municipio);
    }

    public function clickEnMunicipio($id){
        $this->municipio= $id;
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención', Distrito::find($id)->nombre]);
    }

    public function clickEnSeccion($id){
        $this->emit('arbol-navegabilidad.rutaActualizada', ['Eje Género', 'Espacios de Contención', Seccion::find($id)->nombre]);
    }
}
