<?php

namespace App\Models;

require_once '../config/Database.php';

use Database;

class Internacion

{
    private $idInternacion;
    private $idDePaciente;
    private $fechaIngreso;
    private $fechaEgreso;

    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }

  
    public function getId() {
        return $this->idInternacion;
    }

   
    public function setId($id) {
        $this->idInternacion = $id;
        return $this;
    }

   
    public function getIdDePaciente() {
        
        return $this->idDePaciente;
    }

    public function setIdDePaciente($idDePaciente) {

  
        $this->idDePaciente = $this->db->real_escape_string($idDePaciente);

        return $this;
    }

  
    public function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $this->db->real_escape_string($fechaIngreso);
        return $this;
    }

    public function getFechaEgreso() {
        return $this->fechaEgreso;
    }

    public function setFechaEgreso($fechaEgreso) {
        $this->fechaEgreso = $this->db->real_escape_string($fechaEgreso);
        return $this;
    }

    
     // Extrae todos los registros de la base de datos
     public function save () {
         
        $sql = "INSERT INTO internaciones VALUES(null,{$this->getIdDePaciente()},'{$this->getFechaIngreso()}','{$this->getFechaEgreso()}')";

        $save = $this->db->query($sql);

        return $save;
    }

    // Extrae todos los registros de la base de datos
    public function showAll () {
        $sql = "SELECT * FROM internaciones INNER JOIN pacientes ON
        internaciones.idDePaciente = pacientes.idPaciente
          ORDER BY internaciones.fechaIngreso DESC";

        $query = $this->db->query($sql);

        return $query;
    }

}
