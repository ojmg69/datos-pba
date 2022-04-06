<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Sedes Organismos Nacionales y Provinciales</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <h3>Módulo deshabilitado</h3>
                <hr>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
            </div>
            @break
            @case("general")
            <!-- /.box-header -->

            <div class="box-body">
                <hr>
                <form>
                    <div class="form-group col-5">
                        <label>Organismo:</label>
                        <select id="organismo" name="organismoSeleccionado" class="form-control">
                            <option value="todos">-- Todos --</option>
                            @foreach ($tiposOrganismo as $organismo)
                                <option value="{{ $organismo['nombre'] }}">{{ $organismo['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Organismo</th>
                            <th>Municipio</th>
                            <th>Sedes</th>
                            <th>Tipo</th>
                            <th>Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosOrganismo as $org)
                            <tr>
                                <td> {{ $org->organismo->nombre }}</td>
                                <td> {{ $org->distrito->nombre }}</td>
                                <td> {{ $org->sedes }} </td>
                                <td> {{ $org->organismo->tipo }}</td>
                                <td> {{ $org->contacto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @break

            @case("lista")
            <!-- /.box-header -->
            <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                al listado completo</button>
            <div class="box-body">
                <hr>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Organismo</th>
                            <th>Municipio</th>
                            <th>Sedes</th>
                            <th>Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosOrganismoLista as $org)
                            <tr>
                                <td> {{ $org->organismo->nombre }}</td>
                                <td> {{ $org->distrito->nombre }}</td>
                                <td> {{ $org->sedes }} </td>
                                <td> {{ $org->contacto }}</td>
                                <td>
                                    @if (!is_null($org->lat) && !is_null($org->lng))
                                        <button type="submit" wire:click="zoomEnOrganismo({{ $org->id }})"
                                            class="btn btn-info">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    @endif()
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @break

        @endswitch

    </div>

    @section('js')
        <script>
            window.addEventListener('mapaListo', evento => {
                const pines = JSON.parse('{!!  json_encode($this->pines) !!}')
                mapa.agregarPines(pines);

                const referencias = JSON.parse('{!!  json_encode($this->referencias) !!}')
                mapa.agregarReferencias(referencias, 'municipios');
                mapa.agregarReferencias(referencias, 'secciones', 'Organismos');

                mapa.quitarEstilos();
            });

            window.addEventListener('verDetalle', evento => {
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });

            window.addEventListener('clickEnLupita', evento => {
                const {
                    latitud,
                    longitud
                } = evento.detail
                if (latitud !== null && longitud !== null) {
                    mapa.enfocarPunto({
                        latitud,
                        longitud
                    })
                    mapa.alternarVisibilidadDeCalles(true)
                }
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });

        </script>
        <script>
            $('#organismo').on('change', function(evento) {
                const table = $('#tabla').DataTable();
                const nombreOganismo = evento.target.value

                if (nombreOganismo === "todos") {
                    table.column(0)
                        .search("", true)
                        .draw();
                } else {
                    table.column(0)
                        .search(nombreOganismo, true)
                        .draw();
                }
            });

        </script>
    @stop

</div>
