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

    /***** Mostrar formulario login *****/
    public function getLogin()
    {
        return $this->renderHTML('login.twig');
    }


    /***** Validar acceso *****/
    public function postLoginAction($request)
    {
        $responseMessage  = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $usuario = Usuario::where('email', $postData['email'])->first();
            // Busco el primer resultado de email correspondiente en la base


            if ($usuario) {
                // Si existe un usuario con el mail ingresado

                if (password_verify($postData['clave'], $usuario->clave)) {
                    // Si la clave ingresada es correcta

                    $_SESSION['userId'] = $usuario->id;
                    $_SESSION['userName'] = $usuario->nombre;

                    return new RedirectResponse('/fuerarango/internaciones');

                } else {
                    // Si la clave ingresada es incorrecta    
                    $responseMessage  = 'Credencial incorrecta, verifique datos de acceso';
                }
            } else {
                // Si el mail no fue encontrado en la base    
                $responseMessage  = 'Credencial incorrecta, verifique datos de acceso';

            }

            return $this->renderHTML('login.twig', [
                'responseMessage' => $responseMessage
            ]);


        }
    }


    /***** Cerrar session *****/
    public function getLogout()
    {
        session_unset ();

        return new RedirectResponse('/fuerarango');
    }
}
