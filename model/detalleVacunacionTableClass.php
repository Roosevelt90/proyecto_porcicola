<?php

use mvc\model\modelClass as model;
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of detalleVacunacionTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleVacunacionTableClass extends detalleVacunacionBaseTableClass {
      public static function validate($fecha_vacunacion, $id_vacuna, $dosis_vacuna, $accion) {
        
        $flag = false;
        
//        if (!is_numeric($id_porcino)) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%id_porcino%' => $id_porcino)));
//            $flag = true;
//            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_PORCINO, true), true);
//        }
         if (!is_numeric($id_vacuna)) {
            session::getInstance()->setError(i18n::__(10013, null, 'errors', array('%id_vacuna%' => $id_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
      

        
        if(strlen($dosis_vacuna) > 10){
            session::getInstance()->setError(i18n::__(10015, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
         }
           if(strlen($accion) > 10){
            session::getInstance()->setError(i18n::__(10015, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true), true);
         }
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    }
         public static function validateUpdate($fecha_vacunacion, $id_vacuna, $dosis_vacuna, $accion) {
        
        $flag = false;
        
             if (!is_numeric($id_vacuna)) {
            session::getInstance()->setError(i18n::__(10018, null, 'errors', array('%id_vacuna%' => $id_vacuna)));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true), true);
        }
      

        
        if(strlen($dosis_vacuna) > 10){
            session::getInstance()->setError(i18n::__(10015, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true), true);
         }
           if(strlen($accion) > 10){
            session::getInstance()->setError(i18n::__(10015, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true), true);
         }
        
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    }
    
}

