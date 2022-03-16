<?php
require_once "../../_Varios.php";
require_once "../../_Sesion.php";

entrarSiSesionIniciada("../../Menu.php");

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>TFG - Inicio de sesión</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../../CSS/style.css">

</head>
<body>
<section class="bloqueInfoSesion">
    <?php if (isset($_REQUEST["sesionCerrada"])) {?>
        <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
     <?php } if (isset($_REQUEST["error"])) {?>
        <p style='color:red;'>Error al introducir los datos<p>;
       <?php } if (isset($_REQUEST["errorCreacionCuenta"])) {?>
        <p style='color:red;'>Se ha producido un error inesperado. Por favor, vuelve a introducir los datos<p>;
        <?php }?>
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

          <form action="../ContrasennaUsuario/GenerarNuevaCuenta.php" method="post">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nombre<span class="req">*</span>
              </label>
              <input type="text" name="nombre" id="nombre" required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <label>
                Apellidos<span class="req">*</span>
              </label>
              <input type="text" name="apellidos" id="apellidos" required autocomplete="off"/>
            </div>
          </div>

              <div class="field-wrap">
                  <label>
                      Nickname<span class="req">*</span>
                  </label>
                  <input type="text" name="identificador" id="identificador" required autocomplete="off"/>
                  <br>
                  <p style="color: red" id="pErrorNickName"></p>
              </div>

          <div class="field-wrap">
            <label>
              Email<span class="req">*</span>
            </label>
            <input type="email" name="email" id="email" required autocomplete="off"/>
              <br>
              <p style="color: red" id="pErrorEmail"></p>
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="contrasenna" id="contrasenna" required autocomplete="off"/>
          </div>

          <button type="submit" class="button button-block" id="btnCrearCuenta"/>Empezar</button>

          </form>

        </div>

        <div id="login">   
          <h1>¡Bienvenido de nuevo!</h1>
          
          <form action="SesionComprobar.php" method="get">
          
            <div class="field-wrap">
            <label>
              Nickname<span class="req">*</span>
            </label>
            <input type="text" name="identificador" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="contrasenna" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="NuevaContrasenna.php">¿Contraseña Olvidada?</a></p>

          <button type="submit" class="button button-block">Acceder</button>
          
          </form>

        </div>
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="../../JS/script.js"></script>
<script src="../../JS/ValidacionFormularioSesion.js"></script>
</body>
</html>
