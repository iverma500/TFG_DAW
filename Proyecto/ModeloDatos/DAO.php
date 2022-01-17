<?php

require_once "Videojuego.php";

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
        return new Videojuego($fila["id"],$fila["nombre"], $fila["identificadorFoto"], $fila["categoriaId"]);
    }

    private static function videojuegoObtenerPorId(int $id): ?Videojuego
    {
        $rs = Self::ejecutarConsulta(
            " SELECT
                    v.id       AS v_id,
                    v.nombre   AS v_denominacion,
                    v.identificadorFoto AS v_identificadorFoto,
                    v.categoriaId       AS v_categoriaId,
                    c.categoria   AS c_categoria
                FROM
                   videojuego AS v INNER JOIN categoriavideojuego AS c ON v.categoriaId = c.id 
                WHERE p.id=?",
            [$id]
        );

        if($rs) return Self::productoCrearDesdeFila($rs[0]);
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
            $producto = Self::videojuegoCrearDesdeFila($fila);
            array_push($datos, $producto);
        }

        return $datos;
    }



    public static function videojuegoEliminarPorId(int $id): bool
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "DELETE FROM videojuego WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function videojuegoCrear(string $nombre, string $identificadorFoto, int $categoriaId): ?Videojuego
    {
        $idAutogenerado = Self::ejecutarInsert(
            "INSERT INTO videojuego  VALUES (NULL ,?, ?, ?)",
            [$nombre, $identificadorFoto, $categoriaId]
        );

        if ($idAutogenerado == null) return null;
        else return Self::productoObtenerPorId($idAutogenerado); // TODO hacer un new y ya, y así no molestamos a la BD.
    }

    public static function videojuegoActualizar(Videojuego $videojuego): ?Videojuego
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE videojuego SET nombre=?, identificadorFoto=?, categoriaId=? WHERE id=?",
            [$videojuego->getNombre(), $videojuego->getIdentificadorFoto(), $videojuego->getCategoriaId(), $videojuego->getId()]
        );

        if ($filasAfectadas === null) return null; // Necesario triple igual porque si no considera que 0 sí es igual a null
        else return $videojuego;
    }


}