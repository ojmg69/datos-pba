<div>
    <div class="row">
        <div id="ID_UNICO_001" class="col-5 col-sm-5 col-md-5">
            @include('mapa.mapa')
        </div>

        <div id="ID_UNICO_002" class="col-7 col-sm-7 col-md-7" style="position:relative; background-color: #015875; color:#ffffff">
            <div class="card" style="background-color: #015875; color:#ffffff">
                @switch($visual)
                            @case('intendente')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Intendentes'] ])
                            @break
                            @case('concejo_deliberante')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Honorable Concejo Deliberante'] ])
                            @break
                            @case('catastrales')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Catastrales'] ])
                            @break
                            @case('fiestas_populares')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Fiestas Populares'] ])
                            @break
                            @case('sup_corte')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Suprema Corte'] ])
                            @break
                            @case('judicial')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Judicial'] ])
                            @break
                            @case('trib_juzg')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Tribunal de Justicia'] ])
                            @break
                            @case('constitucion')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Constitucion'] ])
                            @break
                            @case('organismos')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Organismos'] ])
                            @break
                            @case('sedes')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Sedes'] ])
                            @break
                            @case('arzobispado')
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Arzobispado'] ])
                            @break
                            @case('consulados')
                            @default
                            @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Municipios', 'Consulados'] ])
                @endswitch
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="col-12">

                        @switch($visual)
                            @case('intendente')
                            @livewire('municipio-intendentes')
                            @break
                            @case('concejo_deliberante')
                            @livewire('municipio-concejodeliberante')
                            @break
                            @case('catastrales')
                            @livewire('municipios-datoscatastrales')
                            @break
                            @case('fiestas_populares')
                            @livewire('municipio-fiestas-populares')
                            @break
                            @case('sup_corte')
                            @livewire('politico-sup_corte')
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
                            @livewire('politico-organismos')
                            @break
                            @case('sedes')
                            @livewire('politico-sedes')
                            @break
                            @case('arzobispado')
                            @livewire('politico-arzobispado')
                            @break
                            @case('consulados')
                            @default
                            @livewire('municipio-consulado')
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
        <script>
            $(function() {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                });
            });

        </script>
    @stop
</div>