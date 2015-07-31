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
        
        $patron ="^[a-zA-Z0-9]{3,20}$";
       
        if (empty($numero_documento)) {
            session::getInstance()->setError('el campo número de documento no puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true), true);
        }
        if (empty($telefono)) {
            session::getInstance()->setError('el campo teléfono no puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TEL, true), true);
        }
        if (empty($direccion)) {
            session::getInstance()->setError('el campo direción no puede ser vacio');
            $flag = true;
            session::getInstance()->setFirstCall(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true), true);
        }
        if (empty($nombre_completo) or ! isset($nombre_completo) or $nombre_completo == '') {
            session::getInstance()->setError('el campo nombre no puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
        } else if (strlen($nombre_completo) < 2) {
            session::getInstance()->setError('Minimo dos caracteres en el nombre');
            $flag = true;
            session::getInstance()->setFlash(emple::getNameField(empleadoTableClass::NOMBRE, true), true);
        } else if (!ereg($patron, $nombre_completo)) {
            session::getInstance()->setError('No se permiten caracteres especiales en el nombre');
            $flag = true;
            session::getInstance()->setFirstCall(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
        }
      
        
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('personal', 'insertEmpleado');
        }
        
        
        
    }
 
    
    
    
        
    public static function validateUpdate($nombre_completo, $direccion, $telefono, $numero_documento ) {
          
        $flag = false;
        $patron = "^[a-zA-Z0-9]{3,20}$";
    
        if (empty($numero_documento)) {
            session::getInstance()->setError('vacio el campo num');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true), true);
        }
        if (empty($telefono)) {
            session::getInstance()->setError('vacio el campo tel');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TEL, true), true);
        }
        if (empty($direccion)) {
            session::getInstance()->setError('vacio el campo direc');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true), true);
        }
        if (empty($nombre_completo) or ! isset($nombre_completo) or $nombre_completo == '') {
            session::getInstance()->setError('No puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
        } else if (strlen($nombre_completo) < 2) {
            session::getInstance()->setError('Minimo dos caracteres');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
        } else if (!ereg($patron, $nombre_completo)) {
            session::getInstance()->setError('No se permiten caracteres especiales');
            $flag = true;
            session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true), true);
        }
    }
    }