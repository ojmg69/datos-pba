<div class="row">
    <div class="col-5">
        @include('mapa.mapa')
    </div>

    <div class="col-7">
        <div class="card" style="background-color: #015875; color:#ffffff">
            <div class="card-header bg-info">
                <h3 class="card-title">Eje Económico / Transferencias provinciales a municipios</h3>
            </div>

            <div class="card-body">

                <div class="col-12">
                    @livewire('economico-graficos')
                </div>
            </div>
        </div>
    </div>
</div>
