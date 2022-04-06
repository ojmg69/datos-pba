<div class="col-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ejecutivo - Vicegobernación</h3>
        </div>
        <hr>
        <div class="box-body row">
            <div class="col-7">
                <hr>
                <h4><b>Autoridad:</b> {{ $datosLegislatura->nombre_autoridad }}</h4>
                <hr>
                <h4><b>Cargo:</b> Vicegobernadora de la Provincia de Buenos Aires - Presidenta del Honorable Senado de la Provincia de Buenos Aires</h4>
                <hr>
                <h4><b>Contacto: </b>{{ $datosLegislatura->contacto }}</h4>
                <hr>
            </div>
            <div class="col-5 d-flex justify-content-center">

                <img style="border-radius: 50%" width="240px" height="240px" src="{{ url('img/img_legislativos/' . $datosLegislatura->imagen) }}"
                    alt="Image" />

            </div>
            <div class="col-12">
                <h4><b>Información: </b></h4>
                <div class="row">
                    <div class="m-1" style="height: 250px;overflow-y: scroll; text-align:justify; padding:10px;">
                        {!! nl2br ($datosLegislatura->descripcion) !!}

                    </div>
                    <hr>
                </div>
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
    </div>
</div>
