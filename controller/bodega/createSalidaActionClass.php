<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createSalidaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fecha = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true));
      $empleado = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO, true));

      $data = array(
        salidaBodegaTableClass::EMPLEADO => $empleado,
        salidaBodegaTableClass::FECHA => $fecha
      );
      salidaBodegaTableClass::insert($data);
      log::register(i18n::__('create'), salidaBodegaTableClass::getNameTable());
      routing::getInstance()->redirect('bodega', 'indexSalida');
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
