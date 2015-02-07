<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID, true));
                $nombre = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOMBRE, true));
                $idDepto = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID_DEPTO, true));
                $ids = array(
                    ciudadTableClass::ID => $id
                );

                $data = array(
                    ciudadTableClass::NOMBRE => $nombre,
                    ciudadTableClass::ID_DEPTO => $idDepto
                );

                ciudadTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('ciudad', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
