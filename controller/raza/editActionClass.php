<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(razaTableClass::ID)) {
                $fields = array(
                    razaTableClass::ID,
                    razaTableClass::NOMBRE_RAZA
                );
                $where = array(
                    razaTableClass::ID => request::getInstance()->getRequest(razaTableClass::ID)
                );
                $this->objRaza = razaTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'raza', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('raza', 'index');
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
