<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $this->defineView('insert', 'lote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
