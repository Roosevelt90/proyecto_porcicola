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
class indexFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha_fin']) and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '' and isset($filter['fecha_inicio']) and $filter['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '') {
                    $where[procesoCompraTableClass::getNameTable() . '.' . procesoCompraTableClass::FECHA_HORA_COMPRA] = array(
                        $filter['fecha_inicio'],
                        $filter['fecha_fin']
                    );
                }//close if
                session::getInstance()->setAttribute('facturaCompraFilter', $where);
            } elseif (session::getInstance()->hasAttribute('facturaCompraFilter')) {
                $where = session::getInstance()->getAttribute('facturaCompraFilter');
            }//close if

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
                proveedorTableClass::NOMBRE_COMPLETO
            );
            $fJoin1 = procesoCompraTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoCompraTableClass::PROVEEDOR_ID;
            $fJoin4 = proveedorTableClass::ID;
            $orderBy = array(
                procesoCompraTableClass::FECHA_HORA_COMPRA
            );


            $fieldsInsumo = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
            );
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);

            $fieldsEmpleados = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleados, true);

            $fieldsProveedores = array(
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE_COMPLETO
            );
            $this->objProveedor = proveedorTableClass::getAll($fieldsProveedores, false);


            $fieldsTipoInsumo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
            );

            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, false);

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                procesoCompraTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = procesoCompraTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if 


            $this->objFacturaCompra = procesoCompraTableClass::getAllJoin($fieldsFacturaCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'facturaCompra', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}