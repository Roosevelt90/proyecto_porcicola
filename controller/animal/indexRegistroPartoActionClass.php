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
            $where = null;
             if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
                                       
//                    $where[registroPartoTableClass::FECHA_NACIMIENTO] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
//                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
//                    );
                 if (isset($filter['raza']) and $filter['raza'] !== null and $filter['raza'] !== '') {
                    $where [registroPartoTableClass::RAZA_ID] = $filter['raza'];
                }
               
                   session::getInstance()->setAttribute('usuarioFiltersUsuario', $where);

             }

            $fields = array(
            registroPartoTableClass::ID,
            registroPartoTableClass::ANIMAL_ID,
            registroPartoTableClass::FECHA_NACIMIENTO,
            registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
            registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
            registroPartoTableClass::NACIDOS_MUERTOS,
            registroPartoTableClass::RAZA_ID
            );
            $fields2 = array (
            razaTableClass::NOMBRE_RAZA
            );
              $fields3 = array (
              animalTableClass::NUMERO
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
             $this->objAnimal = animalTableClass::getAll($fields3, true);
            $this->objRaza = razaTableClass::getAll($fields2, true);
            $this->objParto = registroPartoTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page);
            $this->defineView('index', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
