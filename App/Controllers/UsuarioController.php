<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

use Respect\Validation\Validator as v;

use Laminas\Diactoros\Response\RedirectResponse;

class UsuarioController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllUsuarioAction()
    {
        $usuarios = Usuario::where('activo', '=', 1)->get();;

        return $this->renderHTML('usuario/usuarios.twig', [
            'usuarios' => $usuarios
        ]);
    }

    /***** Mostrar formulario agregar registro *****/
    public function getAddUsuarioAction()
    {
        return $this->renderHTML('usuario/crear.twig');
    }


    /***** Guardar registro *****/
    public function postSaveUsuarioAction($request)
    {

        $responseMessage  = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $usuarioValidator = v::key('nombre', v::stringType()->notEmpty())
                ->key('email', v::email()->notEmpty())
                ->key('clave', v::stringType()->notEmpty());

            try {
                $usuarioValidator->assert($postData);

                $usuario = new Usuario;

                $usuario->nombre = $postData['nombre'];
                $usuario->email = $postData['email'];
                $usuario->clave = $postData['clave'];
                $usuario->tipo = $postData['tipo'];

                $usuario->save(); 
                
                $responseMessage  = 'Usuario creado con éxito';

            } catch (\Exception $e) {

                $responseMessage  = $e->getMessage();
            }
            
            return $this->renderHTML('usuario/crear.twig', [
                'responseMessage' => $responseMessage
            ]);
            
        }
    }
}
