<div>
    @section('js')
    <script>
        window.addEventListener('mapaListo', evento => {
            mapa.quitarEstilos()
            mapa.quitarReferencias()
            mapa.quitarPines()
            mapa.municipios()

            const estilosMunicipios = JSON.parse('{!! json_encode($this->estilosMunicipios) !!}')
            mapa.pintarMunicipios(estilosMunicipios);

            const referencias = JSON.parse('{!! json_encode($referencias) !!}');
            console.log(referencias.data)
            mapa.agregarReferencias(referencias, 'municipios');

        });

        window.addEventListener('estilosActualizados', evento => {
            const estilos = evento.detail

            mapa.pintarMunicipios(estilos);
        })

    </script>

@stop
</div>
