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
        $this->objFacturaCompra = procesoCompraTableClass::getAllJoin($fieldsFacturaCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true);
       
        
        $fieldsInsumo = array(
        insumoTableClass::ID,
        insumoTableClass::NOMBRE
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
        
        
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
            }else{
                $this->page = $page;
            }//close if 
            
        
        $this->defineView('index', 'facturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}



