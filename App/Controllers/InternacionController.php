<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\{Internacion, Paciente};

use Respect\Validation\Validator as v;

use Laminas\Diactoros\Response\RedirectResponse;

class InternacionController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllInternacionAction()
    {

        $internaciones = Internacion::select('pacientes.beneficio', 'pacientes.nombre', 'internaciones.id', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
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
        $pacientes = Paciente::all();

        $responseMessage  = null;

        if ($request->getMethod() == 'POST') {


            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            try {

                $internacionValidator->assert($postData);

                if ($postData['fechaEgr'] > $postData['fechaIng']) {

                    /* Evaluamos que no haya una internacion de el paciente entre esas fecha */
                    $yaInternado = false;

                    $fechaIngresoUsuario = strtotime($postData['fechaIng']);


                    $internacionesPaciente = Internacion::where('idDePaciente', '=', $postData['id_paciente'])->get();

                    foreach ($internacionesPaciente as $internacion) {

                        $fechaIngresoInternacion = strtotime($internacion['fechaIngreso']);
                        $fechaEgresoInternacion = strtotime($internacion['fechaEgreso']);

                        if ($fechaIngresoUsuario >= $fechaIngresoInternacion && $fechaIngresoUsuario <= $fechaEgresoInternacion) {

                            $yaInternado = true;
                        }
                    }

                    if ($yaInternado == true) {

                        $responseMessage = 'El paciente estuvo internado en la fecha de ingreso ingresada';
                        
                    } else {

                        $internacion = new Internacion;

                        $internacion->idDePaciente = $postData['id_paciente'];
                        $internacion->fechaIngreso = $postData['fechaIng'];
                        $internacion->fechaEgreso = $postData['fechaEgr'];

                        $internacion->save();

                        $responseMessage = 'Internacion guardada con exito';
                    }
                } else {
                    $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';
                }
            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

            return $this->renderHTML('internacion/crear.twig', [
                'responseMessage' => $responseMessage,
                'pacientes' => $pacientes,
                'base_url' => $this->base_url
            ]);
        }
    }

    /***** Mostrar formulario Editar registro *****/
    public function getEditInternacionAction($request)
    {

        $pacientes = Paciente::all();

        if ($request->getMethod() == 'GET') {


            $getId = $request->getQueryParams();

            $id = (int) $getId['id'];

            // $internacion = Internacion::find($id);            

            $internacion = Internacion::select('pacientes.idPaciente', 'pacientes.beneficio', 'pacientes.nombre', 'internaciones.id', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
                ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.idPaciente')
                ->where('internaciones.id', '=', $id)
                ->first();

            return $this->renderHTML('internacion/crear.twig', [

                'internacion' => $internacion,
                'pacientes' => $pacientes,
                'base_url' => $this->base_url,
                'isEdit' => true
            ]);
        } else {

            var_dump('error');
        }
    }

    /***** Guardar registro editado *****/
    public function postSaveEditInternacionAction($request)
    {

        $responseMessage  = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_internacion', v::intVal()->notEmpty())
                ->key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            try {

                $internacionValidator->assert($postData);


                if ($postData['fechaEgr'] > $postData['fechaIng']) {


                    $internacion = Internacion::find($postData['id_internacion']);

                    $internacion->idDePaciente = $postData['id_paciente'];
                    $internacion->fechaIngreso = $postData['fechaIng'];
                    $internacion->fechaEgreso = $postData['fechaEgr'];
                    $internacion->save();

                    // $responseMessage = 'Internacion actualizada con exito';

                    var_dump('exito');
                } else {

                    // $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';

                    var_dump('fracaso');
                }
            } catch (\Exception $e) {


                var_dump('hola' . $e->getMessage());

                // $responseMessage = $e->getMessage();
            }



            // return $this->renderHTML('internacion/crear.twig', [
            //     'responseMessage' => $responseMessage,              
            //     'base_url' => $this->base_url
            // ]);
        }
    }
}
