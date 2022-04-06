<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Datos Políticos</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body">
                
                <h4><b>Intendente:</b> {{$datosPoliticos->intendente}}</h4><hr>
                <h4><b>Partido:</b> {{$datosPoliticos->nombre}}</h4><hr>
                <h4><b>Población:</b> {{$datosPoliticos->poblacion}} habitantes</h4>
                <h4><b>Kilómetros 2: </b> {{$datosPoliticos->km2}} Kms2</h4>
                <h4><b>Densidad Demográfica: </b> {{$datosPoliticos->densidad}} hab/Km2</h4><hr>
                <button class="btn btn-primary" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
                {{-- <a href="{{ route('politico.index',['tipo' => 'datos_politicos']) }}" class="btn btn-info" wire:click="">Volver al listado completo</a> --}}
            </div>
            @break
            @case("general")
            <!-- /.box-header -->
           
            <div class="box-body">
                <hr>
                <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Intendente</th>
                            <th>Población</th>
                            <th>Km 2</th>
                            <th>Densidad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosPoliticos as $loc)
                            <tr>
                                <td> {{ $loc->nombre }}</td>
                                <td> {{ $loc->intendente }}</td>
                                <td> {{ $loc->poblacion }} hab</td>
                                <td> {{ $loc->km2 }} Km2</td>
                                <td> {{ $loc->densidad }} hab/Km2</td>
                                <td><button type="submit" wire:click="verDetalle({{ $loc->id }})" class="btn btn-info"><i
                                            class="fas fa-search"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Cabecera</th>
                            <th>Población</th>
                            <th>Km 2</th>
                            <th>Densidad</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            @break
            @default

        @endswitch




    </div>
</div>
