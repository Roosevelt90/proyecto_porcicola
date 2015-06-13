<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class cargoTableClass extends cargoBaseTableClass {
    
 public static function validateCreate($descripcion){
 
 $flag = false;

        $patternC = "^[a-zA-Z0-9]{3,20}$";
        if (ereg($patternC, $descripcion) == false){
            session::getInstance()->setError('nop');
            $flag = true;
            session::getInstance()->setFlash(cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true), true);
        }
         if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'insertCargo');
        }
 }
  
}
