<?php
require_once '_Sesion.php';
require_once '_Varios.php';
//TODO hay que hacer algun tipo de control para asegurar que no hay dos usuarios iguales (con el mismo nombre, email, etc)
$filasNuevas = crearNuevoUsuario($_REQUEST["identificador"], $_REQUEST["email"],$_REQUEST["contrasenna"],$_REQUEST["nombre"], $_REQUEST["apellidos"]);

//TODO sigo trabajando en este metodo. Es normal que salga un error. No afecta al tema de las sesiones.
enviarMensajeCorreo($_REQUEST["email"],$_REQUEST["nombre"]);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear cuenta</title>
    <style>
        body {
            background: rgba(19, 35, 47, 0.3);
        }
    </style>
</head>
<body>
<?php if ($filasNuevas == 1) {?>
<h3 style="color:green;">Sesión creada con éxito.</h3>
    <br>
    <p><a href="SesionComprobar.php?identificador=<?=$_REQUEST['identificador']?>&contrasenna=<?=$_REQUEST['contrasenna']?>">Entrar en la plataforma</a></p>
<?php } else {
redireccionar("SesionFormulario.php?errorCreacionSesion");
}?>
</body>
</html>
