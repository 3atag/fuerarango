<?php

namespace App\Controllers;

use App\Models\Paciente;

class UsuarioController {

    public function crearUsuario () {

        require '../views/usuarios/crear.php';

    }

    public function editarUsuario () {

    }

    public function desactivarUsuario () {

    }

    public function mostrarTodosUsuarios () {

        // Recibo datos del modelo
        require '../App/Models/Pacientes.php';

        // Instancio el modelo y ejecuto el metodo correspondiente
        $paciente = new Paciente();

        $listado = $paciente->conseguirTodos();

        // Envio a la vistas
        require '../views/usuarios/mostrarTodos.php';
        
    }

}