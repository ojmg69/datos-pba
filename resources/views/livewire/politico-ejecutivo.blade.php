<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Datos Políticos</h3>
        </div>

        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Intendente:</b> {{ $datosPoliticos->intendente }}</h4>
                    <hr>
                    <h4><b>Partido:</b> {{ $datosPoliticos->nombre }}</h4>
                    <hr>
                    <h4><b>Descripción:</b></h4>
                    <p>"La Plata, 12 de febrero de 1972 es un abogado y político argentino perteneciente al partido Propuesta Republicana.
                        Fue diputado de la provincia de Buenos Aires y desde el 10 de diciembre de 2015 es intendente de La Plata por la coalición Juntos por el Cambio."</p>
                </div>
                <div class="col-5 justifiy-content-center">
                    @if ($datosPoliticos->id == 93)
                        <img width="80%" src="{{ url('/img/JulioGarrointendenteLaPlata.jpg') }}" alt="Image" />
                    @endif
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

@push('scripts')

<script>
    
</script>

@endpush

