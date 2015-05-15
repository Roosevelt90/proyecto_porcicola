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

                $id = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::ID, true));
                $numero_documento = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::NUMERO_DOCUMENTO, true));
                $usuario_id = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::USUARIO_ID, true));
                $peso_animal = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::PESO_ANIMAL, true));
                $precio_animal = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::PRECIO_ANIMAL, true));
                $animal_id = request::getInstance()->getPost(dpVentaTableClass::getNameField(dpVentaTableClass::ANIMAL_ID, true));                
                $ids = array(
                    dpVentaTableClass::ID => $id
                );

                $data = array(
                    dpVentaTableClass::ID => $id,
                    dpVentaTableClass::NUMERO_DOCUMENTO => $numero_documento,
                    dpVentaTableClass::USUARIO_ID => $usuario_id,
                    dpVentaTableClass::PESO_ANIMAL=>$peso_animal,
                    dpVentaTableClass::PRECIO_ANIMAL=>$precio_animal,
                    dpVentaTableClass::ANIMAL_ID=>$animal_id                                             
                );

                dpVentaTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('dpVenta', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
