<?php


use App\Models\Paciente;

class PacienteController {

    public function register () {

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

    public function mostrarTodosPacientes () {

        // Instancio el modelo y ejecuto el metodo correspondiente
        $paciente = new Paciente();

        $listado = $paciente->conseguirTodos();

        // Envio a la vistas
        require '../views/paciente/mostrarTodos.php';
        
    }

}