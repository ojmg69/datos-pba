<div class="box">
    <div class="box-header">
        <h3 class="box-title">Económico - Transferencias Provinciales a Municipios 2021</h3>
        <hr>
    </div>
    @if($idMunicipio)
        {{-- Graficos --}}
        <div class="row">
            <div class="col-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h4 class="box-title">Transferencias provinciales por concepto</h4>
                    </div>
                    <div id="grafico-barra__container" class="box-body">
                        <canvas id="la_plata" height="50" width="100  "></canvas>
                    </div>

                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <hr>
                        <h4 class="box-title">Transferencias provinciales acumuladas al año 2021</h4>
                    </div>
                    <div id="grafico-dona__container" class="box-body">
                        <canvas id="pie" width="50" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="form-group col-4 pt-1" style="text-align: center">
            <a href="{{ route('transferencias') }}"
                class="btn btn-block btn-outline-light">Ver en Tabla
            </a>
        </div>
    @else
        <h4 class="font-weight-bold">🢀 Seleccione un municipio</h4>
    @endif

    @section('js')
    <script>
        {
            window.addEventListener('mapaListo', evento => {
                mapa.quitarEstilos()
                mapa.quitarReferencias()
                mapa.quitarPines()
            });

            const etiquetas = JSON.parse('{!! json_encode($etiquetasGrafico) !!}')

            window.addEventListener('municipioListoParaGraficar', evento => {
                const url = window.location.href
                    .replace(
                        'economico',
                        `api/economico/transferencias/distrito/${evento.detail}`
                    );

                const datos = fetch(url)
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        const values   = Object.values(datos).slice(1);
                        graficarTransferencia(datos['Distrito'], etiquetas, values);
                    })
            })

            function graficarTransferencia(nombre, etiquetas, valores) {
                    const dataset = {
                        nombre: nombre,
                        etiquetas,
                        valores,
                        colores: [
                            "#17A2B8",
                            "#ba64fa",
                            "#2ee347",
                            "#2e4fe3",
                            "#702ee3",
                            "#e32e7e",
                            "#c5e32e",
                            "#D47C39",
                            "#946666",
                            "#048e3b",
                            "#e2e2e2"
                        ],
                        bordes: [
                            "#17A2B8",
                            "#ba64fa",
                            "#2ee347",
                            "#2e4fe3",
                            "#702ee3",
                            "#e32e7e",
                            "#c5e32e",
                            "#D47C39",
                            "#946666",
                            "#048e3b",
                            "#e2e2e2"
                        ]
                    }
                    graficoBarrasHorizontal(dataset)
                    graficoDona(
                        { idContainer: 'grafico-dona__container', idCanvas: 'pie' },
                        dataset, { responsive: true }
                    )
            }
        }
    </script>
    @stop
</div>
