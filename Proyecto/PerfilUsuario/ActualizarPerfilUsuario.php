<?php
require_once "../_Sesion.php";
require_once "../_Varios.php";
require_once  "../ModeloDatos/DAO.php";

salirSiSesionFalla("../SesionFormulario.php");

echo json_encode(DAO::usuarioActualizar($_SESSION["id"], $_REQUEST["identificador"],$_REQUEST["nombre"], $_REQUEST["apellidos"]));
?>