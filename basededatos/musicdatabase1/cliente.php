<?php
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$idcError = null;
		$idmError = null;
		$nombreError = null;
		$apellidoError = null;
		$direccionError = null;
		$teleError = null;
	
		
		// keep track post values
		$idc = $_POST['idc'];
		$idm = $_POST['idm'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$direccion= $_POST['direccion'];
		$telefono = $_POST['telefono'];
		
		// validate input
		$valid = true;
		if (empty($idc)) {
			$idcError = 'Por favor ingrese la id';
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
			$direccionError = 'Por favor ingrese el direccion';
			$valid = false;
		}

		if (empty($telefono)) {
			$teleError = 'Por favor ingrese el telefono';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO cliente (id_cliente,nombre,apellidos,direccion,telefono) values(?, ?, ?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($idc,$nombre,$apellido,$direccion,$telefono));
			Database::disconnect();
		?>
			<script>alert("Registrado.");</script>
		<?php
			header("Location: factura2.php");
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
		    			<p>Registrar Cliente</p>
		    		<!-- </div> -->
    		
	    			<form class="form-horizontal" action="cliente.php" method="post">

					  <div class="control-group <?php echo !empty($idcError)?'error':'';?>">
					    <label class="control-label">Id_cliente</label>
					    <div class="controls">
					      	<input name="idc" type="text"  placeholder="Id_cliente" value="<?php echo !empty($idc)?$idc:'';?>">
					      	<?php if (!empty($idcError)): ?>
					      		<span class="help-inline"><?php echo $idcError;?></span>
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
						  <button type="submit"  class="btn btn-success">Siguiente</button>
						  <a class="btn btn-danger" href="factura2.php">Atrás</a>
						</div>
					</form>
				</div>
				</div>
    </div> <!-- /container -->
  </body>
</html>