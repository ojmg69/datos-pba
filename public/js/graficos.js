// Funciones para graficar
function graficoBarrasHorizontal(dataset, options = {}) {
    // Re-crear canvas para el grafico
    const contenedor = document.querySelector("#grafico-barra__container")
    contenedor.innerHTML = ''
    const canvas = document.createElement("canvas");
    contenedor.appendChild(canvas)

    const defaults = {
        displayLabels: true,
        labelPosition: 'right',
        responsive: true
    }

    const config = { ...defaults, ...options }

    // Graficar
    const contexto = canvas.getContext('2d');
    return grafico = new Chart(contexto, {
        type: 'bar',
        options: {
            indexAxis: 'y',
            responsive: config.responsive,
            plugins: {
                title: {
                    display: false,
                },
                legend: {
                    display: config.displayLabels,
                    position: config.labelPosition,
                    labels: { color: "#3E444D" }
                },
            },
            scales: {
                y: {
                    ticks: {
                        color: "#3E444D",
                    }
                },
                x: {
                    ticks: {
                        color: "#3E444D",
                        
                        callback: function(value, index, values) {
                            return '$' + agregarSeparadores(value);
                        }
                    }
                }
            }
        },
        data: {
            axis: 'y',
            labels: dataset.etiquetas,
            datasets: [{
                label: '',
                data: dataset.valores,
                backgroundColor: dataset.colores,
                borderWidth: 0
            }]
        },
    })
}

/**
 * Crea un grafico de dona en un canvas con un id especifico
 * @param {*} idCanvas id del canvas objetivo
 * @param {*} dataset objeto con tres props: valores, etiquetas, colores
 * @returns 
 */
function graficoDona(parametrosCanvas, dataset, options) {
    const canvas = crearCanvas(parametrosCanvas)

    const contexto = canvas.getContext('2d');

    const defaults = {
        displayLabels: true,
        labelPosition: 'right',
        responsive: true
    }

    const config = { ...defaults, ...options }

    return grafico = new Chart(contexto, {
        type: 'doughnut',
        data: {
            labels: dataset.etiquetas,
            datasets: [{
                label: '',
                data: dataset.valores,
                backgroundColor: dataset.colores,
                borderWidth: 0
            }]
        },
        options: {
            responsive: config.responsive,
            plugins: {
                title: {
                    display: false,
                },
                legend: {
                    display: config.displayLabels,
                    position: config.labelPosition,
                    labels: { color: "#3E444D" }
                },
            }
        }
    })
}

function agregarSeparadores(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

/**
 * Crea un canvas con los parametros especificados y lo agrega a un nodo del DOM
 * 
 * @param { idContainer: string, idCanvas: string, claseCanvas?: string } parametros 
 */
function crearCanvas(parametros)
{
    const contenedor = document.querySelector("#" + parametros.idContainer)

    if (parametros.vaciarContenedor)
    {
        contenedor.innerHTML = ''
    }

    const canvas = document.createElement("canvas");

    if (parametros.claseCanvas)
    {
        canvas.classList.add(parametros.claseCanvas)
    }

    if (parametros.insercion)
    {
        if (parametros.insercion == 'prepend')
        {
            contenedor.removeChild(contenedor.children[0])
            contenedor.prepend(canvas)
        }
    } else {
        contenedor.appendChild(canvas)
    }

    return canvas
}