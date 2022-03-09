<?php
require_once "Dato.php";


class Categoria extends Dato
{
    //use Identificable;

    protected string $categoria;


    public function __construct($id, $categoria)
    {
        $this->id = $id;
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCategoria(): string
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }




    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "categoria" => $this->categoria,
        ];
    }
}