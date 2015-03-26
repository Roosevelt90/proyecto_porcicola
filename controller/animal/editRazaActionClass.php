<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editRazaActionClass extends controllerClass implements controllerActionInterface {

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
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
