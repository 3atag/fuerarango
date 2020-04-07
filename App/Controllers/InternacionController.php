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

            $camposIngresados = null;

            try {

                $internacionValidator->assert($postData);

                if ($postData['fechaEgr'] > $postData['fechaIng']) {

                    /* Evaluamos que no haya una internacion del paciente entre las fechas ingresadas */
                    
                    $yaInternado = false;                    

                    $fechaIngresoUsuario = strtotime($postData['fechaIng']);

                    $internacionesPaciente = Internacion::where('idDePaciente', '=', $postData['id_paciente'])->get();

                    foreach ($internacionesPaciente as $internacion) {

                        $fechaIngresoInternacion = strtotime($internacion['fechaIngreso']);
                        $fechaEgresoInternacion = strtotime($internacion['fechaEgreso']);

                        if ($fechaIngresoUsuario >= $fechaIngresoInternacion && $fechaIngresoUsuario <= $fechaEgresoInternacion) {

                            $yaInternado = true;

                            $camposIngresados = array ('id_paciente' => $postData['id_paciente'],
                                                       'nom_paciente' => $postData['nom_paciente'],
                                                       'fechaIng' => $postData['fechaIng'],
                                                       'fechaEgr' => $postData['fechaEgr']);

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

            $internacion = Internacion::select('pacientes.idPaciente', 'pacientes.beneficio', 'pacientes.nombre', 'internaciones.id', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
                ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.idPaciente')
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

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacionValidator = v::key('id_internacion', v::intVal()->notEmpty())
                ->key('id_paciente', v::intVal()->notEmpty())
                ->key('fechaIng', v::date())
                ->key('fechaEgr', v::date());

            $camposIngresados = null;

            try {

                $internacionValidator->assert($postData);

                if ($postData['fechaEgr'] > $postData['fechaIng']) {

                     /* Evaluamos que no haya una internacion del paciente entre las fechas ingresadas */
                    
                     $yaInternado = false;                    

                     $fechaIngresoUsuario = strtotime($postData['fechaIng']);
 
                     $internacionesPaciente = Internacion::where('idDePaciente', '=', $postData['id_paciente'])->get();

                     
                     foreach ($internacionesPaciente as $internacion) {                        

                        if ($internacion->id != (int) $postData['id_internacion']) {
                            // Si la internacion guardada en la base es distinta a la que se va a editar

                            $fechaIngresoInternacion = strtotime($internacion['fechaIngreso']);
                            $fechaEgresoInternacion = strtotime($internacion['fechaEgreso']);
    
                            if ($fechaIngresoUsuario >= $fechaIngresoInternacion && $fechaIngresoUsuario <= $fechaEgresoInternacion) {
    
                                $yaInternado = true;
    
                                $camposIngresados = array ('id_paciente' => $postData['id_paciente'],
                                                           'nom_paciente' => $postData['nom_paciente'],
                                                           'fechaIng' => $postData['fechaIng'],
                                                           'fechaEgr' => $postData['fechaEgr']);    
                            }    
    
                         } 
                        
                         if ($yaInternado == true) {

                            $responseMessage = 'El paciente estuvo internado en la fecha de ingreso ingresada';
                            
                        } else {
    
                            $internacion = Internacion::find($postData['id_internacion']);
    
                            $internacion->idDePaciente = $postData['id_paciente']; // no va
                            $internacion->fechaIngreso = $postData['fechaIng'];
                            $internacion->fechaEgreso = $postData['fechaEgr'];
                            $internacion->save();
        
                            return new RedirectResponse('/fuerarango');                       
    
                        }    
                        
                     }

                                  


                } else {

                    $responseMessage = 'La fecha de ingreso no puede ser menor a la fecha de egreso';
                    
                }

            } catch (\Exception $e) {
              
                $responseMessage = $e->getMessage();

            }

            return $this->renderHTML('internacion/crear.twig', [
                'responseMessage' => $responseMessage,                     
                'base_url' => $this->base_url,
                'camposIngresados' => $camposIngresados

            ]);
        }
    }
}
