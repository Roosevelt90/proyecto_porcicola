<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Roosevelt Diaz Tapias <rdiaz02@misena.edu.co>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
                recuperarTableClass::ID,
                recuperarTableClass::PREGUNTA_SECRETA
            );
            $this->objRecuperar = recuperarTableClass::getAll($fields, false);
            $this->defineView('index', 'recuperar', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
