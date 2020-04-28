<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController
{

    /***** Mostrar todos los registros *****/
    // public function getAllUsuarioAction()
    // {
    //     $usuarios = Usuario::where('activo', '=', 1)->get();;

    //     return $this->renderHTML('paciente/pacientes.twig', [
    //         'pacientes' => $pacientes,
    //         'base_url' => $this->base_url
    //     ]);
    // }

    /***** Mostrar formulario agregar registro *****/
    public function getLogin()
    {
        return $this->renderHTML('login.twig');
    }


    /***** Guardar registro *****/
    public function postLoginAction($request)
    {
        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();
            // Busco el primer resultado de email correspondiente en la base
            $usuario = Usuario::where('email',$postData['email'])->first();

            // Si existe ese primer resultado
            if($usuario) {

                // Si el usuario existe
                if(password_verify($postData['clave'], $usuario->clave)) {

                    var_dump('Correcto');

                } else {
                    var_dump('Incorrecto');
                }

            } else {

                var_dump(' NO encontrado');

            }
        }
    }

}
