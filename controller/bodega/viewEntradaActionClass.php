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
class viewEntradaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(entradaBodegaTableClass::ID)) {
        $idEntrada = request::getInstance()->getRequest(detalleEntradaBodegaTableClass::ID);

//                $fieldsVacuna = array(
//                    vacunaTableClass::ID,
//                    vacunaTableClass::NOMBRE_VACUNA
//                );
//
//
//                $orderBy = array(
//                    detalleVacunacionTableClass::ID
//                );
//
//
//                $where = array(
//                    detalleVacunacionTableClass::ID_REGISTRO => $idVacunacion
//                );
//
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
//
//                    session::getInstance()->setAttribute('facturaVentaFilter', $where);
//                } elseif (session::getInstance()->hasAttribute('facturaVentaFilter')) {
//                    $where = session::getInstance()->getAttribute('facturaVentaFilter');
//                }//close if

        $fieldsEntrada = array(
          entradaBodegaTableClass::ID,
          entradaBodegaTableClass::FECHA
        );
        $fieldsEmpleado = array(
          empleadoTableClass::NOMBRE
        );
        $whereEntrada = array(
          entradaBodegaTableClass::getNameTable() . '.' . entradaBodegaTableClass::ID => $idEntrada
        );
        $fJoinEntrada1 = entradaBodegaTableClass::EMPLEADO;
        $fJoinEntrada2 = empleadoTableClass::ID;


        $page = 0;
        if (request::getInstance()->hasGet('page')) {
          $page = request::getInstance()->getGet('page') - 1;
          $page = $page * config::getRowGrid();
        }//close if

        $f = array(
          detalleEntradaBodegaTableClass::ID
        );

        $whereCnt = array(
          detalleEntradaBodegaTableClass::ID_ENTRADA => $idEntrada
        );
        $lines = config::getRowGrid();

        $fieldsDetalleEntrada = array(
          detalleEntradaBodegaTableClass::ID,
          detalleEntradaBodegaTableClass::CANDITDAD,
          detalleEntradaBodegaTableClass::ID_ENTRADA,
        );

        $fieldsDetalleInsumo = array(
          insumoTableClass::NOMBRE
        );
        $fieldsDetalleTipoInsumo = array(
          tipoInsumoTableClass::DESCRIPCION
        );
        $where = array(
          detalleEntradaBodegaTableClass::ID_ENTRADA => $idEntrada
        );
        $fJoin1 = detalleEntradaBodegaTableClass::ID_INSUMO;
        $fJoin2 = insumoTableClass::ID;
        $fJoin3 = detalleEntradaBodegaTableClass::TIPO_INSUMO;
        $fJoin4 = tipoInsumoTableClass::ID;

        $this->cntPages = detalleEntradaBodegaTableClass::getAllCount($f, true, $lines, $whereCnt);
        $this->objEntrada = entradaBodegaTableClass::getAllJoin($fieldsEntrada, $fieldsEmpleado, null, null, $fJoinEntrada1, $fJoinEntrada2, null, null, null, null, true, null, null, config::getRowGrid(), $page, $whereEntrada);
        $this->objDetalleEntrada = detalleEntradaBodegaTableClass::getAllJoin($fieldsDetalleEntrada, $fieldsDetalleInsumo, $fieldsDetalleTipoInsumo, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, null, 'ASC', config::getRowGrid(), $page, $where);
        $this->defineView('view', 'vacunacion', session::getInstance()->getFormatOutput());
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
