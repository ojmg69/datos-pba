<div class="row">
    <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->
   
    <div class="col-5 col-sm-5 col-md-5">
        @include('mapa.mapa')
    </div>
 
    <div class="col-7 col-sm-7 col-md-7" style="position:relative; background-color: #015875; color:#ffffff">
        <div class="card" style="background-color: #015875; color:#ffffff">
            @switch($visual)
                @case('regiones')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Sanitario', 'Regiones Sanitarias'] ])
                @break
                @case('establecimientos')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Sanitario', 'Establecimientos Sanitarios'] ])
                @break
                       
            @endswitch
            <!-- /.card-header -->
            <div class="card-body">

                <div class="col-12">

                    @switch($visual)
                        @case('regiones')
                        @livewire('sanitario-regiones')
                        @break
                        @case('establecimientos')
                        @livewire('sanitario-establecimientos')
                        @break
                       
                    @endswitch

                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@stop

