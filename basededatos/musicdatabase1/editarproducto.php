<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ($id<=0) {
        header("Location: listaproducto.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
 
     $idError = null;
    $nombreError = null;
    $marcaError = null;
    $cantidadError = null;
    $precioError = null;
    
    // keep track post values
    $idp = $_POST['idp'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $cantidad= $_POST['cantidad'];
    $precio = $_POST['precio'];
    
    // validate input
    $valid = true;
    if (empty($idp)) {
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


    
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE productos  set Id_producto = ?, nombre = ?, marca =? , cantidad =? , precio=? WHERE Id_producto= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($idp,$nombre,$marca,$cantidad,$precio,$id));
            Database::disconnect();
            header("Location: listaproducto.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM productos where Id_producto = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $idp = $data['Id_producto'];
        $nombre = $data['nombre'];
        $marca = $data['marca'];
        $cantidad = $data['cantidad'];
        $precio = $data['precio'];
        Database::disconnect();
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Editar Empleado</h3>
                    </div>
             
                    <form class="form-horizontal" action="editarproducto.php?id=<?php echo $id?>" method="post">

                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
              <label class="control-label">Id_producto</label>
              <div class="controls">
                  <input name="idp" type="text"  placeholder="Id_producto" value="<?php echo !empty($idp)?$idp:'';?>">
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
                          <button type="submit" class="btn btn-success">Editar</button>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
