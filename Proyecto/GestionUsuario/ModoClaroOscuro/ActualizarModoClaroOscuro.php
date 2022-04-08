<?php
require_once "../../ModeloDatos/DAO.php";
require_once "../../_Sesion.php";

salirSiSesionFalla("GestionUsuario/SesionUsuario/SesionFormulario.php");

$modoSeleccionado = $_REQUEST["modoActivo"];
//Actualizo el modo seleccionado en RAM
$_SESSION["modo"] = $modoSeleccionado;

echo json_encode(DAO::actualizarModoClaroOscuro($_SESSION["id"], $modoSeleccionado));
?>