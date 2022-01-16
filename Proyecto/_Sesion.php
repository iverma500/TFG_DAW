<?php

declare(strict_types=1);

session_start();

function entrarSiSesionIniciada()
{
    if (comprobarRenovarSesion()) redireccionar("Menu.php");
}

function salirSiSesionFalla()
{
    if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
}

function comprobarRenovarSesion(): bool
{
    if (haySesionRAM()) {
        if (isset($_COOKIE["id"])) { // Basta con mirar si parece que viene cookie porque ya acabamos de validar la sesión RAM
            generarRenovarSesionCookie();
        }
        return true; // Esto es en todo caso
    } else { // NO hay sesión RAM
        $usuario = obtenerUsuarioPorCookie();
        if ($usuario) { // Equivale a if ($usuario != null)
            generarSesionRAM($usuario); // Canjear la sesión cookie por una sesión RAM.
            generarRenovarSesionCookie();
            return true;
        } else { // Ni RAM, ni cookie
            return false;
        }
    }
}

function haySesionRAM(): bool
{
    return isset($_SESSION["id"]);
}

function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
{
    $conexion = obtenerPdoConexionBD();
    $sql = "SELECT id, identificador, nombre FROM usuario
            WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $filasObtenidas = $select->rowCount();

    if ($filasObtenidas == 0) return null;
    else return $select->fetch();
}

// Antiguo haySesionCookie(): bool
function obtenerUsuarioPorCookie(): ?array
{
    if (isset($_COOKIE["id"])) {
        $conexion = obtenerPdoConexionBD();

        $sql = "SELECT id, identificador, nombre FROM usuario
                WHERE id = ? AND BINARY codigoCookie = ? AND caducidadCodigoCookie >= ?";
        $select = $conexion->prepare($sql);
        $select->execute([
            $_COOKIE["id"],
            $_COOKIE["codigoCookie"],
            date("Y-m-d H:i:s", time()) // Fecha-hora de ahora mismo obtenida del sistema.
        ]);
        $filasObtenidas = $select->rowCount();

        if ($filasObtenidas == 0) return null;
        else return $select->fetch();
    } else {
        return null;
    }
}

function generarSesionRAM(array $usuario)
{
    // Guardar el id es lo único indispensable.
    // El resto son por evitar accesos a la BD a cambio del riesgo
    // de que mis datos en sesión RAM estén obsoletos.
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["identificador"] = $usuario["identificador"];
    $_SESSION["nombre"] = $usuario["nombre"];
}

function generarRenovarSesionCookie()
{
    $codigoCookie = uniqid(); // Genera un código aleatorio "largo".

    $fechaCaducidad = time() + 24 * 60 * 60;
    $fechaCaducidadParaBD = date("Y-m-d H:i:s", $fechaCaducidad);

    // Anotar en la BD el codigoCookie y su caducidad.
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=?, caducidadCodigoCookie=? WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $fechaCaducidadParaBD, $_SESSION["id"]]);

    // Crear (o renovar) las cookies.
    setcookie('id', strval($_SESSION["id"]), $fechaCaducidad);
    setcookie('codigoCookie', $codigoCookie, $fechaCaducidad);
}

function cerrarSesion()
{
    // Eliminar de la BD el codigoCookie y su caducidad.
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL, caducidadCodigoCookie=NULL WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

    // Borrar las cookies.
    setcookie('id', "", time() - 3600);
    setcookie('codigoCookie', "", time() - 3600);

    // Destruir sesión RAM (implica borrar cookie de PHP "PHPSESSID").
    session_destroy();
}

function crearNuevoUsuario($identificador, $email, $contrasenna, $nombre, $apellidos): int
{

    /*SIGNIFICADOS RETURNS:
    -3 -> Error al crear la cuenta (se ha realizado el "INSERT" pero algo ha salido mal) ERROR
    1 ->  Operación realizada con ÉXITO
    */

    $conexion = obtenerPdoConexionBD();

    //En caso de que no esten repetidos. Creo el nuevo usuario en la BBDD
    $sql = "INSERT INTO usuario (identificador, email, contrasenna, codigoCookie, caducidadCodigoCookie, nombre, apellidos) VALUES (?,?,?,?,?,?,?)";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $email, $contrasenna, null, null, $nombre, $apellidos]);
    $numRegistros = $select->rowCount();
    if ($numRegistros == 1) {
        //Devuelvo 1 que quiere decir que la operacion ha salido bien
        return 1;
    } else {
        //Devuelvo -3 que quiere decir que algo ha salido mal en el insert de la BBDD
        return -3;
    }
}

function crearNuevaContrasenna($identificador, $email, $contrasenna): int
{
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET contrasenna = ? WHERE email = ? AND identificador = ?";
    $select = $conexion->prepare($sql);
    $select->execute([$contrasenna, $email, $identificador]);
    //$filasObtenidas = $select->rowCount();
    return $select->rowCount();
    //if ($filasObtenidas == 0) return null;
    //  else return $select->fetch();
}

function enviarMensajeCorreo($email, $nombre):bool
{
    //--AQUI HAGO LO DE ENVIAR EL MENSAJE AL CORREO DANDO LA BIENVENIDA Y TAL
    $to = $email;
    $subject = "Asunto del email";
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: the FGL association <theFGL@platform.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$sender = "theFGL@platform.com";
   /* $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();*/
    $message = "
<html>
<head>
<title>Cuenta creada en FGL</title>
</head>
<body>
<h4>Gracias por crearte una cuenta en nuestra aplicación online</h4>
<p>
Hola $nombre. La Fandom Game Library (FGL) es una librería online sin apenas ánimo de lucro
en la que los mejores desarrolladores de software libre suben sus proyectos para
que gente como tú puedan disfrutarlos... <b>¡Y la mayoría de ellos son totalmente gratis!<b>
<br>
<p>Espero que lo disfrutes y quién sabe, a lo mejor te animas a subir tu propio contenido (:</p>
</body>
</html>";
    //mail($to, $subject, $message, $sender);
    return mail($to, $subject, $message, $headers);
//--------------------------------
}
//TODO crear un token para que funcione del todo correcto
function enviarMensajeCorreoPassword($email,$identificador):bool
{
    //--AQUI HAGO LO DE ENVIAR EL MENSAJE AL CORREO DANDO LA BIENVENIDA Y TAL
    $to = $email;
    $subject = "Asunto del email";
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: the FGL association <theFGL@platform.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message = "
<html>
<head>
<title>Reestablecer Contraseña FGL</title>
</head>
<body>
<h1>Correo de confirmación</h1>
<p>Hola $identificador.</p>
<p>Te enviamos este correo de confirmación para reestablecer tu contraseña</p>
<p>Accede a este enlace para cambiar tu contraseña:</p>
<br>
<a href='http://localhost:63342/TFG_DAW/Proyecto/CorreoContrasenna.php?_ijt=3rh7hrdeulcm2c9jb0qeps0vbh'>ACCEDER</a>
<br>
<p>Un saludo Fandom Game Library (FGL) (:</p>
</body>
</html>";

   return mail($to, $subject, $message, $headers);
//--------------------------------
}