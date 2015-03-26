<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

class indexLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                loteTableClass::ID,
                loteTableClass::NOMBRE
            );
            $orderBy = array(
                loteTableClass::ID
            );
     
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            
            $f = array(
                loteTableClass::ID
            );
            $lines = config::getRowGrid();

            $this->cntPages = loteTableClass::getAllCount($f, false, $lines);
            $this->page = request::getInstance()->getGet('page');
            $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'lote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
