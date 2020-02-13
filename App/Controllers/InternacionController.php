<?php

namespace App\Controllers;

use App\Models\{Internacion, Paciente};

class InternacionController {

    public function add () {

        $paciente = new Paciente();

        $pacientes = $paciente->showAll();          

        require '../views/internacion/crear.php';
        require '../views/internacion/modalPacientes.php';

    }

    public function save () {

        if(isset ($_POST)){

            $internacion = new Internacion;            

            $internacion->setIdDePaciente($_POST['id_paciente']);
            $internacion->setFechaIngreso($_POST['fechaIng']);
            $internacion->setFechaEgreso($_POST['fechaEgr']);

            if ($internacion->save()) {
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
        $Internacion = new Internacion();

        $internaciones = $Internacion->showAll();

        // Envio a la vistas
        require '../views/internacion/mostrarTodos.php';
        
    }
    



}