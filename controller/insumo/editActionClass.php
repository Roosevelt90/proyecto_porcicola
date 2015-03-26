<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(insumoTableClass::ID)) {
                $fields = array(
                    insumoTableClass::ID,
                    insumoTableClass::NOMBRE
                );
                $where = array(
                    insumoTableClass::ID => request::getInstance()->getRequest(insumoTableClass::ID)
                );
                $this->objInsumo = insumoTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'insumo', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('insumo', 'index');
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
