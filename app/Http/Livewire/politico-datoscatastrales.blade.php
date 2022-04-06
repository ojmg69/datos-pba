<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Datos Catastrales</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Municipio: </b>{{ $datosCatastrales->nombre }}</h4>
                    <hr>
                    <h4><b>Población: </b>{{ $datosCatastrales->poblacion }} habitantes</h4>
                    <h4><b>Superficie: </b>{{ $datosCatastrales->km2 }} Km2</h4>
                    <h4><b>Densidad demográfica:</b> {{ $datosCatastrales->densidad }} hab/Km2</h4>
                    <h4><b>Fundación:</b> {{ $datosCatastrales->fundacion }} </h4>
                    <hr>
                    <h4><b>Hermanamientos:</b></h4>
                    @if ($datosCatastrales->hermanamientos != '')
                        <div style="height: 50px; overflow-y:scroll">{{ $datosCatastrales->hermanamientos }}</div>
                    @else
                        <p>El municipio {{ $datosCatastrales->nombre }} no contiene hermanamientos.</p>
                    @endif
                </div>
                <div class="col-5 justify-content-center">

                    <img class="rounded" height="350px" width="350px" src="{{ url('/img/distritos/' . $datosCatastrales->imagen . '') }}"
                        alt="Image" />

                </div>
                <div class="col-12">
                    <hr>
                    <h4><b>Localidades:</b></h4>
                    <div class="p-3" style=" height: 100px;overflow-y: scroll; text-align:justify;">
                        @foreach ($localidades as $loc)
                            {{$loc->nombre}}<br>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <hr>
                    <h4><b>Historia:</b></h4>
                    <div class="p-3" style=" height: 200px;overflow-y: scroll; text-align:justify;">
                        {{ $datosCatastrales->historia }}</div>
                    <hr>
                </div>
                <hr>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver al listado completo</button>
            </div>
            @break
            @case("general")
            <!-- /.box-header -->

            <div class="box-body">
                <hr>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Población</th>
                            <th>Km2</th>
                            <th>Densidad Poblacional</th>
                            <th>Más Información</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosCatastrales as $loc)
                            <tr>
                                <td> {{ $loc->nombre }}</td>
                                <td> {{ $loc->poblacion }} hab</td>
                                <td> {{ $loc->km2 }} Km2</td>
                                <td> {{ $loc->densidad }} hab/Km2</td>
                                <td>
                                    <button type="submit" wire:click="verDetalle({{ $loc->id }})"
                                        class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Población</th>
                            <th>Km2</th>
                            <th>Densidad Poblacional</th>
                            <th>Más Información</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            @break
            @default

        @endswitch
        @section('js')
        <script>
            window.addEventListener('mapaListo', evento => {
                mapa.quitarEstilos()
                mapa.quitarReferencias()
                mapa.quitarPines()
                mapa.municipiosSiNoHayFoco()

                const idsMunicipiosResaltados = JSON.parse('{!! json_encode($idsMunicipiosResaltados) !!}')
                const relleno   = '{!! Config::get("constantes-mapa.estilos.resaltado.relleno") !!}'
                const borde     = '{!! Config::get("constantes-mapa.estilos.resaltado.borde") !!}'
                const estilos = idsMunicipiosResaltados.map(id => ({ id, relleno, borde }))

                mapa.pintarMunicipios(estilos)
                mapa.agregarReferencias([{ nombre: '-MUNICIPIOS CON HERMANAMIENTOS- ㅤㅤㅤⓘEl hermanamiento de ciudades es un concepto por el cual ciudades de distintas zonas geográficas y políticas se emparejan para fomentar el contacto humano y enlaces culturales. ', relleno, borde }], 'municipios')
            });

            window.addEventListener('clickEnLupita', evento => {
                const id = evento.detail;
                mapa.mostrarMunicipio(id)
            });
        </script>
        @stop
    </div>
</div>
