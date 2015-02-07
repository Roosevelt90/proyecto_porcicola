<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;


class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
$id = request::getInstance()->getPost(departamentoTableClass::getNameField(departamentoTableClass::ID ,true));
$nombre = request::getInstance()->getPost(departamentoTableClass::getNameField(departamentoTableClass::NOMBRE, true));

$ids = array(
departamentoTableClass::ID => $id
        );

        $data = array(
        departamentoTableClass::NOMBRE => $nombre
        );

        departamentoTableClass::update($ids, $data);
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


