<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\request\requestClass as request;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class razaTableClass extends razaBaseTableClass {
    
  public static function validatCreate($nombre){
 
      $flag = FALSE;
     $patron = "^[a-zA-Z0-9]{3,20}$";
//     
     if(!ereg($patron, $nombre)){
         session::getInstance()->setError('campo nombre no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true), true);
         
     }
     
      if($flag == true){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('animal', 'indexRaza');
  
         }
}
public static function validatUpdate($nombre){
 
      $flag = FALSE;
     $patron = "^[a-zA-Z0-9]{3,20}$";
//     
     if(!ereg($patron, $nombre)){
         session::getInstance()->setError('campo nombre no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true), true);
         
     }
     
      if($flag == true){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('animal', 'updateRaza');
  
         }
}
 
}
