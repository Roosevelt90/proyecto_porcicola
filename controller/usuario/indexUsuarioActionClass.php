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
class indexUsuarioActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['nombre_usuario']) and $filter['nombre_usuario'] !== null and $filter['nombre_usuario'] !== '') {
          $where [usuarioTableClass::USER] = $filter['nombre_usuario'];
          print_r($filter);
        }

//
        $where[usuarioTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
        );

        session::getInstance()->setAttribute('usuarioFiltersUsuario', $where);
      }
      $fields = array(
        usuarioTableClass::ID,
        usuarioTableClass::USER,
        usuarioTableClass::CREATED_AT
      );


      $orderBy = array(
        usuarioTableClass::USER
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $f = array(
        usuarioTableClass::ID
      );

      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
      } else {
        $this->page = $page;
      }

      $lines = config::getRowGrid();
      $this->cntPages = usuarioTableClass::getAllCount($f, true, $lines, $where);
      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'usuario', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
