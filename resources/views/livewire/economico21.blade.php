<div class="row">
    <div class="col-5">
        @include('mapa.mapa')
    </div>

    <div class="col-7">
        <div class="card" style="background-color: #ffffff; color:#3E444D">
            <div class="card-header bg-info">
                <h3 class="card-title">Eje Económico / Transferencias provinciales a municipios 2021</h3>
            </div>

            <div class="card-body" id="card-body-graficos">

                <div class="col-12">
                    @livewire('economico-graficos21')
                </div>
            </div>
        </div>
    </div>
</div>
