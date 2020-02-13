<?php

namespace App\Models;

require_once '../config/Database.php';

use Database;

class Practica
{

    private $id;
    private $codigo;
    private $descripcion;
    private $cantMaxDiaria;
    private $cantMaxMen;
    private $cantMaxAnu;


    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCantMaxDiaria()
    {
        return $this->cantMaxDiaria;
    }

    public function setCantMaxDiaria($cantMaxDiaria)
    {
        $this->cantMaxDiaria = $cantMaxDiaria;

        return $this;
    }

    public function getCantMaxMen()
    {
        return $this->cantMaxMen;
    }

    public function setCantMaxMen($cantMaxMen)
    {
        $this->cantMaxMen = $cantMaxMen;

        return $this;
    }

    public function getCantMaxAnu()
    {
        return $this->cantMaxAnu;
    }

    public function setCantMaxAnu($cantMaxAnu)
    {
        $this->cantMaxAnu = $cantMaxAnu;

        return $this;
    }


    // Selecciona todos los registros de la DB
    public function viewAll()
    {
        $sql = "SELECT * FROM practicas ORDER BY codigo DESC";

        $query = $this->db->query($sql);

        return $query;
    }

    // Gurdar registro en la BD
    public function save()
    {

        $sql = "INSERT INTO practicas VALUES(null,'{$this->getCodigo()}','{$this->getDescripcion()}',{$this->getCantMaxDiaria()},{$this->getCantMaxMen()},{$this->getCantMaxAnu()},1)";

        $save = $this->db->query($sql);

        return $save;
    }
}
