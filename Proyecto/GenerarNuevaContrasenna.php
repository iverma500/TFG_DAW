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
<?php } else if (isset($_REQUEST["errorCreacionSesion"])) { ?>
    <p style="color: red">Error a la hora de crear una nueva sesión. Por favor, inténtelo de nuevo.</p>
<?php } ?>
<section class="bloqueInfoSesion">
    <?php if (isset($_REQUEST["sesionCerrada"])) { ?>
        <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
    <?php } ?>
</section>
<!-- partial:index.partial.html -->
<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a href="#newPassword">Contraseña</a></li>
        <li class="tab"><a href="#volver">Volver</a></li>
    </ul>

    <div class="tab-content">
        <div id="newPassword">
            <h1>Reestablecer Contraseña</h1>

            <form action="NuevaContrasenna.php" method="post">
                <h3>Enviaremos un email con los pasos para reestablecer tu contraseña</h3>
                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            Email<span class="req">*</span>
                        </label>
                        <input type="email" name="email" required autocomplete="off"/>
                    </div>
                    <button type="submit" class="button button-block"/>Empezar</button>

                </div>
            </form>

        </div>
        <div id="volver">
            <a href="SesionFormulario.php"><button class="button button-block">Volver</button></a>
        </div>
    </div><!-- tab-content -->

</div> <!-- /form -->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="JS/script.js"></script>

</body>
</html>