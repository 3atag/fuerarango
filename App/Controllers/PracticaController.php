<?php

namespace App\Controllers;

use App\Models\Practica;

class PracticaController {

    /***** Mostrar registros *****/    
    public function viewAll () {
      
        $practica = new Practica();

        $practicas = $practica->viewAll();      
        
        require '../views/practica/practicas.php';
        
    }
 

    public function add () {

        require '../views/practica/crear.php';

    }

    public function save () {

        if (isset($_POST)) {

            $paciente = new Practica;

            $paciente->setCodigo($_POST['codigo']);
            $paciente->setDescripcion($_POST['descripcion']);
            $paciente->setCantMaxDiaria($_POST['cantMaxDiaria']);
            $paciente->setCantMaxMen($_POST['cantMaxMen']);
            $paciente->setCantMaxAnu($_POST['cantMaxAnu']);


            if ($paciente->save()) {
                header('Location:/fuerarango/practicas');

            } else {
                var_dump('Ha ocurrido un error al intentar guardar el registro');
            }
        }

      
    }

    // public function edit () {

    // }

    // public function off () {

    // }

   

}