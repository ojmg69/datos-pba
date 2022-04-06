<div class="row">
    <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->

    <div class="col-5 col-sm-5 col-md-5">
        @include('mapa.mapa')
    </div>

    <div class="col-7 col-sm-7 col-md-7" style="background-color: #015875; color:#ffffff">
        <div class="card" style="background-color: #015875; color:#ffffff">

            @switch($visual)
                @case('agrupamientos-industriales')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Productivo', 'Agrupamientos Industriales'] ])
                @break
                @case('puertos')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Productivo', 'Puertos'] ])
                @break
                @case('empresas')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Productivo', 'Empresas'] ])
                @break
                @case('parques-eolicos')
                @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Productivo', 'Parques Eolicos'] ])
                @break
            @endswitch
            

            <!-- /.card-header -->
            <div class="card-body">

                <div class="col-12">

                    @switch($visual)
                        @case('agrupamientos-industriales')
                        @livewire('productivo-agrupamientos-industriales')
                        @break
                        @case('puertos')
                        @livewire('productivo-puertos')
                        @break
                        @case('empresas')
                        @livewire('productivo-empresas')
                        @break
                        @case('parques-eolicos')
                        @livewire('productivo-parques-eolicos')
                        @break
                    @endswitch

                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
