{{-- <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-group" role="group" aria-label="Opciones Ingresos">
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Composición de
                Ingresos</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Variación de
                Ingresos</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Ingresos por
                Áreas</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Ingresos
                Presupuestados</button>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="btn-group" role="group" aria-label="Opciones Egresos">
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Composición de
                Gastos</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Variación de
                Gastos</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Gastos por
                Áreas</button>
            <button type="button" class="btn btn-info" data-bs-toggle="button" autocomplete="off">Gastos
                Presupuestados</button>
        </div>
    </div>
</div>
--}}



<div class="row">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Información</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container">
                        <div class="col-12">
                            <h4><b>COMPOSICIÓN DE EGRESOS: LA PLATA</b></h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-5 bg-info p-8">
                                    <label for="exampleFormControlSelect1">Criterio de búsqueda:</label>
                                    <select wire:model="criterio" wire:change="cambiarVista()" name="criterio"
                                        class="form-control" id="seleccionCriterio">
                                        <option value="composicion_gastos">Composición de Gastos</option>
                                        <option value="">Varicación de Gastos</option>
                                        <option value="">Gastos por Área</option>
                                        <option value="">Gastos Presupuestados</option>
                                        <option value="composicion_ingresos">Composición de Ingresos</option>
                                        <option value="">Varicación de Ingresos</option>
                                        <option value="">Ingresos por Área</option>
                                        <option value="">Ingresos Presupuestados</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="form-group col-3 bg-info">
                                    <label for="exampleFormControlSelect1">Periodo:</label>
                                    <select name="estado" class="form-control" id="seleccionPeriodo">
                                        <option value="">2020</option>
                                        <option value="">2019</option>
                                        <option value="">2018</option>
                                    </select>
                                </div>
                                <div class="form-group col-4 bg-info pt-1" style="text-align: center">
                                    <a href="{{ route('transferencias') }}"
                                        class="btn btn-block btn-outline-light">Total Provincia
                                        Ingresos</a>
                                    <a href="{{ route('gastos') }}" class="btn btn-block btn-outline-light">Total
                                        Provincia
                                        Egresos</a>
                                </div>
                            </div>
                        </div>

                        <hr>
                        {{-- Graficos --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">GASTOS POR CONCEPTO</h4>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="la_plata_gastos" height="50" width="100  "></canvas>
                                    </div>

                                    <!-- /.box-body -->
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <hr>
                                        <h4 class="box-title">GASTOS ACUMULADOS AL AÑO 2020</h4>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="pie_gastos_la_plata" width="50" height="50"></canvas>

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <h4>GASTOS TOTALES: $ 2.500.601.868</h4>
                            </div>
                            <div class="col-6 bg-info">
                                <p>0,74% de ingresos relacionados al total municipios</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <h4>GASTOS POR HABITANTE: $8.711,48</h4>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->
        @include('mapa.mapa')
    </div>
</div>
