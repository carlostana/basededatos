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
 
    $nombreError = null;
    $apellidoError = null;
    $direccionError = null;
    $teleError = null;
    $id_clienteError=null;
    
    // keep track post values
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion= $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $id_cliente = $_POST['id_cliente'];
         
        // validate input
    $valid = true;

    if (empty($id_cliente)) {
      $id_clienteError  = 'Por favor ingrese la id';
      $valid = false;
    }

    if (empty($nombre)) {
      $nombreError = 'Por favor ingrese el nombre';
      $valid = false;
    }

    if (empty($apellido)) {
      $apellidoError = 'Por favor ingrese los apellidos';
      $valid = false;
    }

    if (empty($direccion)) {
      $direccionError = 'Por favor ingrese el direccions';
      $valid = false;
    }

    if (empty($telefono)) {
      $teleError = 'Por favor ingrese el telefono';
      $valid = false;
    }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE cliente  set id_cliente = ?, nombre = ?, apellidos =? , direccion =? , telefono =? WHERE id_cliente= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_cliente,$nombre,$apellido,$direccion,$telefono,$id));
            Database::disconnect();
            header("Location: listacliente.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM cliente where id_cliente = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_cliente = $data['id_cliente'];
        $nombre = $data['nombre'];
        $apellido = $data['apellidos'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
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
                        <h3>Update a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="editar.php?id=<?php echo $id?>" method="post">

                      <div class="control-group <?php echo !empty($id_clienteError)?'error':'';?>">
              <label class="control-label">Id_cliente</label>
              <div class="controls">
                  <input name="id_cliente" type="text"  placeholder="Id_cliente" value="<?php echo !empty($id_cliente)?$id_cliente:'';?>">
                  <?php if (!empty($id_cliente)): ?>
                    <span class="help-inline"><?php echo !empty($id_clienteError)?$id_clienteError:'';?></span>
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
              <label class="control-label">Direccion</label>
              <div class="controls">
                  <input name="direccion" type="text"  placeholder="Direccion" value="<?php echo !empty($direccion)?$direccion:'';?>">
                  <?php if (!empty($direccionError)): ?>
                    <span class="help-inline"><?php echo $direccionError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($salarioError)?'error':'';?>">
              <label class="control-label">Telefono</label>
              <div class="controls">
                  <input name="telefono" type="text"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                  <?php if (!empty($teleError)): ?>
                    <span class="help-inline"><?php echo $teleError;?></span>
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
