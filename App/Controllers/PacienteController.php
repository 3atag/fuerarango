<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Paciente;

class PacienteController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllPacienteAction()
    {
        $pacientes = Paciente::all();

        return $this->renderHTML('paciente/pacientes.twig', [
            'pacientes' => $pacientes,
            'base_url' => $this->base_url
        ]);
    }

    /***** Mostrar formulario agregar registro *****/
    public function getAddPacienteAction()
    {
        return $this->renderHTML('paciente/crear.twig',[            
            'base_url' => $this->base_url
        ]);
    }


    /***** Guardar registro *****/
    public function postSavePacienteAction($request)
    {
        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $paciente = new Paciente;

            $paciente->nombre = $postData['nombre'];
            $paciente->beneficio = $postData['beneficio'];
            $paciente->dni = $postData['dni'];            

            $paciente->save();

            header('Location:/fuerarango/pacientes');
        }
    }


}
