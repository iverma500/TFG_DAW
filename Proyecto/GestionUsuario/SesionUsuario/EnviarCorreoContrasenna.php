<?php
require_once '../../_Sesion.php';
require_once '../../_Varios.php';

if (isset($_REQUEST["email"]) && isset($_REQUEST["identificador"])){
    $email = $_REQUEST["email"];
    $identificador = $_REQUEST["identificador"];
} else {
    $email = "";
    $identificador = "";
}

if (isset($_REQUEST['cod'])){
    redireccionar("CorreoContrasenna.php");
} else {
    $correoEnviado = enviarMensajeCorreoPassword($email,$identificador);
}
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
    <section class="form">
        <h2 style="color:green; font-size: xx-large">Un paso más cerca.</h2>
        <br>
        <?php if ($correoEnviado) {?>
            <h4 style="color:green; font-size: medium">Se ha enviado un correo a la cuenta especificada</h4>

            <input type="hidden" id="email" name="email" value="<?= $email ?>">
            <input type="hidden" id="identificador" name="identificador" value="<?= $identificador ?>">
            <form method="post">
                <div class="field-wrap">
                    <label>
                        Código<span class="req">*</span>
                    </label>
                    <input type="text" name="cod" id="cod" required autocomplete="off"/>
                    <br>
                    <p style="color: red" id="pErrorCodigo"></p>
                </div>
                <input type="submit" value="Enviar" id="btnEnviarCodigo" name="btnEnviarCodigo">
            </form>
        <?php } else {?>
            <h4 style="color:red; font-size: medium">No se ha podido enviar un correo a la cuenta especificada</h4>
            <br>
            <button class="btnVolver">
                <a href="SesionFormulario.php">Volver al Inicio de Sesión</a>
            </button>
        <?php } ?>
    </section>
<br><br>

</body>
<script src="../../JS/ValidacionCodigoRecuperacion.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="../../JS/script.js"></script>
</html>