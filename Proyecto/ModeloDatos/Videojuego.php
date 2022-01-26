<?php
require_once "Dato.php";
class Videojuego extends Dato
{
    //use Identificable;

    protected string $nombre;
    protected string $descripcion;
    protected float  $precioActual;
    protected float  $precioViejo;
    protected string $identificadorFoto;
    protected int    $categoriaId;


    public function __construct($id, $nombre, $descripcion, $precioActual, $precioViejo, $categoriaId)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precioActual = $precioActual;
        $this->precioViejo = $precioViejo;
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
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return float
     */
    public function getPrecioActual(): float
    {
        return $this->precioActual;
    }

    /**
     * @param float $precioActual
     */
    public function setPrecioActual(float $precioActual): void
    {
        $this->precioActual = $precioActual;
    }

    /**
     * @return float
     */
    public function getPrecioViejo(): float
    {
        return $this->precioViejo;
    }

    /**
     * @param float $precioViejo
     */
    public function setPrecioViejo(float $precioViejo): void
    {
        $this->precioActual = $precioViejo;
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
            "descripcion" => $this->descripcion,
            "precioActual" => $this->precioActual,
            "precioViejo" => $this->precioViejo,
            "categoriaId" => $this->categoriaId,
            ];
    }
}
?>