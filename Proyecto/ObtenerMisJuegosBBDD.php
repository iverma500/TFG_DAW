<?php

require_once "ModeloDatos/Videojuego.php";
require_once  "ModeloDatos/DAO.php";

//salirSiSesionFalla();

$resultado = DAO::misVideojuegoObtenerTodos(DAO::usuarioObtenerId(), false);

echo json_encode($resultado);