<?php

namespace App\Models;

require_once '../config/Database.php';

use Database;

class Paciente
{

    private $id;
    private $nombre;
    private $beneficio;
    private $dni;
    private $activo;

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getBeneficio() {
        return $this->beneficio;
    }
   
    public function setBeneficio($beneficio) {
        $this->beneficio = $beneficio;
        return $this;
    }   

    public function getDni() {
        return $this->dni;
    }
   
    public function setDni($dni) {
        $this->dni = $dni;
        return $this;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
        return $this;
    }
    

    // Extrae todos los registros de la base de datos
    public function showAll () {
        $sql = "SELECT * FROM pacientes ORDER BY nombre DESC";

        $query = $this->db->query($sql);

        return $query;
    }

    // Extrae todos los registros de la base de datos
    public function save () {
         
        $sql = "INSERT INTO pacientes VALUES(null,'{$this->getNombre()}','{$this->getBeneficio()}',{$this->getDni()},1)";

        $save = $this->db->query($sql);

        return $save;
    }

}
