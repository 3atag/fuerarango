<?php

namespace App\Models;


class Internacion extends BaseElement

{

    private $id;
    private $idDePaciente;
    private $fechaIngreso;
    private $fechaEgreso;
    private $activo;

    public function __construct(

    )
    {
        parent::__construct();
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

   
    public function getIdDePaciente()
    {
        return $this->idDePaciente;
    }

    public function setIdDePaciente($idDePaciente)
    {
        $this->idDePaciente = $idDePaciente;

        return $this;
    }

  
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getFechaEgreso()
    {
        return $this->fechaEgreso;
    }

    public function setFechaEgreso($fechaEgreso)
    {
        $this->fechaEgreso = $fechaEgreso;

        return $this;
    }

    public function getActivo()
    {
        return $this->activo;
    }

 
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    // Extrae todos los registros de la base de datos
    public function showAll ()
    {
        $query = $this->con->query("SELECT * FROM internaciones INNER JOIN pacientes ON
        internaciones.idDePaciente = pacientes.idPaciente
          ORDER BY internaciones.fechaIngreso DESC");

        return $query;

    }

}
