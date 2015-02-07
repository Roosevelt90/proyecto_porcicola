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
        ciudadTableClass::ID,
        ciudadBaseTableClass::NOMBRE
        );
        $fields2 = array (
        departamentoTableClass::NOMBRE
        );
        $fJoin1 = ciudadTableClass::ID_DEPTO;
        $fJoin2 = departamentoTableClass::ID;
        $this->objCiudad = ciudadTableClass::getAll($fields, $fields2, false, $fJoin1, $fJoin2);
      $this->defineView('index', 'ciudad', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}



