<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
  <?php 
    session_start();
    if(!isset($_SESSION['usuario'])){ ?>
        <script>alert('Debe iniciar sesión.');
          location.href="login.php"
        </script>

   <?php      
    }
    if($_SESSION['cargo']=="empleado"){
      ?>
        <script>
          location.href="menu3.php";
        </script>        
      <?php
    }
  ?>
   <div class="hero-unit">
      <h1>RITMO!</h1> 
      <p>"Componer no es difícil, lo complicado es dejar caer bajo la mesa las notas superfluas".Johannes Brahms </p>
      
      <p>
        <a href="trabajador.php" class="btn btn-success "> Empleado</a> | <a href="factura2.php" class="btn btn-success"> Facturacion </a> | <a href="productos.php" class="btn btn-success ">Productos</a> | <a href="listaempleado.php" class="btn btn-success "> Listado de Empleados </a> | <a href="listaproducto.php" class="btn btn-success "> Listado de Productos </a> | <a href="listacliente.php" class="btn btn-success "> Listado de Clientes </a> | <a href="listafactura.php" class="btn btn-success "> Listado de Facturas </a> | <a href="caja.php" class="btn btn-success "> Caja </a> | <a href="logout.php" class="btn btn-danger "> Salir</a> 
     
        
      </p>
    </div>
        
     
 
    
</body>
</html>