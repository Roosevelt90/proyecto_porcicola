<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */


class clienteTableClass extends clienteBaseTableClass {
     
    public static function validateCreate($nombre_completo, $direccion, $telefono, $numero_documento ) {
          
        $flag = false;
        
        $patron = "^[a-zA-Z0-9]{3,20}$";
        if(!ereg($patron, $nombre_completo)){
            session::getInstance()->setError('pailanders');
            $flag = true;
            session::getInstance()->setFirstCall(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true), true);
            
        }
          if (!is_numeric($telefono)) {
            session::getInstance()->setError('no no ');
            $flag = true;
            session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::TEL, true), true);
        }
        if (!is_numeric($numero_documento)) {
            session::getInstance()->setError('no ');
            $flag = true;
            session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::NUMERO_DOC, true), true);
        }
        
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'insertCliente');
        }
        
        
        
    }
 
    
    
    
        
    public static function validateUpdate($nombre_completo, $direccion, $telefono, $numero_documento ) {
          
        $flag = false;
        
        $patron = "^[a-zA-Z0-9]{3,20}$";
        if(!ereg($patron, $nombre_completo)){
            session::getInstance()->setError('pailanders');
            $flag = true;
            session::getInstance()->setFirstCall(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true), true);
            
        }
          if (!is_numeric($telefono)) {
            session::getInstance()->setError('no no ');
            $flag = true;
            session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::TEL, true), true);
        }
        if (!is_numeric($numero_documento)) {
            session::getInstance()->setError('no ');
            $flag = true;
            session::getInstance()->setFlash(clienteTableClass::getNameField(clienteTableClass::NUMERO_DOC, true), true);
        }
        
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'editCliente');
        }
}
}
 

