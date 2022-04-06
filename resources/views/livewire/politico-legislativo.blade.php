<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Legislatura - Organigrama</h3>
        </div>
        <hr>
        @switch($vista)
            @case("detalle")
            <hr>
            <div class="box-body row">
                <div class="col-7">
                    <h4><b>Organismo:</b> {{ $datosLegislatura->organismo }}</h4>
                    <hr>
                    <h4><b>Autoridad:</b> {{ $datosLegislatura->nombre_autoridad }}</h4>
                    <hr>
                    <h4><b>Contacto: </b>{{ $datosLegislatura->contacto }}</h4>
                    @if ($datosLegislatura->descripcion != null)
                        <h4><a wire:click="mostrarDescripcion()" href="#">Leer Descripción completa</a></h4>
                    @endif


                </div>
                <div class="col-5 d-flex justify-content-center">

                    <img style="border-radius: 50%" width="240px" height="240px"
                        src="{{ url('img/img_legislativos/' . $datosLegislatura->imagen) }}" alt="Image" />
                </div>
                @if ($descripcion == true)
                    <div class="col-12">
                        <h4><b>Información: </b></h4>
                        <div class="row">
                            <div class="m-1" style="height: 250px;overflow-y: scroll; text-align:justify; padding:10px;">
                                {!! nl2br ($datosLegislatura->descripcion) !!}
                            </div>
                            <hr>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" wire:click="minimizar()" class="btn btn-info">
                        <i class="fa fa-window-close"> Minimizar</i>
                    </button>
                @endif
            </div>
            <hr>
            <div class="row">
                <hr>
                <button class="btn btn-info" wire:click="obtenerVistaPrincipal">Volver
                    al listado completo</button>
            </div>
            @break
            @case("general")
            <div class="box-body">
                <form>
                    <div class="form-group col-5">
                        <div class="row">
                            <div class="col-5">
                                <h4>Cámara:</h4>
                            </div>
                            <div class="col-6">
                                <select wire:model="tipo_leg" name="tipoSeleccionado" class="form-control">
                                    <option value="senadores">Senadores</option>
                                    <option value="diputados">Diputados</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($tipo_leg == 'senadores')
                    <!-- Three columns of text below the carousel -->
                    <h3>Honorable Cámara de Senadores</h3><br>
                    <div class="row d-flex justify-content-center">
                        @foreach ($datosSenadores as $sen)
                            @if (str_contains($sen->tipo_autoridad, 'President'))
                                <div class="col-lg-3" align="center">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                        src="{{ url('img/img_legislativos/' . $sen->imagen) }}" />
                                    <h5>{{ $sen->nombre_autoridad }}</h5>
                                    <p>-- {{ $sen->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sen->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            @endif
                        @endforeach
                    </div>
                    <hr>

                    <div class="row d-flex justify-content-center">
                        @foreach ($datosSenadores as $sen)
                            @if (str_contains($sen->tipo_autoridad, 'Vicepresident'))
                                <div class="col-lg-3" align="center">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                        src="{{ url('img/img_legislativos/' . $sen->imagen) }}" />

                                    <h5>{{ $sen->nombre_autoridad }}</h5>
                                    <p>-- {{ $sen->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sen->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-center">
                        @foreach ($datosSenadores as $sen)
                            @if (str_contains($sen->tipo_autoridad, 'Secre') || str_contains($sen->tipo_autoridad, 'Pro'))
                                <div class="col-lg-3" align="center">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                        src="{{ url('img/img_legislativos/' . $sen->imagen) }}" />

                                    <h5>{{ $sen->nombre_autoridad }}</h5>
                                    <p>-- {{ $sen->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $sen->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            @endif
                        @endforeach
                    </div>
                    <hr>
                @else
                    <h3>Honorable Cámara de Diputados</h3><br>
                    <div class="row d-flex justify-content-center">
                        @foreach ($datosDiputados as $dip)
                            @if (str_contains($dip->tipo_autoridad, 'President'))
                                <div class="col-lg-3" align="center">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                        src="{{ url('img/img_legislativos/' . $dip->imagen) }}" />
                                    <h5>{{ $dip->nombre_autoridad }}</h5>
                                    <p>-- {{ $dip->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $dip->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            @endif
                        @endforeach
                    </div>
                    <hr>

                    <div class="row d-flex justify-content-center">
                        @foreach ($datosDiputados as $dip)
                            @if (str_contains($dip->tipo_autoridad, 'Vicepresident'))
                                <div class="col-lg-3" align="center">
                                    <img style="border-radius: 50%" width="140px" height="140px"
                                        src="{{ url('img/img_legislativos/' . $dip->imagen) }}" />

                                    <h5>{{ $dip->nombre_autoridad }}</h5>
                                    <p>-- {{ $dip->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $dip->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-center">
                        @foreach ($datosDiputados as $dip)
                            @if (str_contains($dip->tipo_autoridad, 'Secre') || str_contains($dip->tipo_autoridad, 'Pro'))
                                <div class="col-lg-3" align="center">
                                    @if (is_null($dip->imagen) || $dip->imagen == '')
                                        <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                            preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%"
                                                fill="#777" dy=".3em">140x140</text>
                                        </svg>

                                    @else
                                        <img style="border-radius: 50%" width="140px" height="140px"
                                            src="{{ url('img/img_legislativos/' . $dip->imagen) }}" />
                                    @endif
                                    <h5>{{ $dip->nombre_autoridad }}</h5>
                                    <p>-- {{ $dip->tipo_autoridad }} --</p>
                                    <p><a class="btn btn-info" wire:click="verDetalle({{ $dip->id }})" href="#"
                                            role="button">Ver detalles</a></p>
                                </div><!-- /.col-lg-4 -->
                            @endif
                        @endforeach
                    </div>
                    <hr>
                @endif

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
