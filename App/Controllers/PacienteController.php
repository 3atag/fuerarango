<?php

namespace App\Controllers;

use App\Models\Paciente;

class PacienteController {

    public function add () {

        require '../views/paciente/crear.php';

    }

    public function save () {

        if (isset($_POST)) {

            $paciente = new Paciente;

            $paciente->setNombre($_POST['nombre']);
            $paciente->setBeneficio($_POST['beneficio']);
            $paciente->setDni($_POST['dni']);


            if ($paciente->save()) {
                header('Location:../');

            } else {
                var_dump('Ha ocurrido un error al intentar guardar el registro');
            }
        }

      
    }

    public function edit () {

    }

    public function off () {

    }

    public function viewAll () {

        // Instancio el modelo y ejecuto el metodo correspondiente
        $paciente = new Paciente();

        $pacientes = $paciente->showAll();       

        // Envio a la vistas
        
        require '../views/paciente/mostrarTodos.php';
        
    }
 

}