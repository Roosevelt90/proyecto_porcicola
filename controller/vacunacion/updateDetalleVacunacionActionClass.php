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
class updateDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true));
                $id_registro = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true));
                $id_vacuna = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true));
                $fecha_vacunacion = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true));
                $dosis_vacuna = request::getInstance()->getPost(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true));
                $PATH_INFO = request::getInstance()->getPost('PATH_INFO');

                $ids = array(
                    detalleVacunacionTableClass::ID => $id
                );

//             detalleVacunacionTableClass::validateUpdate($fecha_vacunacion, $id_vacuna, $dosis_vacuna, $accion, $nombre, $id_detalle, $id_registro);
                $data = array(
                    detalleVacunacionTableClass::VACUNA => $id_vacuna,
                    detalleVacunacionTableClass::FECHA => $fecha_vacunacion,
                    detalleVacunacionTableClass::DOSIS => $dosis_vacuna
                );

                detalleVacunacionTableClass::update($ids, $data);
//                session::getInstance()->setSuccess(i18n::__('succesUpdate',null,'detalleVacunacion'));
                log::register(i18n::__('update'), detalleVacunacionTableClass::getNameTable());      
//                routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion', array('id' => $id_registro));
            }//close if

            $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO . '?' . 'id' . '=' . $id_registro;
            header('location: ' . $dir);
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
