<?php


use App\Models\Internacion;

class InternacionController {

    public function crearInternacion () {

        require '../views/internacion/crear.php';

    }

    public function editarInternacion () {

    }

    public function desactivarInternacion () {

    }

    public function mostrarTodosInternacion () {

        // Instancio el modelo y ejecuto el metodo correspondiente
        $Internacion = new Internacion();

        $listado = $Internacion->conseguirTodos();

        // Envio a la vistas
        require '../views/internacion/mostrarTodos.php';
        
    }

}