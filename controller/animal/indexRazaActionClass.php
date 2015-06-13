<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

class indexRazaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                razaBaseTableClass::ID,
                razaBaseTableClass::NOMBRE_RAZA
            );

            $orderBy = array(
                razaTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                razaTableClass::ID
            );
            $lines = config::getRowGrid();

            $this->cntPages = razaTableClass::getAllCount($f, false, $lines);
            $this->page = request::getInstance()->getGet('page');
            $this->objRaza = razaBaseTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'raza', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
