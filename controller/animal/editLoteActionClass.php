<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(loteTableClass::ID)) {
                $fields = array(
                    loteTableClass::ID,
                    loteTableClass::NOMBRE
                );
                $where = array(
                    loteTableClass::ID => request::getInstance()->getRequest(loteTableClass::ID)
                );
                $this->objLote = loteTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'lote', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('lote', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
