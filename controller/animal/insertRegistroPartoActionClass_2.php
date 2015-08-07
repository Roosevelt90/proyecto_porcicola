<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

class insertRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $this->defineView('insert', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
