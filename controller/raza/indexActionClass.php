<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;


class indexActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try {
            
            $fields = array (
            razaBaseTableClass::ID,
            razaBaseTableClass::NOMBRE_RAZA
            );
            $this->objRaza = razaBaseTableClass::getAll($fields, FALSE);
            $this->defineView('index', 'raza', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
        }
}