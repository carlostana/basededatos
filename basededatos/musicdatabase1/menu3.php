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
        ?>

           <?php      
    if($_SESSION['cargo']=="gerente" || $_SESSION['cargo']=="jefe"){
      ?>
        <script>
          location.href="menu2.php";
        </script>        
      <?php
    }
  ?>
   <div class="hero-unit">
      <h1>RITMO!</h1> 
      <p>"La música es para el alma lo que la gimnasia para el cuerpo".PLatón</p>
      
      <p>
         <a href="factura2.php" class="btn btn-success"> Facturacion </a> | <a href="logout.php" class="btn btn-danger "> Atras</a>

        
      </p>
    </div>
        
     
 
    
</body>
</html>