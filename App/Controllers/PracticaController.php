<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Practica;

class PracticaController extends BaseController
{
    /***** Mostrar todos los registros *****/
    public function getAllPracticaAction()
    {
        $practicas = Practica::all();

        return $this->renderHTML('practica/practicas.twig', [
            'practicas' => $practicas
        ]);
    }

    /***** Mostrar formulario agregar registro *****/
    public function getAddPracticaAction()
    {
        require '../views/practica/crear.php';
    }

    /***** Guardar registro *****/
    public function postSavePracticaAction($request)
    {
        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $practica = new Practica;

            $practica->codigo = $postData['codigo'];
            $practica->descripcion = $postData['descripcion'];
            $practica->cantMaxDiaria = $postData['cantMaxDiaria'];
            $practica->cantMaxMen = $postData['cantMaxMen'];
            $practica->cantMaxAnu = $postData['cantMaxAnu'];

            $practica->save();

            header('Location:/fuerarango/practicas');
        }
    }
}
