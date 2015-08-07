<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(insumoTableClass::ID)) {
        $fields = array(
          insumoTableClass::ID,
          insumoTableClass::NOMBRE,
          insumoTableClass::FECHA_FABRICACION,
          insumoTableClass::FECHA_VENCIMIENTO,
          insumoTableClass::TIPO_INSUMO,
          insumoTableClass::VALOR, 
          insumoTableClass::CANTIDAD,
          insumoTableClass::STOCK_MINIMO
        );
        $where = array(
          insumoTableClass::ID => request::getInstance()->getRequest(insumoTableClass::ID)
        );

        $fieldsTipo = array(
          tipoInsumoTableClass::ID,
          tipoInsumoTableClass::DESCRIPCION
        );
        $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipo, false);

        $this->objInsumo = insumoTableClass::getAll($fields, false, null, null, null, null, $where);
        $this->defineView('edit', 'insumo', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('insumo', 'index');
      }//close if
    } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
