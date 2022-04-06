<div>
    <div class="row">
        <div id="ID_UNICO_001" class="col-5 col-sm-5 col-md-5">
            @include('mapa.mapa')
        </div>

        <div id="ID_UNICO_002" class="col-7 col-sm-7 col-md-7" style="position:relative; background-color: #015875; color:#ffffff">
            <div class="card" style="background-color: #015875; color:#ffffff">
                @switch($visual)
                    @case('areas-municipales')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Género', 'Areas Municipales'] ])
                    @break
                    @case('comisarias-mujer')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Género', 'Comisarías de la Mujer'] ])
                    @break
                    {{-- @case('convenios')
                    @livewire('genero-convenios')
                    @break
                    @case('programas-asistencias')
                    @livewire('genero-programas-asistencias')
                    @break --}}
                    @case('espacios-contencion')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Género', 'Espacios de Contención'] ])
                    @break
                    @case('representatividad-politica')
                    @livewire('arbol-navegabilidad', [ 'ruta' => ['Eje Género', 'Representatividad Política'] ])
                    @break
                    {{-- @case('capacitacion')
                    @livewire('genero-capacitacion')
                    @break
                    @case('camp.prevencion')
                    @livewire('genero-camp.prevencion')
                    @break
                    @case('prog-lgbtttiq+')
                    @livewire('genero-prog-lgbtttiq+')
                    @break
                    @case('estadisticas')
                    @livewire('genero-estadisticas')
                    @break --}}
                @endswitch
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="col-12">

                        @switch($visual)
                            @case('areas-municipales')
                            @livewire('genero-areas-municipales')
                            @break
                            @case('comisarias-mujer')
                            @livewire('genero-comisarias-mujer')
                            @break
                            {{-- @case('convenios')
                            @livewire('genero-convenios')
                            @break
                            @case('programas-asistencias')
                            @livewire('genero-programas-asistencias')
                            @break --}}
                            @case('espacios-contencion')
                            @livewire('genero-espacios-contencion')
                            @break
                            @case('representatividad-politica')
                            @livewire('genero-representatividad-politica')
                            @break
     {{--                        @case('capacitacion')
                            @livewire('genero-capacitacion')
                            @break
                            @case('camp.prevencion')
                            @livewire('genero-camp.prevencion')
                            @break
                            @case('prog-lgbtttiq+')
                            @livewire('genero-prog-lgbtttiq+')
                            @break
                            @case('estadisticas')
                            @livewire('genero-estadisticas')
                            @break --}}
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