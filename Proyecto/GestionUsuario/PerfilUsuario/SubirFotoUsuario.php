<?php
require_once "../../_Sesion.php";
require_once "../../_Varios.php";
require_once "../../ModeloDatos/DAO.php";

salirSiSesionFalla("../../Menu.php");


//Si se quiere subir una imagen
if (isset($_POST['subir']) && ($_REQUEST["archivo"]['size'] >= 0)) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        redireccionar("Perfil.php?errorExtArchivo");
        }
        else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor con el nombre del id del usuario y con "png" como extension para organizarme
            if (move_uploaded_file($temp, '../../Imagenes/Usuarios/'.$_SESSION["id"].".png")) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('images/'.$archivo, 0777);

                //actualizamos la base de datos
                if (DAO::usuarioAnnadirFotoPerfil($_SESSION["id"])) {
                    redireccionar("Perfil.php?archivo");
                } else {
                    redireccionar("Perfil.php?errorSubirArchivo");
                }
            }
            else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                redireccionar("Perfil.php?errorSubirArchivo");
            }
        }
    }
} else {
    redireccionar("Perfil.php");
}
?>