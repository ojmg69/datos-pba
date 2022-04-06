<div class="col-12">
    <div class="box col-12">
        
        @if ($vista == 'general' || $vista == 'tablero')
            <div class="box-header" style="display: flex; justify-content: space-between;">
                <h3 class="box-title">Ministerios</h3>
                @if ($vista == 'general')
                    <button class="btn btn-info" wire:click="verTablero">Volver a vista principal</button>
                @endif
            </div>  
        @endif


        @switch($vista)
            @case('tablero')
                <hr>
                @livewire('tablero-contadores-por-categoria', [
                    'nombre'        => 'Clasificación',
                    'idGrafico'     => 'contadoresporBloque',
                    'categorias'    => ['MINISTERIOS', 'SUBSECRETARÍAS'],
                    'valores'       => [$cantidadMinisterios, $cantidadSubsecretarios],
                    'ordenar'       => ['categorias', 'asc']
                ])

                @livewire('tablero-contadores-por-categoria', [
                    'nombre'        => 'Por Género',
                    'idGrafico'     => 'contadoresPorGenero',
                    'categorias'    => ['Ministros', 'Ministras'],
                    'valores'       => [$cantidadMinistros, $cantidadMinistras],
                ])

                @livewire('tablero-grafico-dona', [
                    'nombre'    =>  'Gráfico por Género',
                    'idGrafico' =>  'graficoGenero',
                    'categorias'=>  ['MINISTROS', 'MINISTRAS'],
                    'colores'   =>  $coloresGrafico,
                    'valores'   =>  [$cantidadMinistros, $cantidadMinistras],
                ])

                <div style="display: flex; justify-content: flex-end">
                    <button class="btn btn-info" wire:click="verGeneral">Ver detalles</button>
                </div>
            @break


            @case('general')
            <hr>
            <div class="box-body">
                <form>
                    <div class="form-group col-8">
                        <div class="row">
                            <div class="col-4">
                                <label>Ministerio:</label>
                            </div>
                            <div class="col-8">
                                <select wire:model="id_ministerio" name="ministerio" class="form-control">
                                    {{-- <option>--Seleccione un Rubro--</option> --}}

                                    @foreach ($ministerios as $min)
                                        <option value="{{ $min['id'] }}">{{ $min['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>

                <div class="row d-flex justify-content-center" style="height: 600px; overflow-y: scroll;">
                    @foreach ($DatosFuncionarios as $func)
                        @if ($orden == 1)
                            @if($detalle == "no")
                                <div class="col-12">
                                    <h4><img style="border-radius: 50%" width="70px" height="70px"
                                        src="{{ url('img/ministros/' . $func->img) }}" />
                                   {{ $func->cargo }}:</b> {{ $func->nombre }}
                                   <button type="button" wire:click="verDetalle({{$func->id}})" class="btn btn-info"><i class="fas fa-search"></i></i></button></h4><b>

                                    <hr class="bg-info">
                                </div>


                            @else
                            <div class="row">


                                <div class="col-7">
                                    <hr>
                                    <h4><b>Autoridad:</b> {{ $datosFuncionario->nombre }}</h4>
                                    <hr>
                                    <h4><b>Cargo:</b> {{ $datosFuncionario->cargo }}</h4>
                                    <hr>
                                    <h4><b>Descripción:</b><h6> 
                                    {!! nl2br ($datosFuncionario->descrip) !!}
                                    </h6></h4>
                                    <hr>
                                    @if ($datosFuncionario->telefono)
                                        <h4><b>Contacto: </b>{{ $datosFuncionario->telefono }}</h4>
                                        <hr>
                                    @endif


                                </div>
                                <div class="col-5 d-flex justify-content-center">

                                    <img style="border-radius: 50%" width="240px" height="240px"
                                        src="{{ url('img/ministros/' . $datosFuncionario->img) }}" alt="Image" />


                                </div>
                                <button type="button" wire:click="verGeneral()" class="btn btn-info">Minimizar</button>
                            </div>
                            @endif

                            <b>
                            <hr class="bg-info">

                            @php
                                $orden++;
                            @endphp

                        @else
                            @if ($orden == $func->orden)
                                <div class="col-13">
                                    <h5><b>{{ $func->cargo }}:</b> {{ $func->nombre }}</h5>
                                </div>
                            @else

                                <div class="col-12">
                                    <hr class="bg-info">
                                    <h5><b><font color="#2cc8e0">  {{ $func->cargo }}:</font></b> {{ $func->nombre }}</h5>
                                </div>
                                @php
                                    $orden = $func->orden;
                                @endphp
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            @break
                
        @endswitch



    </div>

</div>

@section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
        });

    </script>


@stop
