<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
            );
            $this->objInsumo = insumoTableClass::getAll($fields, true);
            $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
