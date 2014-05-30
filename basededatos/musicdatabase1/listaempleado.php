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
                      <th>Id_empleado</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Cargo</th>
                      <th>Salario</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM empleado ORDER BY Id_empleado DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Id_empleado'] . '</td>';
                            echo '<td>'. $row['nombre'] . '</td>';
                            echo '<td>'. $row['apellido'] . '</td>';
                            echo '<td>'. $row['cargo'] . '</td>';
                            echo '<td>'. $row['salario'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-success" href="editarempleado.php?id='.$row['Id_empleado'].'">Editar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="borrarempleado.php?id='.$row['Id_empleado'].'">Borrar</a>';
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
