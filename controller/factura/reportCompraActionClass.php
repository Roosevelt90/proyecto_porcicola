<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
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
class reportCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

           $fieldsFacturaCompra = array(
                procesoCompraTableClass::ID,
                procesoCompraTableClass::FECHA_HORA_COMPRA,
                procesoCompraTableClass::EMPLEADO_ID,
                procesoCompraTableClass::PROVEEDOR_ID,
                procesoCompraTableClass::ACTIVA
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE
            );
            $fieldsProveedor = array(
                proveedorTableClass::NOMBRE
            );
            $fJoin1 = procesoCompraTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoCompraTableClass::PROVEEDOR_ID;
            $fJoin4 = proveedorTableClass::ID;
       $this->mensaje = "Informe de Facturas de Compra";

            $this->objFacturaCompra = procesoCompraTableClass::getAllJoin($fieldsFacturaCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true);
                       log::register(i18n::__('reporte'), procesoCompraTableClass::getNameTable());
            $this->defineView('report', 'facturaCompra', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
