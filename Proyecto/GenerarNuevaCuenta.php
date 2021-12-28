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
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php if ($filasNuevas == 1) {?>
        <section class="form">
            <h2 style="color:green; font-size: xx-large">Sesión creada con éxito.</h2>
    <br>
            <h4><a class="enlaceFormato" href="SesionComprobar.php?identificador=<?=$_REQUEST['identificador']?>&contrasenna=<?=$_REQUEST['contrasenna']?>">Entrar en la plataforma</a></h4>
       </section>
            <?php } else {
redireccionar("SesionFormulario.php?errorCreacionSesion");
}?>
</body>
</html>
