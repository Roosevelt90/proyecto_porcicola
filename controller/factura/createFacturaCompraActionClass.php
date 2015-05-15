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
class createFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fecha = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true));
            $empleado = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true));
            $proveedor = request::getInstance()->getPost(procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true));

            $data = array(
                procesoCompraTableClass::FECHA_HORA_COMPRA => $fecha,
                procesoCompraTableClass::EMPLEADO_ID => $empleado,
                procesoCompraTableClass::PROVEEDOR_ID => $proveedor
            );

            procesoCompraTableClass::validateCreate($fecha);

            procesoCompraTableClass::insert($data);
            log::register(i18n::__('create'), procesoCompraTableClass::getNameTable());
            routing::getInstance()->redirect('factura', 'indexFacturaCompra');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
