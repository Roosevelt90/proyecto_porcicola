<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class datosUsuarioTableClass extends datosUsuarioBaseTableClass {
  

 public static function validatCreate($nombre, $apellidos, $cedula, $direccion, $telefono){
     $flag = FALSE;
     $patron = "^[a-zA-Z0-9]{3,20}$";
     
     if(!ereg($patron, $nombre)){
         session::getInstance()->setError('campo nombre no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true), true);
         
     }
     
     if($flag == true){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('datos', 'insert');
  
         }
     if(!ereg($patron, $apellidos)){
         session::getInstance()->setError('campo apellidos no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true), true);
         
     }
      if(!ereg($patron, $cedula)){
         session::getInstance()->setError('campo cedula no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CEDULA, true), true);
         
     }
   
         
    if(!ereg($patron, $direccion)){
         session::getInstance()->setError('campo direccion no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true), true);
         
     }
     
      if(!ereg($patron, $telefono)){
         session::getInstance()->setError('campo telefono no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true), true);
         
     }
 }
}
