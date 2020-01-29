<?php

namespace App\Models;

class Internacion extends BaseElement

{

    private $id;
    private $idDePaciente;
    private $fechaIngreso;
    private $fechaEgreso;
    private $activo;


  
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
      public function conseguirTodos()
      {
  
          return 'sacando todos los paciente';
      }
}
