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
// keep track validation errors
    $idfError = null;
    $idvError = null;
    $idcError = null;
    $ideError = null;
    $totalError = null;
    
  
    
    // keep track post values
    $idf = $_POST['idf'];
    $idp = $_POST['idp'];
    $idc = $_POST['idc'];
    $ide = $_POST['ide'];
    $total = $_POST['total'];
    $fecha = $_POST['fecha'];
    $cantidad = $_POST['cantidad'];

  
    
    // validate input
    $valid = true;
    if (empty($idf) ) {
      $idfError = 'Por favor ingrese la id de la factura';
      $valid = false;
    }

    if (empty($idc)) {
      $idcError = 'Por favor ingrese la id del cliente';
      $valid = false;
    }
    if (empty($ide)) {
      $ideError = 'Por favor ingrese la id del empleado';
      $valid = false;
    }
    if (empty($total)) {
      $totalError = 'Por favor ingrese el total';
      $valid = false;
    }
    if (empty($fecha)) {
      $fechaError = 'Por favor ingrese la fecha';
      $valid = false;
    }
    if (empty($cantidad)) {
      $cantidadError = 'Por favor ingrese la cantidad';
      $valid = false;
    }
    if (empty($idp)) {
      $idpError = 'Por favor ingrese la id del producto';
      $valid = false;
    }

    
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE factura  set Id_fact = ?, Id_cliente = ?, Id_empleado =? , id_producto=?, fecha=?, cantidad =? , total=? WHERE Id_fact= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($idf,$idc,$ide,$idp,$fecha,$cantidad,$total,$id));
            Database::disconnect();
            header("Location: listafactura.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM factura where Id_fact = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $idf = $data['Id_fact'];
        $idc = $data['Id_cliente'];
        $ide = $data['Id_empleado'];
        $idp = $data['id_producto'];
        $fecha = $data['fecha'];
        $cantidad = $data['cantidad'];
        $total = $data['total'];
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
                        <h3>Editar Factura</h3>
                    </div>
             
                    <form class="form-horizontal" action="editarfactura.php?id=<?php echo $id?>" method="post">

                       <div class="control-group <?php echo !empty($idfError)?'error':'';?>">
              <label class="control-label">Id_Factura</label>
              <div class="controls">
                  <input name="idf" type="text"  placeholder="Id_Factura" value="<?php echo !empty($idf)?$idf:'';?>">
                  <?php if (!empty($idfError)): ?>
                    <span class="help-inline"><?php echo $idfError;?></span>
                  <?php endif;?>
              </div>
            </div>            

            <div class="control-group <?php echo !empty($idcError)?'error':'';?>">
              <label class="control-label">Id_cliente</label>
              <div class="controls">
                <select name="idc" id="idc">
                <?php 

                  $enlace =  mysql_connect('localhost', 'root', '');
                mysql_select_db('musicdatabase')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
                $query="SELECT * FROM cliente";
                $result = mysql_query($query,$enlace) or die("Error en: $busqueda: " . mysql_error());
                while($row=mysql_fetch_array($result)){
                    echo "<option value='".$row['id_cliente']."'>". $row['id_cliente'] ."-> ".$row['nombre']."</option>";
                }
                ?>
              </select>
              <div>Si el cliente no se encuentra en la lista has click <a href="cliente.php">Aqui</a></div>
                  <?php if (!empty($idcError)): ?>
                    <span class="help-inline"><?php echo $idcError;?></span>
                  <?php endif; ?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($ideError)?'error':'';?>">
              <label class="control-label">Id_empleado</label>
              <div class="controls">
                <select name="ide" id="ide">
                <?php 

                  $enlace =  mysql_connect('localhost', 'root', '');
                mysql_select_db('musicdatabase')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
                $query="SELECT * FROM empleado where Id_empleado!=".$_SESSION['usuario']."";
                echo "<option value='".$_SESSION['usuario']."'>". $_SESSION['usuario'] ."-> ".$_COOKIE['nombre_usuario']."</option>";
                $result = mysql_query($query,$enlace) or die("Error en: $busqueda: " . mysql_error());
                while($row=mysql_fetch_array($result)){

                    echo "<option value='".$row['Id_empleado']."'>". $row['Id_empleado'] ."-> ".$row['nombre']."</option>";
                }
                ?>
              </select>
                  <?php if (!empty($ideError)): ?>
                    <span class="help-inline"><?php echo $ideError;?></span>
                  <?php endif;?>
              </div>
            </div>

             <div class="control-group <?php echo !empty($idpError)?'error':'';?>">
              <label class="control-label">Id_producto</label>
              <div class="controls">
                <script>
                  function calculaTotal(obj){
                    if(obj){
                      value=obj.value;
                      value=value.split(";");
                      total=value[1];

                      document.getElementById("total").value=document.getElementById("cantidad").value*total;
                    }
                  }
                </script>
                <select id="id_producto" name="idp" onchange="calculaTotal(this);">
                  <?php 

                  $enlace =  mysql_connect('localhost', 'root', '');
                mysql_select_db('musicdatabase')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
                $query="SELECT * FROM productos where cantidad>0";
                $result = mysql_query($query,$enlace) or die("Error en: $busqueda: " . mysql_error());
                while($row=mysql_fetch_array($result)){
                    echo "<option  value='".$row['Id_producto'].";".$row['precio']."'>".$row['nombre']."</option>";
                }
                ?>
                  <?php if (!empty($idpError)): ?>
                    <span class="help-inline"><?php echo $idpError;?></span>
                  <?php endif; ?>
                </select>
                <script>calculaTotal(document.getElementById("id_producto"));</script>
              </div>
            </div>

            <div class="control-group <?php echo !empty($cantidadError)?'error':'';?>">
              <label class="control-label">Cantidad</label>
              <div class="controls">
                  <input name="cantidad" onkeyup="calculaTotal(document.getElementById('id_producto'));" id="cantidad" type="text"  placeholder="Cantidad" value="<?php echo !empty($cantidad)?$cantidad:'0';?>">
                  <?php if (!empty($cantidadError)): ?>
                    <span class="help-inline"><?php echo $cantidadError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($fechaError)?'error':'';?>">
              <label class="control-label">Fecha</label>
              <div class="controls">
                <input name="fecha" type="date" value="<?php echo date("Y-m-d") ?>" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d") ?>">
                  <?php if (!empty($fechaError)): ?>
                    <span class="help-inline"><?php echo $fechaError;?></span>
                  <?php endif;?>
              </div>
            </div>

            <div class="control-group <?php echo !empty($totalError)?'error':'';?>">
              <label class="control-label">Total</label>
              <div class="controls">
                  <input id="total" name="total" type="text"  placeholder="Total" value="<?php echo !empty($total)?$total:'';?>">
                  <?php if (!empty($totalError)): ?>
                    <span class="help-inline"><?php echo $totalError;?></span>
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
