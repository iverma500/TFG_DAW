<?php
require_once "ModeloDatos/DAO.php";

$modoActivo = $_REQUEST["modoActivo"];
echo json_encode(DAO::modificarCookieModoClaroOscuro($modoActivo));
?>