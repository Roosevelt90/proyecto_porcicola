<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;



class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(departamentoTableClass::ID)) {
        $fields = array(
        departamentoTableClass::ID,
        departamentoTableClass::NOMBRE
        );
        $where = array(
            departamentoTableClass::ID => request::getInstance()->getRequest(departamentoTableClass::ID)
        );
        $this->objDepto = departamentoTableClass::getAll($fields, false, null, null, null, null, $where);
        $this->defineView('edit', 'departamento', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('departamento', 'index');
      }//close if
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}

