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
            ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.id')
            ->get();


        return $this->renderHTML('internacion/internaciones.twig', [
            'internaciones' => $internaciones,
            'userName' => $_SESSION['userName']
        ]);
    }


    /***** Mostrar formulario agregar registro *****/
    public function getAddInternacionAction()
    {
        $pacientes = Paciente::all();

        return $this->renderHTML('internacion/crear.twig', [
            'pacientes' => $pacientes
        ]);
    }


    /***** Guardar registro *****/
    public function postSaveInternacionAction($request)
    {
        $pacientes = Paciente::all();

        $responseMessage  = null;

        $hoy = date_create();
        $fechaActual = date_timestamp_get($hoy);


        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            $camposIngresados = null;

            try {

                $internacionValidator->assert($postData);

                if (
                    strtotime($postData['fechaIng']) > $fechaActual ||
                    strtotime($postData['fechaEgr']) > $fechaActual
                ) {

                    $responseMessage = 'La fechas de ingreso y egreso no puede ser mayores a la fecha actual';

                    $camposIngresados = array(
                        'id_paciente' => $postData['id_paciente'],
                        'nom_paciente' => $postData['nom_paciente'],
                        'fechaIng' => $postData['fechaIng'],
                        'fechaEgr' => $postData['fechaEgr']
                    );
                } elseif ($postData['fechaEgr'] < $postData['fechaIng']) {
                    // Si FECHA EGRESO es MENOR a la FECHA INGRESO
                    $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';

                    $camposIngresados = array(
                        'id_paciente' => $postData['id_paciente'],
                        'nom_paciente' => $postData['nom_paciente'],
                        'fechaIng' => $postData['fechaIng'],
                        'fechaEgr' => $postData['fechaEgr']
                    );
                } else {

                    /* Evaluamos que no haya una internacion del paciente entre las fechas ingresadas */
                    $yaInternado = null;

                    $fechaIngresoUsuario = strtotime($postData['fechaIng']);
                    $fechaEgresoUsuario = strtotime($postData['fechaEgr']);

                    $internacionesPaciente = Internacion::where('idDePaciente', '=', $postData['id_paciente'])->get();

                    foreach ($internacionesPaciente as $internacion) {

                        $fechaIngresoInternacion = strtotime($internacion['fechaIngreso']);
                        $fechaEgresoInternacion = strtotime($internacion['fechaEgreso']);

                        if (($fechaIngresoUsuario < $fechaIngresoInternacion &&
                                $fechaEgresoUsuario < $fechaIngresoInternacion) ||
                            ($fechaIngresoUsuario > $fechaEgresoInternacion &&
                                $fechaEgresoUsuario > $fechaEgresoInternacion)
                        ) {

                            // Si las fechas ingresadas se encuentran dentro del rango de una internacion anterior

                            $yaInternado = false;
                        } else {

                            $yaInternado = true;

                            break;
                        }
                    } // fin del foreach

                    if ($yaInternado == true) {

                        $responseMessage = 'El paciente estuvo internado en la fecha de ingreso ingresada';

                        $camposIngresados = array(
                            'id_paciente' => $postData['id_paciente'],
                            'nom_paciente' => $postData['nom_paciente'],
                            'fechaIng' => $postData['fechaIng'],
                            'fechaEgr' => $postData['fechaEgr']
                        );
                    } else {

                        $internacion = new Internacion;

                        $internacion->idDePaciente = $postData['id_paciente'];
                        $internacion->fechaIngreso = $postData['fechaIng'];
                        $internacion->fechaEgreso = $postData['fechaEgr'];

                        $internacion->save();

                        $responseMessage = 'Internacion guardada con exito';

                        return new RedirectResponse('/fuerarango');
                    }
                }
            } catch (\Exception $e) {

                $responseMessage = "Todos los campos obligatorios";

                $camposIngresados = array(
                    'id_paciente' => $postData['id_paciente'],
                    'nom_paciente' => $postData['nom_paciente'],
                    'fechaIng' => $postData['fechaIng'],
                    'fechaEgr' => $postData['fechaEgr']
                );
            }

            return $this->renderHTML('internacion/crear.twig', [
                'responseMessage' => $responseMessage,
                'pacientes' => $pacientes,
                'base_url' => $this->base_url,
                'camposIngresados' => $camposIngresados
            ]);
        }
    }

    /***** Mostrar formulario Editar registro *****/
    public function getEditInternacionAction($request)
    {

        if ($request->getMethod() == 'GET') {

            // Recibo parametros desde la url
            $id = (int) $request->getAttribute('id');

            $internacion = Internacion::select('pacientes.id', 'pacientes.beneficio', 'pacientes.nombre', 'internaciones.id', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
                ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.id')
                ->where('internaciones.id', '=', $id)
                ->first();


            if ($internacion === null) {

                return new RedirectResponse('/fuerarango');
            } else {

                return $this->renderHTML('internacion/crear.twig', [

                    'internacion' => $internacion,
                    'base_url' => $this->base_url,
                    'isEdit' => true
                ]);
            }
        } else {

            var_dump('error');
        }
    }

    /***** Guardar registro editado *****/
    public function postSaveEditInternacionAction($request)
    {

        $responseMessage  = null;

        $hoy = date_create();

        $fechaActual = date_timestamp_get($hoy);

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_internacion', v::intVal()->notEmpty())
                ->key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            $camposIngresados = null;

            try {

                $internacionValidator->assert($postData);

                if (
                    strtotime($postData['fechaIng']) > $fechaActual ||
                    strtotime($postData['fechaEgr']) > $fechaActual
                ) {
                    // Si el usuario ingresa una FECHA MAYOR a la ACTUAL en cualquiera de los dos campos

                    $responseMessage = 'La fechas de ingreso y egreso no puede ser mayores a la fecha actual';

                    $camposIngresados = array(
                        'id_internacion' => $postData['id_internacion'],
                        'id_paciente' => $postData['id_paciente'],
                        'nom_paciente' => $postData['nom_paciente'],
                        'fechaIng' => $postData['fechaIng'],
                        'fechaEgr' => $postData['fechaEgr']
                    );
                } elseif ($postData['fechaEgr'] < $postData['fechaIng']) {
                    // Si FECHA EGRESO es MENOR a la FECHA INGRESO     

                    $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';

                    $camposIngresados = array(
                        'id_internacion' => $postData['id_internacion'],
                        'id_paciente' => $postData['id_paciente'],
                        'nom_paciente' => $postData['nom_paciente'],
                        'fechaIng' => $postData['fechaIng'],
                        'fechaEgr' => $postData['fechaEgr']
                    );
                } else {
                    // si las FECHAS estan bien ingresadas

                    $yaInternado = null;
                    // Creo un flag para evaluar si el paciente estuvo internado en el periodo ingresado por el usuario

                    $fechaIngresoUsuario = strtotime($postData['fechaIng']);
                    $fechaEgresoUsuario = strtotime($postData['fechaEgr']);

                    $internacionesPaciente = Internacion::where('idDePaciente', '=', $postData['id_paciente'])->get();
                    // cargo las internaciones del paciente seleccionado

                    foreach ($internacionesPaciente as $internacion) {
                        // Recorro cada una de las internaciones del paciente

                        if ($internacion->id != (int) $postData['id_internacion']) {
                            // Si la internacion es DISTINTA a la que se va a editar

                            $fechaIngresoInternacion = strtotime($internacion['fechaIngreso']);
                            $fechaEgresoInternacion = strtotime($internacion['fechaEgreso']);

                            if (($fechaIngresoUsuario < $fechaIngresoInternacion &&
                                    $fechaEgresoUsuario < $fechaIngresoInternacion) ||
                                ($fechaIngresoUsuario > $fechaEgresoInternacion &&
                                    $fechaEgresoUsuario > $fechaEgresoInternacion)
                            ) {
                                // Si las fechas ingresadas NO SE ENCUENTRAN encuentran dentro del rango de una internacion anterior
                                $yaInternado = false;
                            } else {

                                $yaInternado = true;

                                break;
                            }
                        }
                    } // Fin del foreach


                    if ($yaInternado === true) {
                        // Si el paciente ya estuvo internado

                        $responseMessage = 'El paciente estuvo internado en la fecha de ingreso ingresada';

                        $camposIngresados = array(
                            'id_internacion' => $postData['id_internacion'],
                            'id_paciente' => $postData['id_paciente'],
                            'nom_paciente' => $postData['nom_paciente'],
                            'fechaIng' => $postData['fechaIng'],
                            'fechaEgr' => $postData['fechaEgr']
                        );
                    } else {
                        // Si el paciente no estuvo internado en el periodo ingresado

                        $internacion->fechaIngreso = $postData['fechaIng'];
                        $internacion->fechaEgreso = $postData['fechaEgr'];

                        $internacion->save();

                        $responseMessage = 'Internacion Editada con exito';

                        return new RedirectResponse('/fuerarango');
                    }
                }
            } catch (\Exception $e) {

                $responseMessage = "Todos los campos obligatorios";

                $camposIngresados = array(
                    'id_internacion' => $postData['id_internacion'],
                    'id_paciente' => $postData['id_paciente'],
                    'nom_paciente' => $postData['nom_paciente'],
                    'fechaIng' => $postData['fechaIng'],
                    'fechaEgr' => $postData['fechaEgr']
                );
            }

            return $this->renderHTML('internacion/crear.twig', [
                'responseMessage' => $responseMessage,
                'base_url' => $this->base_url,
                'isEdit' => true,
                'camposIngresados' => $camposIngresados

            ]);
        }
    }
}
