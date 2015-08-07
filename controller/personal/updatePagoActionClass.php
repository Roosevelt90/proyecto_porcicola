<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
                $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));

                $ids = array(
                    insumoTableClass::ID => $id
                );

                $data = array(
                    insumoTableClass::NOMBRE => $nombre
                );

                insumoTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('insumo', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
