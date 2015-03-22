<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class updateLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
                $nombre = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NOMBRE, true));

                $ids = array(
                    loteTableClass::ID => $id
                );

                $data = array(
                    loteTableClass::NOMBRE => $nombre
                );

                loteTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('animal', 'indexLote');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
