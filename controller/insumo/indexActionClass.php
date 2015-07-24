<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;

      if (request::getInstance()->hasPost('filter')) {

        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::NOMBRE] = $filter['nombre'];
        }//close if

        if (isset($filter['fabricacionInicial']) and $filter['fabricacionInicial'] !== null and $filter['fabricacionInicial'] !== '') {
          $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::FECHA_FABRICACION] = $filter['fabricacionInicial'];
        }//close if
        if (isset($filter['VencimientoInicial']) and $filter['VencimientoInicial'] !== null and $filter['VencimientoInicial'] !== '') {
          $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::FECHA_VENCIMIENTO] = $filter['VencimientoInicial'];
        }//close if
        if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
          $where[insumoTableClass::getNameTable() . '.' . insumoTableClass::TIPO_INSUMO] = $filter['tipoInsumo'];
        }//close if

        session::getInstance()->setAttribute('vacunacionFiltersAInsumo', $where);
      } elseif (session::getInstance()->hasAttribute('vacunacionFiltersAInsumo')) {
        $where = session::getInstance()->getAttribute('vacunacionFiltersAInsumo');
      }//close if

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//close if
      $f = array(
        insumoTableClass::ID
      );
      $lines = config::getRowGrid();
      $this->cntPages = insumoTableClass::getAllCount($f, true, $lines, $where);

      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
      } else {
        $this->page = $page;
      }//close if 



      $fieldsTipoInsumo = array(
        tipoInsumoTableClass::DESCRIPCION
      );

      $fieldsInsumo = array(
        insumoTableClass::ID,
        insumoTableClass::NOMBRE,
        insumoTableClass::FECHA_FABRICACION,
        insumoTableClass::FECHA_VENCIMIENTO,
        insumoTableClass::TIPO_INSUMO,
        insumoTableClass::VALOR
      );
      $orderBy = array(
        insumoTableClass::ID
      );
      $fJoin1 = insumoTableClass::TIPO_INSUMO;
      $fJoin2 = tipoInsumoTableClass::ID;
      $fieldsTipo = array(
        tipoInsumoTableClass::ID,
        tipoInsumoTableClass::DESCRIPCION
      );
      $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipo, false);
      $this->objInsumo = insumoTableClass::getAllJoin($fieldsInsumo, $fieldsTipoInsumo, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
