<?php

require_once "Videojuego.php";
session_start();

class DAO
{
    private static ?PDO $conexion = null;

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "bbdd_tfg"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            echo "\n\nError al conectar:\n" . $e->getMessage();
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }

        return $pdo;
    }

    private static function garantizarConexion()
    {
        if (Self::$conexion == null) {
            Self::$conexion = Self::obtenerPdoConexionBd();
        }
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        Self::garantizarConexion();

        $select = Self::$conexion->prepare($sql);
        $select->execute($parametros);
        return $select->fetchAll(); // Se devuelve "el $rs"
    }

    // Devuelve:
    //   - null: si ha habido un error
    //   - int: el id autogenerado para el nuevo registro, si todo bien.
    private static function ejecutarInsert(string $sql, array $parametros): ?int
    {
        Self::garantizarConexion();

        $insert = Self::$conexion->prepare($sql);
        $sqlConExito = $insert->execute($parametros);

        if (!$sqlConExito) return null;
        else return Self::$conexion->lastInsertId();
    }

    // Ejecuta un Update o un Delete.
    // Devuelve:
    //   - null: si ha habido un error
    //   - 0, 1 u otro número positivo: OK (no errores) y estas son las filas afectadas.
    private static function ejecutarUpdel(string $sql, array $parametros): ?int
    {
        Self::garantizarConexion();

        $updel = Self::$conexion->prepare($sql);
        $sqlConExito = $updel->execute($parametros);

        if (!$sqlConExito) return null;
        else return $updel->rowCount();
    }

    // VIDEOJUEGO

    private static function videojuegoCrearDesdeFila(array $fila): Videojuego
    {
        return new Videojuego($fila["id"],
                              $fila["nombre"],
                              $fila["descripcion"],
                              $fila["precioActual"],
                              $fila["precioViejo"],
                              $fila["categoriaId"]);
    }

    private static function videojuegoObtenerPorId(int $id): ?Videojuego
    {
        $rs = Self::ejecutarConsulta(
            " SELECT
                    v.id       AS v_id,
                    v.nombre   AS v_denominacion,
                    v.categoriaId       AS v_categoriaId,
                    c.categoria   AS c_categoria
                FROM
                   videojuego AS v INNER JOIN categoriavideojuego AS c ON v.categoriaId = c.id 
                WHERE p.id=?",
            [$id]
        );

        if($rs) return Self::videojuegoCrearDesdeFila($rs[0]);
        else return null;
    }

    public static function videojuegoObtenerTodos(): array
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM videojuego ORDER BY nombre",
            []
        );

        $datos = [];
        foreach ($rs as $fila) {
            $videojuego = Self::videojuegoCrearDesdeFila($fila);
            array_push($datos, $videojuego);
        }

        return $datos;
    }

    //En esta funcion obtengo el id de los videojuegos que tiene el usuario
    //para luego devolver los datos de dichos videojuegos
    public static function misVideojuegoObtenerTodos(int $id, bool $soloIdsJuegos): array
    {
        $rs = Self::ejecutarConsulta(
            "SELECT codVideojuegos FROM usuario WHERE id=?",
            [$id]
        );
        //explode es como split() en otros lenguajes
        $datos = explode(",", $rs[0]["codVideojuegos"]);
        //SI EL USUARIO MANDA TRUE COMO SEGUNDO PARAMETRO ENTONCES DEVUELVO SOLO UN ARRAY CON LOS IDS DE LOS VIDEOJUEGOS
        //EN CASO DE QUE SEA FALSE ENTONCES DEVUELVO UN ARRAY CON TODOS LOS DATOS DE LOS VIDEOJUEGOS
        if ($soloIdsJuegos) {
            return $datos;
        } else {
            $videojuegos = [];
            foreach ($datos as $IdvideojuegoActual) {
            $rs = Self::ejecutarConsulta(
                "SELECT * FROM videojuego WHERE id=?",
                [$IdvideojuegoActual]
            );
            foreach ($rs as $fila) {
                $videojuego = Self::videojuegoCrearDesdeFila($fila);
                array_push($videojuegos, $videojuego);
            }
            }
        }
        return $videojuegos;
    }

    public static function misJuegosBorrar(int $idUser, int $idJuego): bool
    {
        $datos = Self::misVideojuegoObtenerTodos($idUser,true);

        for($i=0;$i<count($datos);$i++){
            if($datos[$i] == $idJuego){
                unset($datos[$i]);
            }
        }

        //Contrario de explode hacer string
        $stringIDS = implode(',',$datos);

        $borrar = Self::videojuegoAnnadirIdAUsuario($stringIDS,$idUser);

        if ($borrar){
            return true;
        } else {
            return false;
        }
    }

    public static function videojuegoEliminarPorId(int $id): bool
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "DELETE FROM videojuego WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function videojuegoCrear(string $nombre, string $descripcion, float $precioActual, float $precioViejo, int $categoriaId): ?Videojuego
    {
        $idAutogenerado = Self::ejecutarInsert(
            "INSERT INTO videojuego  VALUES (NULL , ? , ? , ? , ?)",
            [$nombre, $descripcion, $precioActual, $precioViejo, $categoriaId]
        );

        if ($idAutogenerado == null) return null;
        else return Self::videojuegoObtenerPorId($idAutogenerado); // TODO hacer un new y ya, y así no molestamos a la BD.
    }

    public static function videojuegoActualizar(Videojuego $videojuego): ?Videojuego
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE videojuego SET nombre=?, categoriaId=? WHERE id=?",
            [$videojuego->getNombre(), $videojuego->getCategoriaId(), $videojuego->getId()]
        );

        if ($filasAfectadas === null) return null; // Necesario triple igual porque si no considera que 0 sí es igual a null
        else return $videojuego;
    }
     public static function videojuegoAnnadirIdAUsuario(string $videojuegosIds, int $idUsuario):bool
     {
         $filasAfectadas = Self::ejecutarUpdel(
             "UPDATE usuario SET codVideojuegos=? WHERE id=?",
             [$videojuegosIds,$idUsuario]
         );
         if ($filasAfectadas === null) return false; // Necesario triple igual porque si no considera que 0 sí es igual a null
         else return true;
     }
     /*      USUARIO */
    public static function usuarioActualizar($id,$identificador, $nombre, $apellidos, $email): int
    {
        //Si recibo email = "-" quiere decir que no hay que actualizar el email. Si recibo otra cosa, entonces si
        if ($email == "-") {
            $filasAfectadas = Self::ejecutarUpdel(
                "UPDATE usuario SET identificador=?, nombre=?, apellidos=? WHERE id=?",
                [$identificador, $nombre, $apellidos, $id]
            );

            self::refrescarDatosUsuario();
            return $filasAfectadas;
        }else {
            $filasAfectadas = Self::ejecutarUpdel(
                "UPDATE usuario SET identificador=?, nombre=?, apellidos=?, email=? WHERE id=?",
                [$identificador, $nombre, $apellidos, $email, $id]
            );

            self::refrescarDatosUsuario();
            return $filasAfectadas;
        }
    }

    public static function refrescarDatosUsuario()
    {
        $rs = Self::ejecutarConsulta(
            "SELECT identificador, nombre, apellidos, email FROM usuario WHERE id = ?",
            [$_SESSION["id"]]
        );

           $_SESSION["nombre"] = $rs[0]["nombre"];
           $_SESSION["apellidos"] = $rs[0]["apellidos"];
           $_SESSION["email"] = $rs[0]["email"];
           $_SESSION["identificador"] = $rs[0]["identificador"];
    }


    public static function usuarioObtenerId(): int
    {
        $rs = Self::ejecutarConsulta(
            "SELECT id FROM usuario WHERE identificador = ?",
            [$_SESSION["identificador"]]
        );
        return $rs[0]["id"];
    }

    public static function existeUsuarioConEsteEmail($email)
    {
        $nickname = $_SESSION["identificador"];
        //Este metodo devuelve true si existe un usuario con el email especificado y false si no
        $rs = Self::ejecutarConsulta(
            "SELECT id FROM usuario WHERE email = ? AND identificador != ?",
            [$email, $nickname]
        );
        if (empty($rs)) {
            return false;
        } else {
            return true;
        }
    }

    public static function videojuegoObtenerFiltrados($categoria): array
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM videojuego WHERE categoriaId = ?",
            [$categoria]
        );

        $datos = [];
        foreach ($rs as $fila) {
            $videojuego = Self::videojuegoCrearDesdeFila($fila);
            array_push($datos, $videojuego);
        }

        return $datos;
    }

    private static function categoriaCrearDesdeFila(array $fila): Categoria
    {
        return new Categoria($fila["id"], $fila["categoria"]);
    }

    public static function categoriaObtenerTodos(): array
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM categoriavideojuego ORDER BY categoria",
            []
        );

        $datos = [];
        foreach ($rs as $fila) {
            $categoria = Self::categoriaCrearDesdeFila($fila);
            array_push($datos, $categoria);
        }
        return $datos;
    }
    /* GESTION IMAGENES DE PERFIL USUARIOS */

    public static function usuarioYaTieneFotoPerfil($idUsuario): bool
    {
        //Este metodo devuelve false si el usuario tiene 0 en la columna "fotoPerfil" (es decir, no tiene foto) y true en caso contrario
        $rs = Self::ejecutarConsulta(
            "SELECT fotoPerfil FROM usuario WHERE id = ?",
            [$idUsuario]
        );
        if ($rs[0]["fotoPerfil"] == 0) {
            return false;
        } else {
            return true;
        }
    }
    public static function usuarioAnnadirFotoPerfil($idUsuario):bool
    {
        //Modifico la base de datos y pongo 1 (si hay foto) en vez de 0 (no hay foto)
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE usuario SET fotoPerfil=? WHERE id=?",
            [1, $idUsuario]
        );
        if ($filasAfectadas==1) return true;
        else return false;
    }
    public static function usuarioEliminarFotoPerfil($idUsuario):bool
    {
        //Modifico la base de datos y pongo 0 (no hay foto) en vez de 1 (si hay foto)
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE usuario SET fotoPerfil=? WHERE id=?",
            [0, $idUsuario]
        );
        if ($filasAfectadas==1) return true;
        else return false;
    }

    /* GESTIÓN MODO CLARO/OSCURO */

    public static function modificarCookieModoClaroOscuro($modoSeleccionado): bool {
        return setcookie("modo", $modoSeleccionado, time()+24*60*60*10); //Cookie de duración = 10 días
    }
}