<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\{Internacion, Paciente};

class InternacionController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getAllInternacionAction()
    {
        $internaciones = Internacion::select('pacientes.beneficio', 'pacientes.nombre', 'internaciones.fechaIngreso', 'internaciones.fechaEgreso')
            ->join('pacientes', 'internaciones.idDePaciente', '=', 'pacientes.idPaciente')
            ->get();


        return $this->renderHTML('internacion/internaciones.twig', [
            'internaciones' => $internaciones
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
        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $internacion = new Internacion;

            $internacion->idDePaciente = $postData['id_paciente'];
            $internacion->fechaIngreso = $postData['fechaIng'];
            $internacion->fechaEgreso = $postData['fechaEgr'];

            $internacion->save();

            header('Location:/fuerarango');
        }
    }
}
