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
                      <th>Id_producto</th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Accion</th
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM productos ORDER BY Id_producto DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Id_producto'] . '</td>';
                            echo '<td>'. $row['nombre'] . '</td>';
                            echo '<td>'. $row['marca'] . '</td>';
                            echo '<td>'. $row['cantidad'] . '</td>';
                            echo '<td>'. $row['precio'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn btn-success" href="editarproducto.php?id='.$row['Id_producto'].'">Editar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="borrarproducto.php?id='.$row['Id_producto'].'">Borrar</a>';
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