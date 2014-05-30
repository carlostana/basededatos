<?php
  require 'database.php';

  if ( !empty($_POST)) {
    // keep track validation errors
    $idError = null;
    $nombreError = null;
    $marcaError = null;
    $cantidadError = null;
    $precioError = null;
    
    // keep track post values
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $cantidad= $_POST['cantidad'];
    $precio = $_POST['precio'];
    
    // validate input
    $valid = true;
    if (empty($id)) {
      $idError = 'Por favor ingrese la id';
      $valid = false;
    }

    $valid = true;
    if (empty($nombre)) {
      $nombreError = 'Por favor ingrese el nombre';
      $valid = false;
    }
    
    if (empty($marca)) {
      $marcaError = 'Por favor ingrese la marca';
      $valid = false;
    }
    
    if (empty($cantidad)) {
      $cantidadError = 'Por favor ingrese la cantidad';
      $valid = false;
    }

    if (empty($precio)) {
      $precioError = 'Por favor ingrese el precio';
      $valid = false;
    }
    
    // insert data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO productos (Id_producto,nombre,marca,cantidad,precio) values(?, ?, ?,?,?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($id,$nombre,$marca,$cantidad,$precio));
      Database::disconnect();
      header("Location: menu2.php");
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
      <?php 
        session_start();
        if(!isset($_SESSION['usuario'])){ ?>
            <script>alert('Debe iniciar sesión.');
              location.href="login.php"
            </script>
          <?php 
      }
        ?>
    
          <div class="span10 offset1">
            <div class="hero-unit">
              <h1>RITMO!</h1>
              <p>Registrar Producto</p>
            <!-- </div> -->
        
            <form class="form-horizontal" action="productos.php" method="post">

            <div class="control-group <?php echo !empty($idError)?'error':'';?>">
              <label class="control-label">Id_producto</label>
              <div class="controls">
                  <input name="id" type="text"  placeholder="Id_producto" value="<?php echo !empty($id)?$id:'';?>">
                  <?php if (!empty($idError)): ?>
                    <span class="help-inline"><?php echo $idError;?></span>
                  <?php endif; ?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
              <label class="control-label">Nombre</label>
              <div class="controls">
                  <input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                  <?php if (!empty($nombreError)): ?>
                    <span class="help-inline"><?php echo $nombreError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($marcaError)?'error':'';?>">
              <label class="control-label">Marca</label>
              <div class="controls">
                  <input name="marca" type="text"  placeholder="Marca" value="<?php echo !empty($marca)?$marca:'';?>">
                  <?php if (!empty($marcaError)): ?>
                    <span class="help-inline"><?php echo $marcaError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($cantidadError)?'error':'';?>">
              <label class="control-label">Cantidad</label>
              <div class="controls">
                  <input name="cantidad" type="text"  placeholder="Cantidad" value="<?php echo !empty($cantidad)?$cantidad:'';?>">
                  <?php if (!empty($cantidadError)): ?>
                    <span class="help-inline"><?php echo $cantidadError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($precioError)?'error':'';?>">
              <label class="control-label">Precio</label>
              <div class="controls">
                  <input name="precio" type="text"  placeholder="Precio" value="<?php echo !empty($precio)?$precio:'';?>">
                  <?php if (!empty($precioError)): ?>
                    <span class="help-inline"><?php echo $precioError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit"  class="btn btn-success">Registrar</button>
              
            </div>
          </form>
        </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>