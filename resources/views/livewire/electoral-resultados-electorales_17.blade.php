<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Electoral - Resultados Electorales</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <form>
                <div class="form-group col-5">
                    <div class="row">
                        <div class="col-4">
                            <h4>Resultados:</h4>
                        </div>
                        <div class="col-6">
                            <select wire:model="tipo_resultado" name="tipoSeleccionado" class="form-control">
                                <option value="1">Presidente y Vice</option>
                                <option value="2">Gobernador y Vice</option>
                                <option value="3">Diputado Nacional</option>
                                <option value="4">Senador Provincial</option>
                                <option value="5">Diputado Provincial</option>
                                <option value="6">Cargos Municipales</option>

                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="box-body row">
                <div class="col-7">
                    <img style=width="100%" height="100%"
                        src="{{ url('img/img_eleccionesv5/' . $resultado[0]->img . '.png') }}" />
                </div>
                <div class="col-5 justifiy-content-center">
                </div>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
            </div>
            @break
            @case("general")
            <!-- /.box-header -->


            <div class="box-body">

                <hr>

                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Municipios</th>
                            <th>Resultados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosResultados as $resul)
                            <tr>
                                <td> {{ $resul->distrito->nombre }}</td>
                                <td>
                                    <button type="submit" wire:click="verDetalle({{ $resul->distrito_id }})"
                                        class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </button> Ver gráfica
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @break

            @case("lista")
            <!-- /.box-header -->

        <{{-- button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                al listado completo</button>
            <div class="box-body">
                <hr>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Municipio</th>
                            <th>Inscriptos</th>
                            <th>Votantes</th>
                            <th>Porcentaje Votantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosElectoresLista as $elec)
                            <tr>
                                <td> {{ $elec->distrito->nombre }}</td>
                                <td> {{ $elec->inscriptos }} </td>
                                <td> {{ $elec->votantes }}</td>
                                <td> {{ $elec->porc_votantes }} %</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Municipio</th>
                            <th>Inscriptos</th>
                            <th>Votantes</th>
                            <th>Porcentaje Votantes</th>
                        </tr>
                    </tfoot>
                </table>

            </div> --}} @break @endswitch </div>

            @section('js')
                <script>
                    window.addEventListener('mapaListo', evento => {
                        mapa.quitarEstilos()
                        mapa.quitarReferencias()
                        mapa.quitarPines()

                        const idsMunicipiosResaltados = JSON.parse('{!!  json_encode($idsMunicipiosResaltados) !!}')
                        const relleno = '{!!  Config::get('
                        constantes - mapa.estilos.resaltado.relleno ') !!}'
                        const borde = '{!!  Config::get('
                        constantes - mapa.estilos.resaltado.borde ') !!}'
                        const estilos = idsMunicipiosResaltados.map(id => ({
                            id,
                            relleno,
                            borde
                        }))
                    });

                    window.addEventListener('clickEnLupita', evento => {
                        const id = evento.detail;
                        mapa.mostrarMunicipio(id)
                    });

                </script>
            @stop

    </div>
