<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
        $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
        $fabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true));
        $vencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true));
        $tipo_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true));
        $valor = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR, true));

        $ids = array(
          insumoTableClass::ID => $id
        );

        $data = array(
          insumoTableClass::NOMBRE => $nombre,
          insumoTableClass::FECHA_FABRICACION => $fabricacion,
          insumoTableClass::FECHA_VENCIMIENTO => $vencimiento,
          insumoTableClass::TIPO_INSUMO => $tipo_insumo,
          insumoTableClass::VALOR => $valor
        );

        insumoTableClass::update($ids, $data);
      }//close if

      routing::getInstance()->redirect('insumo', 'index');
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
