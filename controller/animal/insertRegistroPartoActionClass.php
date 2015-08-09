<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

class insertRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );

            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );

            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
            $this->defineView('insert', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
