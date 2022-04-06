    <div class="card mapa__cuerpo">
    <select id="idSecciones" class="custom-select custom-select-lg mapa__select">
            <option value="-1">Todos...</option>
    </select>

    <span id="titulo" class="mapa__titulo"></span>

    <div class="dialogo-carga--container mapa__dialogo-carga">
        <div class="shadow dialogo-carga--dialogo">
            <span class="m-2">Cargando</span>

            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>

    <div class="mapa--container mapa__mapa-container d-none">
        <div id="map" class="map" tabindex="0"></div>

        <div class="referencias mapa__referencias d-none">
            <span class="mapa__referencias__titulo"></span>

            <div class="mapa__referencias__items">

            </div>
        </div>
    </div>

    <div class="mapa--controles mapa__controles d-none">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-info active">
                <input type="radio" onclick="selectLayer()" name="mapShowOption" id="showSecciones"
                    autocomplete="off" value='1' checked> SECCIONES
            </label>
            <label class="btn btn-info">
                <input type="radio" onclick="selectLayer()" name="mapShowOption" id="showDistritos"
                    autocomplete="off" value='2'> MUNICIPIOS
            </label>
            <label class="btn btn-info">
                <input type="radio" onclick="selectLayer()" name="mapShowOption" id="initialShow"
                    autocomplete="off" value='3'> RESTAURAR
            </label>
            <label class="btn btn-info">
                <input type="radio" onclick="selectLayer()" name="mapShowOption" id="showDistritos"
                    autocomplete="off" value='4'> CUEN. MATANZA RIACHUELO
            </label>
        </div>

        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="showMapStreets">
            <label id="showMapStreetsLabel" class="d-none custom-control-label" for="showMapStreets">VISUALIZAR CALLES</label>
        </div>
    </div>
</div>