<?php
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$idcError = null;
		$idpError = null;
		$albumError = null;
		$artistaError = null;
		
		
		// keep track post values
		$idc = $_POST['idc'];
		$idp = $_POST['idp'];
		$album = $_POST['album'];
		$artista= $_POST['artista'];
		$salario = $_POST['salario'];
		
		// validate input
		$valid = true;
		if (empty($idc)) {
			$idcError = 'Por favor ingrese la id';
			$valid = false;
		}

		$valid = true;
		if (empty($idp)) {
			$idpError = 'Por favor ingrese la id';
			$valid = false;
		}
		$valid = true;
		if (empty($album)) {
			$albumError = 'Por favor ingrese los album';
			$valid = false;
		}
		$valid = true;
		if (empty($artista)) {
			$artistaError = 'Por favor ingrese el artista';
			$valid = false;
		}

		
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO empleado (id_cd,id_producto,album,artista) values(?, ?, ?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($idc,$idp,$album,$artista));
			Database::disconnect();
			// header("Location: index.php");
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

					  <div class="control-group <?php echo !empty($idcError)?'error':'';?>">
					    <label class="control-label">Id_cd</label>
					    <div class="controls">
					      	<input name="idc" type="text"  placeholder="Id_cd" value="<?php echo !empty($idc)?$idc:'';?>">
					      	<?php if (!empty($idcError)): ?>
					      		<span class="help-inline"><?php echo $idcError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($idpError)?'error':'';?>">
					    <label class="control-label">Id_producto</label>
					    <div class="controls">
					      	<input name="idp" type="text" placeholder="Id_producto" value="<?php echo !empty($idp)?$idp:'';?>">
					      	<?php if (!empty($idpError)): ?>
					      		<span class="help-inline"><?php echo $idpError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($albumError)?'error':'';?>">
					    <label class="control-label">Album</label>
					    <div class="controls">
					      	<input name="album" type="text"  placeholder="Album" value="<?php echo !empty($album)?$album:'';?>">
					      	<?php if (!empty($albumError)): ?>
					      		<span class="help-inline"><?php echo $albumError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($artistaError)?'error':'';?>">
					    <label class="control-label">Artista</label>
					    <div class="controls">				      	
					    	<input name="artista" type="text"  placeholder="Artista" value="<?php echo !empty($artista)?$artista:'';?>">
					      	<?php if (!empty($artistaError)): ?>
					      		<span class="help-inline"><?php echo $artistaError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					

					  <div class="form-actions">
						  <button type="submit"  class="btn btn-success">Registrar</button>
						  <a class="btn btn-danger" href="menu2.php">Atrás</a>
						</div>
					</form>
				</div>
				</div>
    </div> <!-- /container -->
  </body>
</html>