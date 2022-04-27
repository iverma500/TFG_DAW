<?php
require_once "../../ModeloDatos/DAO.php";

echo json_encode(DAO::existeUsuarioConEsteNickName($_REQUEST["identificador"]));
?>