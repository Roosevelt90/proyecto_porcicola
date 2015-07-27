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

      $where = null;

//      if (request::getInstance()->hasRequest(entradaBodegaTableClass::ID)) {
      $idEntrada = request::getInstance()->getRequest(detalleEntradaBodegaTableClass::ID);

      $where = null;

      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
          $where[detalleEntradaBodegaTableClass::TIPO_INSUMO] = $filter['tipoInsumo'];
        }//close if
        if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
          $where[detalleEntradaBodegaTableClass::ID_INSUMO] = $filter['Insumo'];
        }//close if
        if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
          $where[detalleEntradaBodegaTableClass::CANDITDAD] = $filter['cantidad'];
        }//close if

        $where[detalleEntradaBodegaTableClass::ID_ENTRADA] = $idEntrada;

        session::getInstance()->setAttribute('detalleEntrada', $where);
      } elseif (session::getInstance()->hasAttribute('detalleEntrada')) {
        $where = session::getInstance()->getAttribute('detalleEntrada');
      } else {
        $where = array(
          detalleEntradaBodegaTableClass::ID_ENTRADA => $idEntrada
        );
      }//close if


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

      $fJoin1 = detalleEntradaBodegaTableClass::ID_INSUMO;
      $fJoin2 = insumoTableClass::ID;
      $fJoin3 = detalleEntradaBodegaTableClass::TIPO_INSUMO;
      $fJoin4 = tipoInsumoTableClass::ID;
      $fieldsInsumo = array(
        insumoTableClass::ID,
        insumoTableClass::NOMBRE
      );
      $fieldsTipoInsumo = array(
        tipoInsumoTableClass::ID,
        tipoInsumoTableClass::DESCRIPCION
      );

      $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, false);
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
      $this->cntPages = detalleEntradaBodegaTableClass::getAllCount($f, true, $lines, $whereCnt);
      $this->objEntrada = entradaBodegaTableClass::getAllJoin($fieldsEntrada, $fieldsEmpleado, null, null, $fJoinEntrada1, $fJoinEntrada2, null, null, null, null, true, null, null, config::getRowGrid(), $page, $whereEntrada);
      $this->objDetalleEntrada = detalleEntradaBodegaTableClass::getAllJoin($fieldsDetalleEntrada, $fieldsDetalleInsumo, $fieldsDetalleTipoInsumo, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, null, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('view', 'entradaBodega', session::getInstance()->getFormatOutput());
//      } else {
//        session::getInstance()->setError('pailas');
//        routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
//      }//close if
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
