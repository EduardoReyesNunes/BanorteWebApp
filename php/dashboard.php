<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/stylesdash.css">
  <title>Banorte - Dashboard de Control</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>
  <header>
    <!-- Aquí iría el contenido del header si lo tienes -->
  </header>

  <nav>
    <div class="btn_srv">
        <img class="img_nav" src="../servi.svg" alt="">
        <span>Servicios</span>
        <div class="services-dropdown">
            <a href="servicios.php">Tus servicios</a>
            <a href="automatizacion.php">Automatizacion y estado</a>
            <a href="radar.php">Radar de eficiencia</a>
            <a href="historial.php">Historial</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </div>
  </nav>

  <main class="dashboard-content">
    <h1>Dashboard de Control: Resumen de Servicios Públicos</h1>
    
    <section>
        <h2>Gasto Total por Servicio (MXN)</h2>
        <div class="chart-container">
            <canvas id="gastoTotalChart"></canvas>
        </div>
    </section>

    <section>
        <h2>Comparativa y Recomendaciones</h2>
        <div class="table-container">
            <table id="comparativaTable">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Monto Pagado Reciente</th>
                        <th>Estado de Gasto</th>
                        <th>Recomendación de Eficiencia</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán con JavaScript -->
                </tbody>
            </table>
        </div>
    </section>

    <section>
        <h2>Consumo CFE vs Promedio (kWh)</h2>
        <div class="chart-container">
            <canvas id="consumoCfeChart"></canvas>
        </div>
    </section>
  </main>

  <footer>
    <h2>Diseñamos soluciones de vida</h2>
    <p>Acompañándote en cada paso para que sigas avanzando</p>
  </footer>

  <div class="chat">💬 Hola, soy Maya. ¡Chatea conmigo!</div>

  <script>
    // Tu código JavaScript permanece igual, pero agregué opciones de tamaño a los gráficos
    const API_BASE_URL = 'http://localhost:3000/api';

    async function fetchData(endpoint) {
        try {
            const response = await fetch(`${API_BASE_URL}/${endpoint}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error(`Error al obtener datos de ${endpoint}:`, error);
            return null;
        }
    }

    async function loadDashboard() {
        const cfeData = await fetchData('cfe/019123456789'); 
        const conaguaData = await fetchData('conagua/facturas');
        const telmexData = await fetchData('telmex/recibos');
        const gasData = await fetchData('gas/contratos');
        
        const totalGastos = {};

        if (cfeData) {
            totalGastos['CFE (Luz)'] = cfeData.Monto_a_Pagar || 0;
        }

        if (conaguaData && conaguaData.length > 0) {
            totalGastos['CONAGUA (Agua)'] = conaguaData.reduce((sum, item) => sum + item.Monto_a_Pagar, 0);
        }

        if (telmexData && telmexData.length > 0) {
            totalGastos['TELMEX (Internet/Tel)'] = telmexData.reduce((sum, item) => sum + item.Monto_a_Pagar, 0);
        }

        if (gasData && gasData.length > 0) {
            totalGastos['GAS'] = gasData.reduce((sum, item) => sum + item.Monto_a_Pagar, 0);
        }

        const labels = Object.keys(totalGastos);
        const data = Object.values(totalGastos);

        // Gráfica de Gasto Total con opciones de tamaño
        new Chart(document.getElementById('gastoTotalChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gasto Total (MXN)',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Importante para controlar el tamaño
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Gasto por Servicio'
                    }
                }
            }
        });

        generateComparativaTable(totalGastos);
        
        if (cfeData) {
             generateCfeComparisonChart(cfeData.Consumo_kWh);
        }
    }

    function generateComparativaTable(gastos) {
        const tableBody = document.querySelector('#comparativaTable tbody');
        
        const promedios = {
            'CFE (Luz)': 750.00,
            'CONAGUA (Agua)': 400.00,
            'TELMEX (Internet/Tel)': 650.00,
            'GAS': 1000.00
        };

        for (const [servicio, monto] of Object.entries(gastos)) {
            const promedio = promedios[servicio] || 0;
            let estadoGasto = 'Normal';
            let recomendacion = 'Sin cambios inmediatos.';

            if (monto > promedio * 1.2) {
                estadoGasto = '¡Alto Gasto! 🚨';
                recomendacion = 'Revisa fugas o uso excesivo. Considera un plan de menor consumo.';
            } else if (monto < promedio * 0.8) {
                estadoGasto = 'Bajo Gasto ✅';
                recomendacion = '¡Excelente! Mantén el nivel de consumo.';
            }

            const row = tableBody.insertRow();
            row.insertCell().textContent = servicio;
            row.insertCell().textContent = `$${monto.toFixed(2)}`;
            row.insertCell().textContent = estadoGasto;
            row.insertCell().textContent = recomendacion;
        }
    }

    function generateCfeComparisonChart(consumoUsuario) {
        const promedioRegional = 350;
        
        new Chart(document.getElementById('consumoCfeChart'), {
            type: 'bar',
            data: {
                labels: ['Tu Consumo (kWh)', 'Promedio Regional (kWh)'],
                datasets: [{
                    label: 'Consumo de Energía Eléctrica',
                    data: [consumoUsuario, promedioRegional],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Importante para controlar el tamaño
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', loadDashboard);
  </script>
</body>
</html>