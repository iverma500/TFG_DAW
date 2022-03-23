<?php
require_once "../../ModeloDatos/DAO.php";

echo json_encode(DAO::existeUsuarioConEsteEmail($_REQUEST["email"]));
?>