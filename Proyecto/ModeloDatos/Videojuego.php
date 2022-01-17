<?php
require_once "Dato.php";
class Videojuego extends Dato
{
    //use Identificable;

    protected string $nombre;
    protected string $identificadorFoto;
    protected int $categoriaId;


    public function __construct($id, $nombre, $identificadorFoto, $categoriaId)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->identificadorFoto = $identificadorFoto;
        $this->categoriaId = $categoriaId;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getIdentificadorFoto(): string
    {
        return $this->identificadorFoto;
    }

    /**
     * @param string $identificadorFoto
     */
    public function setIdentificadorFoto(string $identificadorFoto): void
    {
        $this->identificadorFoto = $identificadorFoto;
    }

    /**
     * @return int
     */
    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    /**
     * @param int $categoriaId
     */
    public function setCategoriaId(int $categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }



    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "identificadorFoto" => $this->identificadorFoto,
            "categoriaId" => $this->categoriaId,
            ];

    }
}
?>