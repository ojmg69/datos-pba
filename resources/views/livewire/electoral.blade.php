<div>
    <div class="row">
        <div id="ID_UNICO_001" class="col-5 col-sm-5 col-md-5">
            @include('mapa.mapa')
        </div>

        <div id="ID_UNICO_002" class="col-7 col-sm-7 col-md-7" style="position:relative; background-color: #015875; color:#ffffff">
            <div class="card" style="background-color: #015875; color:#ffffff">
                @switch($visual)
                    @case('resultados')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Electoral', 'Resultados Electorales'] ])
                    @break
                    @case('electores-inscriptos')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Electoral', 'Electores Inscriptos'] ])
                    @break
                @endswitch
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="col-12">

                        @switch($visual)
                            @case('resultados')
                            @livewire('electoral-resultados-electorales')
                            @break
                            @case('electores-inscriptos')
                            @livewire('electoral-electores-inscriptos')
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