<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleSalidaBodegaTableClass extends detalleSalidaBodegaBaseTableClass {
  
  public static function validateInventario($insumoBD, $insumoActual){
          $flag = false;
      if($insumoBD < $insumoActual){
            session::getInstance()->setError(i18n::__(20000, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(detalleSalidaBodegaTableClass::getNameField(detalleSalidaBodegaTableClass::ID_INSUMO, true), true);
      }
         if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'indexVacunacion');
        }
    
  }
  
}