<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;

class indexRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                registroPartoTableClass::ID,
                registroPartoTableClass::FECHA_NACIMIENTO,
                registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
                registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
                registroPartoTableClass::NACIDOS_MUERTOS,
                registroPartoTableClass::RAZA_ID,
                registroPartoTableClass::ANIMAL_ID
            );

            $orderBy = array(
                registroPartoTableClass::ID
            );

             $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                registroPartoTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

           
            $lines = config::getRowGrid();

            $this->cntPages = registroPartoTableClass::getAllCount($f, false, $lines);
           // $this->page = request::getInstance()->getGet('page');
            $this->objParto = registroPartoTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
