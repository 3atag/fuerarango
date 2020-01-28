<?php

namespace App\Models;


class Paciente
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
    // Extrae todos los registros de la base de datos
    public function conseguirTodos()
    {

        return 'sacando todos los paciente';
    }
}
