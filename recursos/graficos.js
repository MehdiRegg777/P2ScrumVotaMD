// JavaScript para inicializar los gráficos con Chart.js
document.addEventListener("DOMContentLoaded", function() {
    // Datos para los gráficos (solo como ejemplo)
    var datosPastel = {
        labels: ['Opción 1', 'Opción 2', 'Opción 3'],
        datasets: [{
            data: [300, 50, 100], // Datos de ejemplo
            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'] // Colores de ejemplo
        }]
    };

    var datosBarras = {
        labels: ['Opción 1', 'Opción 2', 'Opción 3'],
        datasets: [{
            label: 'Cantidad de votos',
            data: [12, 19, 3], // Datos de ejemplo
            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'] // Colores de ejemplo
        }]
    };

    // Configuración de los gráficos
    var opciones = {
        responsive: true
    };

    // Inicializar el gráfico de pastel
    var ctxPastel = document.getElementById('graficoPastel').getContext('2d');
    var graficoPastel = new Chart(ctxPastel, {
        type: 'pie',
        data: datosPastel,
        options: opciones
    });

    // Inicializar el gráfico de barras
    var ctxBarras = document.getElementById('graficoBarras').getContext('2d');
    var graficoBarras = new Chart(ctxBarras, {
        type: 'bar',
        data: datosBarras,
        options: opciones
    });
});