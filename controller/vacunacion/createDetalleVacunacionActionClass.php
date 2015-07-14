<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $id_registro = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true));
                $id_vacuna = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true));
                $fecha_vacunacion = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true));
                $dosis_vacuna = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true));
                $accion = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true));

            //    detalleVacunacionTableClass::validate($fecha_vacunacion, $id_vacuna, $dosis_vacuna, $accion);
       
                $data = array(
                    detalleVacunacionTableClass::ID_REGISTRO => $id_registro,
                    detalleVacunacionTableClass::VACUNA => $id_vacuna,
                    detalleVacunacionTableClass::FECHA => $fecha_vacunacion,
                    detalleVacunacionTableClass::DOSIS => $dosis_vacuna,
                    detalleVacunacionTableClass::ACCION => $accion
                );
//                print_r($data);
                detalleVacunacionTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate'));
                log::register(i18n::__('create'), detalleVacunacionTableClass::getNameTable());
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }
             else {
                session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
