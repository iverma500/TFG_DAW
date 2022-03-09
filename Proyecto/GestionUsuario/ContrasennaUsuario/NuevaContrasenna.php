<?php
require_once '../../_Sesion.php';
require_once '../../_Varios.php';

entrarSiSesionIniciada("../../Menu.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reestablecer Contraseña</title>
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
        <div class="form">

            <form action="EnviarCorreoContrasenna.php" method="post">
                <div class="top-row"></div>

                <div class="field-wrap">
                    <label>
                        Nickname<span class="req">*</span>
                    </label>
                    <input type="text" name="identificador" id="identificador" required autocomplete="off"/>
                    <p style="color: red" id="pErrorNickName"></p>
                </div>

                <div class="field-wrap">
                    <label>
                        Email<span class="req">*</span>
                    </label>
                    <input type="email" name="email" id="email" required autocomplete="off"/>
                    <p style="color: red" id="pErrorEmail"></p>
                </div>

                <button type="submit" class="button button-block" id="btnReestablecerPassword"/>Reestablecer</button>

            </form>
        </div>
        <!-- partial -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="../../JS/script.js"></script>
    </body>
</html>
