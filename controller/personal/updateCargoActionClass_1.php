<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class updateCargoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::ID, true));
                $descripcion = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true));

                $ids = array(
                    cargoTableClass::ID => $id
                );

                $data = array(
                    cargoTableClass::DESCRIPCION => $descripcion
                );

                cargoTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('personal', 'indexCargo');
   } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
