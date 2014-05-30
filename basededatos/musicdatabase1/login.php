<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <form action="validar.php" method="post">
    <div class="hero-unit">
        <h1>RITMO!</h1> 
      <p>Ingresar</p>
     <table>
      <tr>
       <td>Id_Usuario:</td>
       <td><input name="admin" required="required" type="text" /></td>
      </tr>
      <tr>
       <td>Contraseña:</td>
       <td><input name="password_usuario" required="required" type="password" /></td> 
      </tr>
      <tr>
       <td colspan="2"><input name="iniciar" type="submit" value="Iniciar Sesión" />
        <a class="btn btn-danger" href="index.php">Atrás</a> </td>

    </table>
</div>
</form>
</body>
</html>
