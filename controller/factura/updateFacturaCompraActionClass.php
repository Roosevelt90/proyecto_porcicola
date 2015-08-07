<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $nombre = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true));
                $lote = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true));
                $fecha_fabricacion = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true));
                $fecha_vencimiento = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true));
                $valor = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true));
                $id  = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::ID, true));
               
                vacunaTableClass::validateEdit($lote, $id);
             
//                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));
//                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true));
//
//                $ids = array(
//                    razaTableClass::ID => $id
//                );
//
//                $data = array(
//                    razaTableClass::NOMBRE_RAZA => $nombre
//                );
//
//                razaTableClass::update($ids, $data); 
          //      session::getInstance()->setSuccess(i18n::__('succesUpdate'));
          //      log::register(i18n::__('update'), razaTableClass::getNameTable());
          procesoCompraTableClass::update($ids, $data);
          session::getInstance()->setSuccess(i18n::__('succesUpdate'));
                log::register(i18n::__('update'), procesoCompraTableClass::getNameTable());
                routing::getInstance()->redirect('factura', 'indexFacturaCompra');
            } else {
//                log::register(i18n::__('update'), razaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
//                session::getInstance()->setError(i18n::__('errorUpdate'));
                log::register(i18n::__('update'), procesoCompraTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('factura', 'updateFacturaCompra');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
