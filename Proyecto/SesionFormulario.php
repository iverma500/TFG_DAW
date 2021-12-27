<?php
require_once "_Varios.php";
require_once "_Sesion.php";

entrarSiSesionIniciada();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>TFG - Inicio de sesión</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="CSS/style.css">

</head>
<body>
<?php if (isset($_REQUEST["error"])) { ?>
    <p style="color: red">Error de autenticación, inténtelo de nuevo.</p>
<?php } ?>
<section class="bloqueInfoSesion">
    <?php if (isset($_REQUEST["sesionCerrada"])) { ?>
        <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
    <?php } ?>
</section>
<!-- partial:index.partial.html -->
<div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Registrarse</a></li>
        <li class="tab"><a href="#login">Iniciar sesión</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">
          <h1>Regístrate gratis</h1>

          <form action="SesionComprobar.php" method="post">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nombre<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <label>
                Apellido<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off"/>
          </div>

          <button type="submit" class="button button-block"/>Empezar</button>

          </form>

        </div>

        <div id="login">   
          <h1>¡Bienvenido de nuevo!</h1>
          
          <form action="SesionComprobar.php" method="get">
          
            <div class="field-wrap">
            <label>
              Nombre<span class="req">*</span>
            </label>
            <input type="text" name="identificador" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="contrasenna" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button type="submit" class="button button-block"/>Acceder</button>
          
          </form>

        </div>

      </div><!-- tab-content -->
      
</div> <!-- /form -->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="JS/script.js"></script>

</body>
</html>
