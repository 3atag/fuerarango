<?php

namespace App\Models;

use Database;

require_once '../config/Database.php';

class BaseElement
{

    protected $con;

    // Ejecuto la conexion a la base
    public function __construct()
    {
        $this->con = Database::connect();
    }

    // Extrae todos los registros de la base de datos
    public function conseguirTodos($tabla)
    {
        $query = $this->con->query("SELECT * FROM $tabla ORDER BY idInternacion DESC");

        return $query;

    }
}
