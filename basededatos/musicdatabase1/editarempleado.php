<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ($id<=0) {
        header("Location: listacliente.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
 
    $idError = null;
    $nombreError = null;
    $apellidoError = null;
    $cargoError = null;
    $salarioError = null;

    // keep track post values
    $ide= $_POST['ide'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cargo= $_POST['cargo'];
    $salario = $_POST['salario'];

    // validate input
    $valid = true;
    if (empty($ide)) {
      $idError = 'Por favor ingrese la id';
      $valid = false;
    }

    $valid = true;
    if (empty($nombre)) {
      $nombreError = 'Por favor ingrese el nombre';
      $valid = false;
    }
    
    if (empty($apellido)) {
      $apellidoError = 'Por favor ingrese los apellidos';
      $valid = false;
    }
    
    if (empty($cargo)) {
      $cargoError = 'Por favor ingrese el cargo';
      $valid = false;
    }

    if (empty($salario)) {
      $salarioError = 'Por favor ingrese el salario';
      $valid = false;
    }


    
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE empleado  set Id_empleado = ?, nombre = ?, apellido =? , cargo =? , salario=? WHERE Id_empleado= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($ide,$nombre,$apellido,$cargo,$salario,$id));
            Database::disconnect();
            header("Location: listaempleado.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM empleado where Id_empleado = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $ide = $data['Id_empleado'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $cargo = $data['cargo'];
        $salario = $data['salario'];
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
             
                    <form class="form-horizontal" action="editarempleado.php?id=<?php echo $id?>" method="post">

                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
              <label class="control-label">Id_empleado</label>
              <div class="controls">
                  <input name="ide" type="text"  placeholder="Id_empleado" value="<?php echo !empty($ide)?$ide:'';?>">
                  <?php if (!empty($ide)): ?>
                    <span class="help-inline"><?php echo !empty($idError)?$idError:'';?></span>
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

            <div class="control-group <?php echo !empty($apellidoError)?'error':'';?>">
              <label class="control-label">Apellidos</label>
              <div class="controls">
                  <input name="apellido" type="text"  placeholder="Apellidos" value="<?php echo !empty($apellido)?$apellido:'';?>">
                  <?php if (!empty($apellidoError)): ?>
                    <span class="help-inline"><?php echo $apellidoError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($cargoError)?'error':'';?>">
              <label class="control-label">Cargo</label>
              <div class="controls">
                  <input name="cargo" type="text"  placeholder="Cargo" value="<?php echo !empty($cargo)?$cargo:'';?>">
                  <?php if (!empty($cargoError)): ?>
                    <span class="help-inline"><?php echo $cargoError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($salarioError)?'error':'';?>">
              <label class="control-label">Salario</label>
              <div class="controls">
                  <input name="salario" type="text"  placeholder="Salario" value="<?php echo !empty($salario)?$salario:'';?>">
                  <?php if (!empty($salarioError)): ?>
                    <span class="help-inline"><?php echo $salarioError;?></span>
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
