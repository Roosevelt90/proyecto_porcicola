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
class viewFacturaCompraActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        
        
        /*$where = array(
            'campo' => 'valor',
            'campo' => array(
                'valor de rango inicial',
                'valor de rango final'
            ),
            'campo LIKE "hola%" OR campo LIKE "%hola" OR campo "%valor%"'
        );*/
        
        
        
        
        
        
        
        try {
            if (request::getInstance()->hasRequest(procesoCompraTableClass::ID)) {
                $idFactura = request::getInstance()->getRequest(procesoCompraTableClass::ID);



//                if (request::getInstance()->hasPost('filter')) {
//                    $where = null;
//                    $filter = request::getInstance()->getPost('filter');
//
//                    if (isset($filter['fecha_inicial']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '' and isset($filter['fecha_final']) and $filter['fecha_final'] !== null and $filter['fecha_final'] !== '') {
//                        $where[detalleVacunacionTableClass::FECHA] = array(
//                            date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
//                            date(config::getFormatTimestamp(), strtotime($filter['fecha_final'] . ' 23.59.59'))
//                        );
//                    }//close if
//                    if (isset($filter['vacuna']) and $filter['vacuna'] !== null and $filter['vacuna'] !== '') {
//                        $where[detalleVacunacionTableClass::VACUNA] = $filter['vacuna'];
//                    }//close if
//                    if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
//                        $where[detalleVacunacionTableClass::DOSIS] = $filter['dosis'];
//                    }//close if
////                    if (isset($filter['accion']) and $filter['accion'] !== null and $filter['accion'] !== '') {
////                        $where[detalleVacunacionTableClass::ACCION] = $filter['accion'];
////                    }
//
//                    $where[detalleVacunacionTableClass::ID_REGISTRO] = $idVacunacion;
//
//                    session::getInstance()->setAttribute('detalleVacunacionFiltersAnimal', $where);
//                } elseif (session::getInstance()->hasAttribute('detalleVacunacionFiltersAnimal')) {
//                    $where = session::getInstance()->getAttribute('detalleVacunacionFiltersAnimal');
//                }//close if
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
                $whereCompra = array(
                    procesoCompraTableClass::getNameTable() . '.' . procesoCompraTableClass::ID => $idFactura
                );

                $page = 0;
//                if (request::getInstance()->hasGet('page')) {
//                    $page = request::getInstance()->getGet('page') - 1;
//                    $page = $page * config::getRowGrid();
//                }
//
//                $f = array(
//                    detalleProcesoCompraTableClass::ID
//                );
//
//                $lines = config::getRowGrid();
//                $this->cntPages = detalleVacunacionTableClass::getAllCount($f, true, $lines, $whereCnt);
                $fieldsDetalle = array(
                    detalleProcesoCompraTableClass::ID,
                    detalleProcesoCompraTableClass::CANTIDAD,
                    detalleProcesoCompraTableClass::SUBTOTAL,
                    detalleProcesoCompraTableClass::TOTAL,
                    detalleProcesoCompraTableClass::VALOR_UNITARIO
                );
                $fieldsInsumo = array(
                    insumoTableClass::NOMBRE
                );
                $fieldsTipoInsumo = array(
                    tipoInsumoTableClass::DESCRIPCION
                );
                $fJoinDetalleInsumo = detalleProcesoCompraTableClass::INSUMO_ID;
                $fJoinInsumo = insumoTableClass::ID;
                $fJoinDetalleTipoInsumo = detalleProcesoCompraTableClass::TIPO_INSUMO;
                $fJoinTipoInsumo = tipoInsumoTableClass::ID;
                $whereDetalle = array(
                    detalleProcesoCompraTableClass::PROCESO_COMPRA_ID => $idFactura
                );
                $orderByDetalle = array(
                    detalleProcesoCompraTableClass::ID
                );
//                print_r($whereDetalle);
//                exit();
                $this->objFacturaCompra = procesoCompraTableClass::getAllJoin($fieldsFacturaCompra, $fieldsEmpleado, $fieldsProveedor, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $whereCompra);
                $this->objDetalleFacturaCompra = detalleProcesoCompraTableClass::getAllJoin($fieldsDetalle, $fieldsInsumo, $fieldsTipoInsumo, null, $fJoinDetalleInsumo, $fJoinInsumo, $fJoinDetalleTipoInsumo, $fJoinTipoInsumo, null, null, false, $orderByDetalle, 'ASC', 10, $page, $whereDetalle);
                $this->defineView('view', 'facturaCompra', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
