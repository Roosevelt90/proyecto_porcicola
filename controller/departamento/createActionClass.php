<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;



class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
          $nombre = request::getInstance()->getPost(departamentoBaseTableClass::getNameField(departamentoBaseTableClass::NOMBRE, true));
        $data = array(
        departamentoBaseTableClass::NOMBRE => $nombre
        );
        departamentoBaseTableClass::insert($data);
     
      } 
        routing::getInstance()->redirect('departamento', 'index');
      
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}

