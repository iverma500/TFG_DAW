<?php
require_once "../../_Varios.php";

function validarUsuario($identificador, $email): int
{
    /*SIGNIFICADOS RETURNS:
    -1 -> El nickname NO EXISTE ERROR
    -2 -> El email NO EXISTE ERROR
     0 -> Los datos son correctos BIEN
    */
    $conexion = obtenerPdoConexionBD();

//Primero compruebo que no exista el identificador ni el email en la BBDD
    $sql = "SELECT * FROM usuario WHERE BINARY identificador=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador]);
    $numRegistros = $select->rowCount();
    if ($numRegistros == 0) {
        //Devuelvo -1 que quiere decir que el nickname NO EXISTE
        return -1;
    } else {
        $sql = "SELECT * FROM usuario WHERE BINARY email=?";
        $select = $conexion->prepare($sql);
        $select->execute([$email]);
        $numRegistros = $select->rowCount();
        if ($numRegistros == 0) {
            //Devuelvo -2 que quiere decir que el email NO EXISTE
            return -2;
        } else {
            //Devuelvo 0 que quiere decir que Los datos son correctos
            return 0;
        }
    }
}
echo json_encode(validarUsuario($_REQUEST["identificador"], $_REQUEST["email"]));
?>