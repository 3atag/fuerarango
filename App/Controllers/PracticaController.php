<?php

namespace App\Controllers;

use App\Models\Practica;

class PracticaController
{

    /***** Mostrar registros *****/
    public function viewAll()
    {

        $practica = new Practica();

        $practicas = $practica->viewAll();

        require '../views/practica/practicas.php';
    }


    public function add()
    {

        require '../views/practica/crear.php';
    }

    public function save()
    {

        if (isset($_POST)) {

            $practica = new Practica;

            $practica->setId($_POST['idPractica']);

            $practica->setCodigo($_POST['codigo']);
            $practica->setDescripcion($_POST['descripcion']);
            $practica->setCantMaxDiaria($_POST['cantMaxDiaria']);
            $practica->setCantMaxMen($_POST['cantMaxMen']);
            $practica->setCantMaxAnu($_POST['cantMaxAnu']);

            if (isset($_POST["idPractica"]) && $_POST["idPractica"] !='') {

                $idPrac = $_POST["idPractica"];

                $practica->setId($idPrac);

                if ($editado = $practica->edit()) {

                    $respuesta = array(
                        'resultado' => 'correcto',
                        'mensaje' => 'La practica ha sido editada con exito'
                    );                 
                  
                    // header('Location:/fuerarango/practicas');

                } else {

                    $respuesta = array(
                        'resultado' => 'Error',
                        'mensaje' => 'Ha ocurrido un error al intentar editar la practica'
                    );

                }

                

            } else {


                if ($practica->save()) {

                    $respuesta = array(
                        'resultado' => 'correcto',
                        'mensaje' => 'La practica ha sido creada con exito'
                    );

                    // header('Location:/fuerarango/practicas');

                } else {
                    
                    $respuesta = array(
                    'resultado' => 'Error',
                    'mensaje' => 'Ha ocurrido un error al intentar crear la practica'
                );
                
                }             


            }
                             
        }

        header('Content-Type: application/json');

        echo json_encode($respuesta);
    }

    

    public function edit()
    {

        if (isset($_GET["id"])) {

            $id = $_GET["id"];

            $edit = true;

            $practica = new Practica();

            $practica->setId($id);

            $pra = $practica->viewOne();


            require_once '../views/practica/crear.php';
        } else {

            header('Location:/fuerarango/practicas');
        }
    }

    public function off()
    {

        var_dump($_GET);
    }

  

}

     