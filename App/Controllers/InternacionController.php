<?php

namespace App\Controllers;

use App\Models\Internacion;

class InternacionController {

    public function add () {

        require '../views/internacion/crear.php';

    }

    public function save () {

        if(isset ($_POST)){

            $internacion = new Internacion;

            $internacion->setIdDePaciente($_POST['paciente']);
            $internacion->setFechaIngreso($_POST['fechaIng']);
            $internacion->setFechaEgreso($_POST['fechaEgr']);

            if ($internacion->save()) {
                header('Location:../');

            } else {
                var_dump($internacion->db->error);
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