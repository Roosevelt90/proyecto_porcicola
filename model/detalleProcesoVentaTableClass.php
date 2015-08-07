<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleProcesoVentaTableClass extends detalleProcesoVentaBaseTableClass {

  public static function validateInventario($animal) {
    $flag = false;

    if (isset($animal) or $animal == '' or empty($animal)) {
      session::getInstance()->setError(i18n::__(20001, null, 'errors'));
      $flag = true;
      session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID, true), true);
    }

    if ($flag == true) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('animal', 'indextAnimal');
    }
  }

}
