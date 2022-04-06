<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Suprema Corte de Justicia de la Provincia de Buenos Aires</h3>
        </div>


        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Cargo:</b> {{ $datosSupCorte->tipo_autoridad }}</h4>
                    <hr>
                    <h4><b>Autoridad:</b> {{ $datosSupCorte->nombre_autoridad }}</h4>
                    <hr>

                    @if ($datosSupCorte->descripcion != null)
                        <h4><b>Descripción:</b></h4>
                        <p>{{ $datosSupCorte->descripcion }}</p>
                    @endif
                    <h4><b>Contacto: </b>{{ $datosSupCorte->contacto }}</h4>
                </div>
                <div class="col-5 d-flex justify-content-center">

                    <img style="border-radius: 50%" width="140px" height="140px"
                    src="{{ url('img/img_supr_corte/' . $datosSupCorte->imagen) }}" />
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
                <div class="row d-flex justify-content-center">
                    @foreach ($datosSupCorte as $sup)
                        @if (str_contains($sup->tipo_autoridad, 'President'))
                            <div class="row">
                                <div class="col-6">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                    src="{{ url('img/img_supr_corte/' . $sup->imagen) }}" />
                                </div>
                                <div class="col-6">
                                    <h5>{{ $sup->nombre_autoridad }}</h5>
                                    <p>-- {{ $sup->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sup->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr>

                <div class="row d-flex justify-content-center">
                    @foreach ($datosSupCorte as $sup)
                        @if (str_contains($sup->tipo_autoridad, 'Vicepresident'))
                            <div class="row">
                                <div class="col-6">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                    src="{{ url('img/img_supr_corte/' . $sup->imagen) }}" />
                                </div>
                                <div class="col-6">
                                    <h5>{{ $sup->nombre_autoridad }}</h5>
                                    <p>-- {{ $sup->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sup->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr>
                <div class="row d-flex justify-content-center">
                    @foreach ($datosSupCorte as $sup)
                        @if (str_contains($sup->tipo_autoridad, 'Min'))
                            <div class="col-lg-3" align="center">
                                <img style="border-radius: 50%" width="140px" height="140px"
                                    src="{{ url('img/img_supr_corte/' . $sup->imagen) }}" />

                                <h5>{{ $sup->nombre_autoridad }}</h5>
                                <p>-- {{ $sup->tipo_autoridad }} --</p>
                                <p><a class="btn btn-info" wire:click="verDetalle({{ $sup->id }})" href="#"
                                        role="button">Ver detalles</a></p>
                            </div><!-- /.col-lg-4 -->
                        @endif
                    @endforeach
                </div>
                <hr>
                <div class="row d-flex justify-content-center">
                    @foreach ($datosSupCorte as $sup)
                        @if (str_contains($sup->tipo_autoridad, 'Proc'))
                            <div class="row">
                                <div class="col-6">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                    src="{{ url('img/img_supr_corte/' . $sup->imagen) }}" />
                                </div>
                                <div class="col-6">
                                    <h5>{{ $sup->nombre_autoridad }}</h5>
                                    <p>-- {{ $sup->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sup->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            </div>
                        @endif
                    @endforeach
                </div>


            </div>
            @break
            @default

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
