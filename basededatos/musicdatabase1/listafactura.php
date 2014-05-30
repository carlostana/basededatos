<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="hero-unit">
                <h1>PRODUCTOS</h1>
                <p>"Hemos sido llamados al concierto de este mundo para tocar de la mejor manera posible nuestro instrumento"Rabindranath Tagore</p>
            </div>
            <div class="hero-unit">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Id_fact</th>
                      <th>Id_cliente</th>
                      <th>Id_empleado</th>
                      <th>Id_producto</th>
                      <th>fecha</th>
                      <th>cantidad</th>
                      <th>total</th>
                      <th>Accion</th
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM factura ORDER BY Id_fact DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Id_fact'] . '</td>';
                            echo '<td>'. $row['Id_cliente'] . '</td>';
                            echo '<td>'. $row['Id_empleado'] . '</td>';
                            echo '<td>'. $row['id_producto'] . '</td>';
                            echo '<td>'. $row['fecha'] . '</td>';
                            echo '<td>'. $row['cantidad'] . '</td>';
                            echo '<td>'. $row['total'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-danger" href="borrarfactura.php?id='.$row['Id_fact'].'">Borrar</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                    
                  ?>
                   
                  </tbody>

            </table>
                            <a href="menu2.php" class="btn btn-danger btn-large "> Atrás </a>

        </div>
    </div> <!-- /container -->
  </body>
</html>