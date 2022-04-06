<div>
    @switch($vista)
    @case('municipio')
    <div>
        <div class="box-body container">
            <div class="row align-items-center">
                <div class="m-2">
                    <span class="h3 font-weight-bold">{{ $municipio->nombre }}</span>
                    <h6 style="color: {{ $municipio->departamento->color }};">
                        {{ $municipio->depto_nombre }}
                    </h6>
                </div>
            </div>

            <button class="btn btn-info" wire:click="verDepartamentos">Volver al listado completo</button>
        </div>
    </div>
    @break

    @case('departamentos')
    <div class="box-body">
        <table id="tabla" class="table table-bordered table-striped" style="width:100%; height: 100%">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Focalizar en mapa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                <tr>
                    <td> {{ $departamento->nombre }}</td>
                    <td>
                        <button type="submit" wire:click="verDetalle({{ $departamento->id }})" class="btn btn-info">
                            <i class="fas fa-search"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @break
    @case('municipios')
    <div class="box-body">
        <div class="d-flex justify-content-between">
            <h4>Este deparatamento judicial está integrado por los partidos de: </h4>
            <button class="btn btn-info" wire:click="verDepartamentos">Volver al listado completo</button>
        </div>
        <ul>
            @foreach ($municipios as $municipio)
            <li> {{ $municipio->nombre }}</li>
            @endforeach
        </ul>
        <h4>Con {{ number_format($municipiosDetalles['total_poblacion'], 0, '', '.') }} habitantes representa el {{ number_format($municipiosDetalles['total_poblacion_porcentaje'], 2, '.', ',') }}% de la población total de la provincia de Buenos Aires</h4>
    </div>
    @break
    @endswitch

    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            const mapa = evento.detail;
            mapa.quitarReferencias()
            mapa.quitarPines()

            const estilos = JSON.parse('{!!  json_encode($estilos) !!}');
            mapa.pintarMunicipios(estilos);

            const referencias = JSON.parse('{!!  json_encode($referencias) !!}');
            mapa.agregarReferencias(referencias, 'municipios');

            if (!mapa.hayMunicipioGuardado()) {
                mapa.municipios();
            }
        });

        window.addEventListener('clickEnLupita', evento => {
            const id = evento.detail;
        });
    </script>
    @stop
</div>
