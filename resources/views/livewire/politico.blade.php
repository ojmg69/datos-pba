<div class="row">
    <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->

    <div class="col-5 col-sm-5 col-md-5">
        @include('mapa.mapa')
    </div>

    <div class="col-7 col-sm-7 col-md-7" style="background-color: #015875; color:#ffffff">
        <div class="card" style="background-color: #015875; color:#ffffff">
            @switch($visual)
                        @case('ejecutivo')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo'] ])
                        @break
                        @case('concejo_deliberante')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Honorable Concejo Deliberante'] ])
                        @break
                        @case('datos_politicos')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Concejo Deliberante'] ])
                        @break
                        @case('catastrales')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Información General'] ])
                        @break
                        @case('legislativo')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Legislativo'] ])
                        @break
                        @case('legislador')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Legislativo', 'Legisladores'] ])
                        @break
                        @case('supr_corte')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Judicial', 'Suprema Corte'] ])
                        @break
                        @case('judicial')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Judicial'] ])
                        @break
                        @case('trib_juzg')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Concejo Deliberante'] ])
                        @break
                        @case('constitucion')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Org. de la Constitución'] ])
                        @break
                        @case('organismos')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Organismos Nac. y Prov.', 'Autoridades'] ])
                        @break
                        @case('sedes')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Sedes Organismos Nac. y Prov.', 'Sedes'] ])
                        @break
                        @case('arzobispado')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Concejo Deliberante'] ])
                        @break
                        @case('departamentos-judiciales')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Judicial', 'Departamentos Judiciales'] ])
                        @break
                        @case('tribunales-juzgados')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Judicial', 'Tribunales y Juzgados'] ])
                        @break
                        @case('legisladores')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Concejo Deliberante'] ])
                        @break
                        @case('gobernacion')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Gobernación'] ])
                        @break
                        @case('vicegobernacion')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Vicegobernación'] ])
                        @break
                        @case('ministerios')
                        @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Institucional', 'Ejecutivo', 'Ministerios'] ])
                        @break
                    @endswitch
            <!-- /.card-header -->
            <div class="card-body">

                <div class="col-12">

                    @switch($visual)
                        @case('ejecutivo')
                        @livewire('politico-ejecutivo')
                        @break
                        @case('concejo_deliberante')
                        @livewire('politico-concejodeliberante')
                        @break
                        @case('datos_politicos')
                        @livewire('politico-datospoliticos')
                        @break
                        @case('catastrales')
                        @livewire('politico-datoscatastrales')
                        @break
                        @case('legislativo')
                        @livewire('politico-legislativo')
                        @break
                        @case('legislador')
                        @livewire('politico-legisladores')
                        @break
                        @case('supr_corte')
                        @livewire('politico-supr-corte')
                        @break
                        @case('judicial')
                        @livewire('politico-judicial')
                        @break
                        @case('trib_juzg')
                        @livewire('politico-trib_juzg')
                        @break
                        @case('constitucion')
                        @livewire('politico-constitucion')
                        @break
                        @case('organismos')
                        @livewire('politico-organismos', [ 'vista' => 'autoridades' ])
                        @break
                        @case('sedes')
                        @livewire('politico-organismos', [ 'vista' => 'sedes' ])
                        @break
                        @case('arzobispado')
                        @livewire('politico-arzobispado')
                        @break
                        @case('departamentos-judiciales')
                        @livewire('politico-departamentos-judiciales')
                        @break
                        @case('tribunales-juzgados')
                        @livewire('politico-tribunales-juzgados')
                        @break
                        @case('legisladores')
                        @livewire('politico-legisladores')
                        @break
                        @case('gobernacion')
                        @livewire('politico-gobernacion')
                        @break
                        @case('vicegobernacion')
                        @livewire('politico-vicegobernacion')
                        @break
                        @case('ministerios')
                        @livewire('politico-ministerio', [ 'id_ministerio' => '1' ])
                        @break
                    @endswitch

                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
