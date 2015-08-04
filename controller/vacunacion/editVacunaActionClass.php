<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(vacunaTableClass::ID)) {
                $fields = array(
                vacunaTableClass::ID,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::VALOR,
                vacunaTableClass::CANTIDAD,
                vacunaTableClass::STOCK_MINIMO
                );
                $where = array(
                    vacunaTableClass::ID => request::getInstance()->getGet(vacunaTableClass::ID)
                );
                $this->objVacuna = vacunaTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'vacuna', session::getInstance()->getFormatOutput());
            } else {
                   $fields = array(
                vacunaTableClass::ID,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::VALOR,
                vacunaTableClass::CANTIDAD,
                vacunaTableClass::STOCK_MINIMO
                );
                $where = array(
                    vacunaTableClass::ID => request::getInstance()->getGet($id)
                );
                $this->objVacuna = vacunaTableClass::getAll($fields, false, null, null, null, null, $where);
            
                $this->defineView('edit', 'vacuna', session::getInstance()->getFormatOutput());
//                routing::getInstance()->redirect('vacunacion', 'editVacuna');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
