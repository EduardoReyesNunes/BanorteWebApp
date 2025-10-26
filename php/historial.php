<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styleshist.css">
  <title>Banorte - Banco en Línea</title>
  
</head>
<body>
  <header>
    <img src="../img/logoBn.png" alt="Banorte Logo">
    <div class="header-links">
      <span class="tit_hed">Preferente</span>
      <span class="tit_hed">Pymes</span>
      <span class="tit_hed">Empresas</span>
      <span class="tit_hed">Gobierno</span>
      <span class="tit_hed">casa de bolsa</span>
      <img class="img_head" src="../img/discapacitado-11.png" alt="">
      <img class="img_head" src="../img/mapas-y-banderas-1.png" alt="">
      <img class="img_head" src="../img/lupa-1.png" alt="">
      <img class="img_head" src="../img/bloqueado-11.png" alt="">
    </div>
  </header>

<nav>
    <div>
        <img class="img_nav" src="../img/cy-t.png" alt="">
        <span>Cuentas y Tarjetas</span>
    </div>
    <div>
        <img class="img_nav" src="../img/credit.png" alt="">
        <span>Créditos</span>
    </div>
    <div>
        <img class="img_nav" src="../img/ae-i.png" alt="">
        <span>Ahorro e Inversión</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/segu.png" alt="">
        <span>Seguros</span>
    </div>
    <div>
        <img class="img_nav" src="../img/inter.png" alt="">
        <span>Internacional</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/sl.png" alt="">
        <span>Servicios en Línea</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/nomi.png" alt="">
        <span>Nómina</span>
    </div>
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


<div class="main">
    <h1>Historial de Transacciones</h1>

    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'conxion.php';

    // Consulta SQL para obtener los registros ordenados por fecha descendente
    $sql = "SELECT * FROM historial_transacciones ORDER BY fecha_transaccion DESC, hora_transaccion DESC";
    $result = mysqli_query($conn, $sql);

    // Verificar si hay resultados
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='historial-table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Fecha</th>";
        echo "<th>Hora</th>";
        echo "<th>Operación</th>";
        echo "<th>Descripción</th>";
        echo "<th>Monto</th>";
        echo "<th>Saldo Final</th>";
        echo "<th>Referencia</th>";
        echo "<th>Estado</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Iterar sobre los resultados e imprimir las filas
        while($row = mysqli_fetch_assoc($result)) {
            // Lógica para aplicar el color Rojo Banorte o Verde según la operación
            $clase_monto = ($row['tipo_operacion'] === 'DEPOSITO' || $row['tipo_operacion'] === 'ABONO') ? 'monto-verde' : 'monto-rojo';
            
            // Lógica para el estado (Cumpliendo colores Banorte: Verde o Rojo)
            $estado_clase = '';
            if ($row['estado'] === 'COMPLETADA') {
                $estado_clase = 'estado-completada';
            } elseif ($row['estado'] === 'FALLIDA') {
                $estado_clase = 'estado-fallida';
            }
            
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['fecha_transaccion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['hora_transaccion']) . "</td>";
            echo "<td>" . htmlspecialchars(str_replace('_', ' ', $row['tipo_operacion'])) . "</td>"; // Reemplazar guiones bajos para mejor lectura
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
            // Formato de moneda para el monto
            echo "<td class='monto " . $clase_monto . "'>$" . number_format($row['monto'], 2) . "</td>";
            // Formato de moneda para el saldo final
            echo "<td class='monto'>$" . number_format($row['saldo_nuevo'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['referencia']) . "</td>";
            echo "<td class='" . $estado_clase . "'>" . htmlspecialchars($row['estado']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay transacciones registradas.</p>";
    }

    // Cerrar conexión
    mysqli_close($conn);
    ?>

</div>

</div>


  <footer>
    <h2>Diseñamos soluciones de vida</h2>
    <p>Acompañándote en cada paso para que sigas avanzando</p>
  </footer>

  <div class="chat">💬 Hola, soy Maya. ¡Chatea conmigo!</div>
</body>
</html>