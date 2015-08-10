<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

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
        $cantidad = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::CANTIDAD, true));
        $stock = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::STOCK_MINIMO, true)); 
        
//       insumoTableClass::validateEdit($id_tipo_insumo, $tipo_insumo, $insumo, $fecha_fabricacion, $fecha_vencimiento, $precio);
//        
        $ids = array(
          insumoTableClass::ID => $id
        );

        $data = array(
          insumoTableClass::NOMBRE => $nombre,
          insumoTableClass::FECHA_FABRICACION => $fabricacion,
          insumoTableClass::FECHA_VENCIMIENTO => $vencimiento,
          insumoTableClass::TIPO_INSUMO => $tipo_insumo,
          insumoTableClass::VALOR => $valor,
          insumoTableClass::CANTIDAD => $cantidad,
          insumoTableClass::STOCK_MINIMO => $stock
        );

        insumoTableClass::update($ids, $data);
          session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'insumo'));
                log::register(i18n::__('update'), insumoTableClass::getNameTable());
                routing::getInstance()->redirect('insumo', 'index');
      }//close if
         else {
                log::register(i18n::__('update'), insumoTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('insumo', 'index');
            }
  
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
