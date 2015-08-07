<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateVacunaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $nombre = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true));
        $lote = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true));
        $fecha_fabricacion = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true));
        $fecha_vencimiento = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true));
        $valor = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true));
        $id = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::ID, true));
        $cantidad = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true));
        $stock = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true));

//        vacunaTableClass::validateEdit($lote, $id, $valor, $nombre, $fecha_fabricacion, $fecha_vencimiento);

//                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));
//                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true));
//
//                $ids = array(
//                    razaTableClass::ID => $id
//                );

        $ids = array(
          vacunaTableClass::ID => $id
        );

        $data = array(
          vacunaTableClass::NOMBRE_VACUNA => $nombre,
          vacunaTableClass::LOTE_VACUNA => $lote,
          vacunaTableClass::FECHA_FABRICACION => $fecha_fabricacion,
          vacunaTableClass::FECHA_VENCIMIENTO => $fecha_vencimiento,
          vacunaTableClass::VALOR => $valor,
          vacunaTableClass::CANTIDAD => $cantidad,
          vacunaTableClass::STOCK_MINIMO => $stock
        );

        vacunaTableClass::update($ids, $data);
        session::getInstance()->setSuccess(i18n::__('succesUpdate'));
        log::register(i18n::__('update'), vacunaTableClass::getNameTable());
        routing::getInstance()->redirect('vacunacion', 'indexVacuna');
      } else {
        log::register(i18n::__('update'), vacunaTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
        session::getInstance()->setError(i18n::__('errorUpdate'));
        routing::getInstance()->redirect('vacunacion', 'indexVacuna');
      }//close if
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
