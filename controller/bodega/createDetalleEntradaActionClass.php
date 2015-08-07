<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createDetalleEntradaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {


   echo     $id_registro = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true));
        $tipo_insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::TIPO_INSUMO, true));
        $id_insumo = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_INSUMO, true));
        $cantidad = request::getInstance()->getPost(detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true));

        //    detalleVacunacionTableClass::validate($fecha_vacunacion, $id_vacuna, $dosis_vacuna, $accion);

        $data = array(
          detalleEntradaBodegaTableClass::CANDITDAD => $cantidad,
          detalleEntradaBodegaTableClass::ID_ENTRADA => $id_registro,
          detalleEntradaBodegaTableClass::ID_INSUMO => $id_insumo,
          detalleEntradaBodegaTableClass::TIPO_INSUMO => $tipo_insumo
        );
//                print_r($data);
        detalleEntradaBodegaTableClass::insert($data);
        session::getInstance()->setSuccess(i18n::__('succesCreate'));
        log::register(i18n::__('create'), detalleEntradaBodegaTableClass::getNameTable());
        routing::getInstance()->redirect('bodega', 'indexEntrada');
      } else {
        log::register(i18n::__('create'), detalleEntradaBodegaTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
        session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
        routing::getInstance()->redirect('bodega', 'indexEntrada');
      }//close if
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
