<?php

namespace App\Controllers;

use App\Models\Paciente;

class PacienteController {

    public function add () {

        require '../views/paciente/crear.php';

    }

    public function save () {

        if (isset($_POST)) {
            var_dump($_POST);
        }

      
    }

    public function edit () {

    }

    public function off () {

    }

    public function viewAll () {

        // Instancio el modelo y ejecuto el metodo correspondiente
        $paciente = new Paciente();

        $listado = $paciente->showAll();       

        // Envio a la vistas
        
        require '../views/internacion/crear.php';
        
    }

}