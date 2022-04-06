<div class="tablero-seccion--container tablero-grafico-dona--container">

    <span style="align-self: flex-start" >{{$nombre}}</span>
    
    <div style="display: flex;">

        {{--
            Es importante que el canvas este envuelto en un div debido a un mecanismo
            que usa ChartJS para poder ajustar dinamicamente los graficos
        --}}
        
        <div id="tablero-grafico-dona-{{ $idGrafico }}" class="tablero-grafico-dona--canvas-container">
            <canvas id={{$idGrafico}}></canvas>
        </div>

        <div class="tablero-grafico-dona--etiquetas">
            @foreach ($referencias as $referencia)
                @livewire('etiqueta-grafico', $referencia, key($referencia['texto']))
            @endforeach
        </div>
    </div>

    @push('js')
        <script>
            function graficar(configCanvas, dataset)
            {
                graficoDona(
                    configCanvas,
                    dataset,
                    { responsive: true, displayLabels: false }
                )
            }

            const dataset = JSON.parse('{!!  json_encode($dataset) !!}')

            const configCanvas = {
                idContainer: 'tablero-grafico-dona-{!! $idGrafico !!}',
                idCanvas: '{!! $idGrafico !!}',
                vaciarContenedor: false,
                insercion: 'prepend'
            }

            graficar(configCanvas, dataset)

            document.addEventListener("DOMContentLoaded", () => {
                // // Llama a una funcion CADA VEZ que cambia el DOM
                // livewire.hook('afterDomUpdate', (evento) => {
                //     console.log(evento)
                //     // El try catch es un workaround para evitar la excepcion que se va
                //     // a tirar cuando el grafico intente dibujarse cuando vista != 'tablero'
                //     try {
                //         graficar(configCanvas, dataset)
                //     } catch (e) { }
                // })
            });

            window.addEventListener('{!! $eventoListoParaDibujar !!}', evento => {
                graficar(configCanvas, evento.detail)
            });
        </script>
    @endpush
</div>
