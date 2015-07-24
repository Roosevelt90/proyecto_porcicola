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
class indexFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha_final']) and $filter['fecha_final'] !== null and $filter['fecha_final'] !== '' and isset($filter['fecha_inicial']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '') {
                    $where[procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::FECHA_HORA_VENTA] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_final'] . ' 23.59.59'))
                    );
                }//close if
                
                if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[procesoVentaTableClass::EMPLEADO_ID] = $filter['empleado'];
                }//close if
                
                if (isset($filter['cliente']) and $filter['cliente'] !== null and $filter['cliente'] !== '') {
                    $where[procesoVentaTableClass::CLIENTE_ID] = $filter['cliente'];
                }//close if
                
                
                session::getInstance()->setAttribute('facturaVentaFilter', $where);
            } elseif (session::getInstance()->hasAttribute('facturaVentaFilter')) {
                $where = session::getInstance()->getAttribute('facturaVentaFilter');
            }//close if

            $fieldsFacturaVenta = array(
                procesoVentaTableClass::ID,
                procesoVentaTableClass::FECHA_HORA_VENTA,
                procesoVentaTableClass::ACTIVA
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE
            );
            $fieldsCliente = array(
                clienteTableClass::NOMBRE
            );
            $fJoin1 = procesoVentaTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
            $fJoin4 = clienteTableClass::ID;
            $orderBy = array(
                procesoVentaTableClass::FECHA_HORA_VENTA
            );



            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, false);
            $this->objCliente = clienteTableClass::getAll($fieldsCliente, false);

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                procesoVentaTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = procesoVentaTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if 


            $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
