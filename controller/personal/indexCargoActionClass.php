<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;

class indexCargoActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try { echo 1;
          

            $fields = array (
                cargoBaseTableClass::ID,
                cargoBaseTableClass::DESCRIPCION
            );
            $orderBy = array(
                cargoTableClass::ID
            );
           $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                cargoTableClass::ID
            );
            
             $lines = config::getRowGrid();
            $this->cntPages = cargoTableClass::getAllCount($f, true, $lines);
          if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            }else{
                $this->page = $page;
            } 
            $this->objCargo = cargoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            
        $this->defineView('index', 'cargo', session::getInstance()->getFormatOutput());
           } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}