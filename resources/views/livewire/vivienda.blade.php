<div class="row">
    <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->

    <div class="col-5 col-sm-5 col-md-5">
        @include('mapa.mapa')
    </div>


    <div class="col-7 col-sm-7 col-md-7" style="background-color: #015875; color:#ffffff">
        <div class="card" style="background-color: #015875; color:#ffffff">
            @switch($visual)
                @case('asentamientos')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Vivienda', 'Asentamientos'] ])
                @break
                @case('servicios')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Vivienda', 'Servicios'] ])
                @break
            @endswitch
            <!-- /.card-header -->
            <div class="card-body">

                <div class="col-12">

                    @switch($visual)
                        @case('asentamientos')
                        @livewire('vivienda-asentamiento')
                        @break
                        @case('servicios')
                        @livewire('vivienda-servicio')
                        @break
                    @endswitch

                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
