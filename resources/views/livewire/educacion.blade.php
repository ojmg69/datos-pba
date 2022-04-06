<div class="row">
    <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->

    <div class="col-5 col-sm-5 col-md-5">
        @include('mapa.mapa')
    </div>

    <div class="col-7 col-sm-7 col-md-7" style="background-color: #015875; color:#ffffff">
        <div class="card" style="background-color: #015875; color:#ffffff">
            @switch($visual)
                @case('escuelas')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Educación', 'Escuelas'] ])
                @break
                @case('universidades-terciarios')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Educación', 'Universidades y Terciarios'] ])
                @break
                @case('indicadores')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Educación', 'Indicadores'] ])
                @break
                @case('matricula')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Educación', 'Matriculas'] ])
                @break
            @endswitch
            <!-- /.card-header -->
            <div class="card-body">

                <div class="col-12">

                    @switch($visual)
                        @case('escuelas')
                        @livewire('educacion-escuelas')
                        @break
                        @case('universidades-terciarios')
                        @livewire('educacion-universidades-terciarios')
                        @break
                        @case('indicadores')
                        @livewire('educacion-indicadores')
                        @break
                        @case('matricula')
                        @livewire('educacion-matricula')
                        @break
                    @endswitch

                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
