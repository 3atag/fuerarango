<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\{Internacion, Paciente};

use Respect\Validation\Validator as v;

class InternacionController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllInternacionAction()
    {

        $internaciones = Internacion::select('pacientes.beneficio', 'pacientes.nombre', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
            ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.idPaciente')
            ->get();


        return $this->renderHTML('internacion/internaciones.twig', [
            'internaciones' => $internaciones,
            'base_url' => $this->base_url

        ]);
    }


    /***** Mostrar formulario agregar registro *****/
    public function getAddInternacionAction()
    {
        $pacientes = Paciente::all();

        return $this->renderHTML('internacion/crear.twig', [
            'pacientes' => $pacientes,
            'base_url' => $this->base_url
        ]);
    }


    /***** Guardar registro *****/
    public function postSaveInternacionAction($request)
    {

        $responseMessage  = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            try {

                $internacionValidator->assert($postData);

                if ($postData['fechaEgr'] > $postData['fechaIng']) {

                    $internacion = new Internacion;

                    $internacion->idDePaciente = $postData['id_paciente'];
                    $internacion->fechaIngreso = $postData['fechaIng'];
                    $internacion->fechaEgreso = $postData['fechaEgr'];

                    $internacion->save();

                    $responseMessage = 'Internacion guardada con exito';
                } else {
                    $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';
                }

            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

            return $this->renderHTML('internacion/crear.twig', [
                'responseMessage' => $responseMessage
            ]);
        }
    }
}
