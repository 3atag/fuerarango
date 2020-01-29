<?php

namespace App\Models;


class Paciente extends BaseElement
{

    private $id;
    private $nombre;
    private $beneficio;
    private $dni;
    private $activo;



    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
   
}