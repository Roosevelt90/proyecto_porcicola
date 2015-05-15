<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;

class indexCargoActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try {
             $where = NULL;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//                validacion de datos

                if (isset($filter['cargo']) and $filter['cargo'] !== null and $filter['cargo'] !== '') {
                    $where [cargoTableClass::DESCRIPCION] = $filter['cargo'];
                }
                
                
                session::getInstance()->setAttribute('defaultDeleteFilter', $where);
            }

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
            
            $orderBy = array(
            cargoTableClass::ID
            );
            
            $lines = config::getRowGrid();

            $this->cntPages = cargoTableClass::getAllCount($f, true, $lines);
            $this->page = request::getInstance()->getGet('page');
            $this->objCargo = cargoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            
        $this->defineView('index', 'cargo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
        }
}