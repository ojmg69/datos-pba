<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Organismos de la Constitución</h3>
        </div>


        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Cargo:</b> {{ $datosConstitucion->autoridad }}</h4>
                    <hr>
                    <h4><b>Autoridad:</b> {{ $datosConstitucion->nombre }}</h4>
                    <hr>
                    <h4><b>Descripción:</b></h4>
                    <p>{{ $datosConstitucion->resenia }}</p>
                    <h4><b>Contacto:</b>{{ $datosConstitucion->contacto }}</h4>
                </div>
                <div class="col-5 justifiy-content-center">

                </div>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
                {{-- <a href="{{ route('politico.index', ['tipo' => 'ejecutivo']) }}" class="btn btn-info" wire:click="">Volver
                    al listado completo</a> --}}
            </div>
            @break
            @case("general")
            <!-- /.box-header -->

            <div class="box-body">
                <hr>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Organismo</th>
                            <th>Cargo</th>
                            <th>Autoridad</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosConstitucion as $con)
                            <tr>
                                <td> {{ $con->organismo }}</td>
                                <td> {{ $con->autoridad }} </td>
                                <td> {{ $con->nombre }} </td>
                                <td><button type="submit" wire:click="verDetalle({{ $con->id }})" class="btn btn-info"><i
                                            class="fas fa-search"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Organismo</th>
                            <th>Cargo</th>
                            <th>Autoridad</th>
                            <th>Detalles</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            @break
            @default

        @endswitch




    </div>
    @section('js')

    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipiosSiNoHayFoco()
        });
    </script>

    @stop

</div>
