<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $fieldsFacturaVenta = array(
                procesoVentaTableClass::ID,
                procesoVentaTableClass::FECHA_HORA_VENTA,
                procesoVentaTableClass::ACTIVA
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $fieldsCliente = array(
                clienteTableClass::ID,
                clienteTableClass::NOMBRE
            );
            $fJoin1 = procesoVentaTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
            $fJoin4 = clienteTableClass::ID;
            $orderBy = array(
                procesoVentaTableClass::FECHA_HORA_VENTA
            );
            $this->mensaje = "Informe de Facturas de Venta";

            $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC');
            $this->defineView('report', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
