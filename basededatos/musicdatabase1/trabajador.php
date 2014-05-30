<?php
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$idError = null;
		$nombreError = null;
		$apellidoError = null;
		$cargoError = null;
		$salarioError = null;
		$passwordError=null;
		// keep track post values
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cargo= $_POST['cargo'];
		$salario = $_POST['salario'];
		$password=$_POST['password'];
		
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

		if (empty($password)) {
			$passwordError = 'Por favor ingrese una contraseña';
			$valid = false;
		}
		
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO empleado (Id_empleado,nombre,apellido,cargo,salario,password) values(?, ?, ?,?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($id,$nombre,$apellido,$cargo,$salario,$password));
			Database::disconnect();
			?>
			<script>alert("Registrado.");</script>
		<?php
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
		    			<p>Registrar Empleado</p>
		    		<!-- </div> -->
    		
	    			<form class="form-horizontal" action="trabajador.php" method="post">

					  <div class="control-group <?php echo !empty($idError)?'error':'';?>">
					    <label class="control-label">Id</label>
					    <div class="controls">
					      	<input name="id" type="text"  placeholder="Id" value="<?php echo !empty($id)?$id:'';?>">
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

					 <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="password" type="text"  placeholder="Contraseña" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
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