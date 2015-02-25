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
class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));

                $ids = array(
                    loteTableClass::ID => $id
                );
                loteTableClass::delete($ids, false);
            }
            routing::getInstance()->redirect('lote', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
