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

    
    /***** Mostrar formulario Importar padron *****/
    public function getImportPadronAction()
    {
        return $this->renderHTML('paciente/padron.twig',[            
            'base_url' => $this->base_url
        ]);
    }

    /***** Importar Padron desde archivo externo *****/
    public function postProcesarPadronAction($request)
    {
        if ($request->getMethod() == 'POST') {

            $file = $request->getUploadedFiles();

            $padron = $file['padron'];



            if ($padron->getError() == UPLOAD_ERR_OK) {

                $fileName = $padron->getClientFilename();
            
                var_dump($file);

            } 

            
        }
    }



}
