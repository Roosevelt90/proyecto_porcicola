<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));
                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true));

                $ids = array(
                    razaTableClass::ID => $id
                );

                $data = array(
                    razaTableClass::NOMBRE_RAZA => $nombre
                );

                razaTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('raza', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
