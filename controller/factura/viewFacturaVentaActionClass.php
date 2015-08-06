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
class viewFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

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
            if (request::getInstance()->hasRequest(procesoVentaTableClass::ID)) {
                $idFactura = request::getInstance()->getRequest(procesoVentaTableClass::ID);



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
                $fieldsFacturaVenta = array(
                    procesoVentaTableClass::ID,
                    procesoVentaTableClass::FECHA_HORA_VENTA,
                    procesoVentaTableClass::EMPLEADO_ID,
                    procesoVentaTableClass::CLIENTE_ID,
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
                $whereVenta = array(
                    procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::ID => $idFactura
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
                detalleProcesoVentaTableClass::ID,
                detalleProcesoVentaTableClass::VENTA,
                detalleProcesoVentaTableClass::VALOR,
                detalleProcesoVentaTableClass::ANIMAL
                );
                $fieldsAnimal = array(
                animalTableClass::NUMERO
                );
             
               
                $fJoinDetalle = detalleProcesoVentaTableClass::ANIMAL;
                $fJoinAnimal = animalTableClass::ID;
               
                $whereDetalle = array(
                    detalleProcesoVentaTableClass::VENTA => $idFactura
                );
                $orderByDetalle = array(
                    detalleProcesoVentaTableClass::ID
                );

                $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, null, null, null, null, $whereVenta);
                $this->objDetalleFacturaVenta = detalleProcesoVentaTableClass::getAllJoin($fieldsDetalle, $fieldsAnimal, null, null, $fJoinDetalle, $fJoinAnimal, null, null, null, null, false, $orderByDetalle, 'ASC', 10, $page, $whereDetalle);
                $this->defineView('view', 'facturaVenta', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('factura', 'indexFacturaVenta');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
