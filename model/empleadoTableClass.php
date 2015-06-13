<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class empleadoTableClass extends empleadoBaseTableClass {
  
    public static function validateCreate($nombre_completo, $numero_documento, $telefono) {
        
        $flag = false;
        
        $patron = "^[a-zA-Z0-9]{3,20}$";
        if(!ereg($patron, $nombre_completo)){
            session::getInstance()->setError('pailanders');
            $flag = TRUE;
            session::getInstance()->setFirstCall(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
            
        }
//        if (!is_numeric($telefono)) {
//            session::getInstance()->setError('no no ');
//            $flag = true;
//            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TEL, true), true);
//        }
        if (!is_numeric($numero_documento)) {
            session::getInstance()->setError('no ');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true), true);
        }
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'insertEmpleado');
        }
    }
 
    
    
    
        public static function validateUpdate($date, $id_veterinario, $id_animal) {
        
        $flag = false;
        
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        $dateNow = date("Y-m-d", strtotime("now"));
        
        if (preg_match($pattern, $date) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $date)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }
        if ($date > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true), true);
        }
        if (!is_numeric($id_veterinario)) {
            session::getInstance()->setError(i18n::__(10016, null, 'errors', array('%id_veterinario%' => $id_veterinario)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true), true);
        }
         if (!is_numeric($id_animal)) {
            session::getInstance()->setError(i18n::__(10017, null, 'errors', array('%id_animal%' => $id_animal)));
            $flag = true;
            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true), true);
        }

        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'updateVacunacion');
        }
    }
    
    
}
 


