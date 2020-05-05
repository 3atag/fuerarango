<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Paciente;

use Laminas\Diactoros\Response\RedirectResponse;

class PacienteController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllPacienteAction()
    {
        $pacientes = Paciente::where('activo', '=', 1)->get();


        return $this->renderHTML('paciente/pacientes.twig', [
            'pacientes' => $pacientes
        ]);
    }

    /***** Mostrar formulario agregar registro *****/
    public function getAddPacienteAction()
    {
        return $this->renderHTML('paciente/crear.twig');
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
            $paciente->padron = 0;

            $paciente->save();

            header('Location:/pacientes');
        }
    }


    /***** Mostrar formulario Importar padron *****/
    public function getImportPadronAction()
    {
        return $this->renderHTML('paciente/padron.twig', [
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

                $ruta = "uploads/$fileName";

                $padron->moveTo($ruta);

                $registros = file($ruta);

                $cantRegistros = count($registros) - 1;
           
                
                
                /**** ALTAS ****/
                $contadorAltas = 0;
                $contadorBajas = 0;

                for ($i = 0; $i < $cantRegistros; $i++) {

                    $beneficioPadron = (int) substr($registros[$i], 4, 14);
                    $documentoPadron = (int) substr($registros[$i], 21, 8);
                    $nombrePadron = rtrim(substr($registros[$i], 31, 40));

                    $documentos[] = $documentoPadron;

                    $afiliadoExistente = Paciente::where('dni', '=', $documentoPadron)->count();

                    if ($afiliadoExistente == 0) {

                        $paciente = new Paciente;

                        $paciente->nombre = $nombrePadron;
                        $paciente->beneficio = $beneficioPadron;
                        $paciente->dni = $documentoPadron;
                        $paciente->padron = 1;

                        $paciente->save();
                        
                        $contadorAltas++;

                    } 

                }

                /**** BAJAS ****/
                $pacientes = Paciente::all();

                foreach ($pacientes as $paciente) {

                    if (!in_array($paciente['dni'], $documentos) && $paciente['activo']!=0) {                      
                                             
                        $paciente->activo = 0;

                        $paciente->save();

                        $contadorBajas++;    

                    } 
                }
                
                $responseMessage = 'Se realizaron '.$contadorAltas.' Ingreos y '.$contadorBajas.'Bajas en la Padron de afiliados';

                return $this->renderHTML('paciente/padron.twig', [
                    'responseMessage' => $responseMessage

                ]);

                // return new RedirectResponse('/pacientes');               

            }
        }
    }
}
