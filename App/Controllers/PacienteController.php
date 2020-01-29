<?php


use App\Models\Paciente;

class PacienteController {

    public function crearPaciente () {

        require '../views/paciente/crear.php';

    }

    public function editarPaciente () {

    }

    public function desactivarPaciente () {

    }

    public function mostrarTodosPacientes () {

        // Instancio el modelo y ejecuto el metodo correspondiente
        $paciente = new Paciente();

        $listado = $paciente->conseguirTodos();

        // Envio a la vistas
        require '../views/paciente/mostrarTodos.php';
        
    }

}