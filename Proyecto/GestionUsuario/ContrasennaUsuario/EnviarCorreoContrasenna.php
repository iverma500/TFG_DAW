<?php
require_once '../../_Sesion.php';
require_once '../../_Varios.php';


if (isset($_REQUEST['cod'])){

    $host = $_SERVER['HTTP_HOST'];
    $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $html = 'CorreoContrasenna.php';
    $url = "http://$host$ruta/$html";

    header("Location: $url");
    include redirect.php;
    die();
} else {
    $correoEnviado = enviarMensajeCorreoPassword($_REQUEST["email"],$_REQUEST["identificador"]);
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
        <h2 style="color:green; font-size: xx-large">Sesión creada con éxito.</h2>
        <br>
        <?php if ($correoEnviado) {?>
            <h4 style="color:green; font-size: medium">Se ha enviado un correo a la cuenta especificada</h4>

            <form method="post">
                <label for="cod">Código</label>
                <input type="text" id="cod" name="cod">
                <input type="submit" value="Enviar">
            </form>
        <?php } else {?>
            <h4 style="color:red; font-size: medium">No se ha podido enviar un correo a la cuenta especificada</h4>
        <?php } ?>
    </section>
</body>
</html>