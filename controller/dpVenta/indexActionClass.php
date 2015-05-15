<?php


use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        $fields = array ( 
        dpVentaTableClass::ID,
        dpVentaTableClass::NUMERO_DOCUMENTO,
        dpVentaTableClass::FECHA,
        dpVentaTableClass::USUARIO_ID,
        dpVentaBaseTableClass::PESO_ANIMAL,
        dpVentaTableClass::PRECIO_ANIMAL,
        dpVentaTableClass::ANIMAL_ID
        );
        
        $this->objDventa = dpVentaTableClass::getAll($fields, false);
      $this->defineView('index', 'dpVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}



