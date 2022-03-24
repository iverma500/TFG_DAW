<?php
require_once "../../_Sesion.php";
require_once "../../_Varios.php";
require_once "../../ModeloDatos/DAO.php";

salirSiSesionFalla("../../Menu.php");

if (DAO::usuarioEliminarFotoPerfil($_SESSION["id"])) {
    unlink('../../Imagenes/Usuarios/'.$_SESSION["id"].".png");
    redireccionar("Perfil.php");
} else {
    redireccionar("Perfil.php?errorEliminarFoto");
}
?>