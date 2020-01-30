<?php

namespace App\Controllers;

use App\Models\Internacion;

class InternacionController {

    public function register () {

        require '../views/internacion/crear.php';

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