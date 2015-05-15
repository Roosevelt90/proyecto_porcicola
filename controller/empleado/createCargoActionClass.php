<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

class createCargoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $descripcion = request::getInstance()->getPost(cargoBaseTableClass::getNameField(cargoBaseTableClass::DESCRIPCION, true));
                $data = array(
                cargoBaseTableClass::DESCRIPCION => $descripcion
                );
                cargoBaseTableClass::insert($data);
            }
            routing::getInstance()->redirect('empleado', 'indexCargo');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
