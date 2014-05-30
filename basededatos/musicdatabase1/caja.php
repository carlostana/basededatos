

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
              <p>Caja</p>

            <!-- </div> -->
            <?php 
                $Conecto = mysql_connect('localhost','root');
                $SelecDB = mysql_select_db("musicdatabase",$Conecto);
                $ssql = mysql_query(" SELECT SUM(total) as total FROM factura WHERE Id_fact >=0"); 
                $consulta=mysql_query("SELECT SUM( cantidad * precio ) as total FROM productos WHERE Id_producto >=0");
                
                $row = mysql_fetch_array($ssql);
                $total1=$row["total"];
                $row = mysql_fetch_array($consulta);
                $total2=$row["total"];

                $Resultado= $total1-$total2;



               
                
                echo "<div align=\"center\">El total hasta el momento en caja es de: $Resultado</div><br>"; 
            ?>
           <center><a href="menu2.php" class="btn btn-danger btn-large "> Salir</a></center>

        </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>