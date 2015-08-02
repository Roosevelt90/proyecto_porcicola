<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(credencialTableClass::ID)) {
                $fields = array(
                    credencialTableClass::ID,
                    credencialTableClass::NOMBRE
                );
                $where = array(
                    credencialTableClass::ID => request::getInstance()->getRequest(credencialTableClass::ID)
                );
                $this->objCredencial = credencialTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'credencial', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('usuario', 'indexCredencial');
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
