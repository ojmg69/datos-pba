<div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title">Información</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            
            <div class="col-12">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Localidades</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cabecera</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($localidades as $loc)
                                        <tr>
                                            <td> {{ $loc->nombre }}</td>
                                            <td> {{ $loc->cabecera }}</td>
                                            <td><button type="submit" wire:click="verDetalle({{ $loc->id }})" class="btn btn-info"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cabecera</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>

</div>



<!-- VISTA DE MAPA - MENU DE INTERACCION CON MAPA -->
@include('mapa.mapa')