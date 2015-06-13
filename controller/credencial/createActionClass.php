<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            if (request::getInstance()->isMethod('POST')) {
                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
//                $fields = array(
//                    credencialTableClass::NOMBRE
//                );
//                $objCreden = credencialTableClass::getAll($fields);

                $data = array(
                    credencialTableClass::NOMBRE => $nombre
                );

                credencialTableClass::insert($data);


                credencialTableClass::validatCreate($nombre);
            }//close if
            routing::getInstance()->redirect('credencial', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
