<div>
    <div class="row">
        <div id="ID_UNICO_001" class="col-5 col-sm-5 col-md-5">
            @include('mapa.mapa')
        </div>

        <div id="ID_UNICO_002" class="col-7 col-sm-7 col-md-7" style="position:relative; background-color: #015875; color:#ffffff">
            <div class="card" style="background-color: #015875; color:#ffffff">
                @switch($visual)
                    @case('politicas-locales')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Medioambiente', 'Políticas Locales'] ])
                    @break
                @endswitch
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="col-12">

                        @switch($visual)
                            @case('politicas-locales')
                            @livewire('medioambiente-politicas-locales')
                            @break
                        @endswitch

                    </div>

                </div>
                <!-- /.card-body -->
            </div>

        </div>


    </div>

</div>
