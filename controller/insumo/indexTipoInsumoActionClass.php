<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;


class indexTipoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//close if
      $f = array(
          tipoInsumoTableClass::ID
      );
      $lines = config::getRowGrid();
      $this->cntPages = tipoInsumoTableClass::getAllCount($f, true, $lines, $where);


      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
      } else {
        $this->page = $page;
      }//close if 

      $fields = array(
        tipoInsumoTableClass::ID,
        tipoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
        tipoInsumoTableClass::ID
      );
      $this->objTipoInsumo = tipoInsumoBaseTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'tipoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
