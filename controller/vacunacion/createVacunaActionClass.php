<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

class createVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true));
                $lote = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true));
                $fecha_fabricacion = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true));
                $fecha_vencimiento = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true));
                $valor = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true));
                $cantidad = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true));
                $stock = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true));
                
                vacunaTableClass::validate($nombre, $lote, $fecha_fabricacion, $fecha_vencimiento, $valor);
                
                $data = array(
                    vacunaTableClass::NOMBRE_VACUNA => $nombre,
                    vacunaTableClass::FECHA_FABRICACION => $fecha_fabricacion,
                    vacunaTableClass::FECHA_VENCIMIENTO => $fecha_vencimiento,
                    vacunaTableClass::LOTE_VACUNA => $lote,
                    vacunaTableClass::VALOR => $valor,
                    vacunaTableClass::CANTIDAD => $cantidad,
                    vacunaTableClass::STOCK_MINIMO => $stock
                );

                vacunaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate'));
                log::register(i18n::__('create'), vacunaTableClass::getNameTable());
                routing::getInstance()->redirect('vacunacion', 'indexVacuna');
            } else {
                log::register(i18n::__('create'), razaTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('vacunacion', 'indexVacuna');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
