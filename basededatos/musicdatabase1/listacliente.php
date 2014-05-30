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
                      <th>Id_cliente</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM cliente ORDER BY id_cliente DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_cliente'] . '</td>';
                            echo '<td>'. $row['nombre'] . '</td>';
                            echo '<td>'. $row['apellidos'] . '</td>';
                            echo '<td>'. $row['direccion'] . '</td>';
                            echo '<td>'. $row['telefono'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-success" href="editar.php?id='.$row['id_cliente'].'">Editar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="borrar.php?id='.$row['id_cliente'].'">Borrar</a>';
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
