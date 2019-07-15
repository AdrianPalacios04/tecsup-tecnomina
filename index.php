<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style-login.css">
    
  </head>
  <body>
    <form action="verificacion.php" method="post">
      <div class="login-box">
  <h1>Login</h1>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Username" name="usuario">
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Password" name="clave">
  </div>
  <div class="textbox">
    <select name="tipo">
            <option>seleccionar</option>
            <option value="A">administrador</option>
            <option value="P">general</option>
    </select><br>
  </div>
  <input type="submit" name="Aceptar" value="Aceptar" class ="btn btn-success" >
</div>

    </form>
  </body>
</html>
