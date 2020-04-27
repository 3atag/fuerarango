<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

use Laminas\Diactoros\Response\RedirectResponse;

class UsuarioController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllUsuarioAction()
    {
        $usuarios = Usuario::where('activo', '=', 1)->get();;

        return $this->renderHTML('paciente/pacientes.twig', [
            'pacientes' => $pacientes,
            'base_url' => $this->base_url
        ]);
    }

    /***** Mostrar formulario agregar registro *****/
    public function getAddUsuarioAction()
    {
        return $this->renderHTML('usuario/crear.twig');
    }


    /***** Guardar registro *****/
    // public function postSavePacienteAction($request)
    // {
    //     if ($request->getMethod() == 'POST') {

    //         $postData = $request->getParsedBody();

    //         $paciente = new Paciente;

    //         $paciente->nombre = $postData['nombre'];
    //         $paciente->beneficio = $postData['beneficio'];
    //         $paciente->dni = $postData['dni'];

    //         $paciente->save();

    //         header('Location:/fuerarango/pacientes');
    //     }
    // }

}
