<?php

require_once "ModeloDatos/Categoria.php";
require_once  "ModeloDatos/DAO.php";

//salirSiSesionFalla();

$resultado = DAO::categoriaObtenerTodos();

echo json_encode($resultado);