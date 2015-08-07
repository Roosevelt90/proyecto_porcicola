<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;
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
          if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
            $where[procesoCompraTableClass::EMPLEADO_ID] = $filter['empleado'];
          }//close if
          if (isset($filter['proveedor']) and $filter['proveedor'] !== null and $filter['proveedor'] !== '') {
            $where[procesoCompraTableClass::PROVEEDOR_ID] = $filter['proveedor'];
          }//close if
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
        proveedorTableClass::NOMBRE
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
        proveedorTableClass::NOMBRE
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
            log::register(i18n::__('ver', null, 'facturaCompra'), procesoCompraTableClass::getNameTable());
      $this->defineView('index', 'facturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
