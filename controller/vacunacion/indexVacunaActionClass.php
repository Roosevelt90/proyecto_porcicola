<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

class indexVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
             $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');



                if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
                    $where[vacunaTableClass::NOMBRE_VACUNA] = $filter['nombre'];
                }//close if

                if (isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== '') {
                    $where[vacunaTableClass::LOTE_VACUNA] = $filter['lote'];
                }//close if
                
                 if (isset($filter['fecha_f']) and $filter['fecha_f'] !== null and $filter['fecha_f'] !== '') {
                    $where[vacunaTableClass::FECHA_VENCIMIENTO] = $filter['fecha_f'];
                }//close if

                if (isset($filter['fecha_v']) and $filter['fecha_v'] !== null and $filter['fecha_v'] !== '') {
                    $where[vacunaTableClass::FECHA_VENCIMIENTO] = $filter['fecha_v'];
                }//close if
                if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
                    $where[vacunaTableClass::VALOR] = $filter['valor'];
                }//close if
                session::getInstance()->setAttribute('vacunaFilters', $where);
            } elseif (session::getInstance()->hasAttribute('vacunaFilters')) {
                $where = session::getInstance()->getAttribute('vacunaFilters');
            }//close if

            $fields = array(
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::ID,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::VALOR,
                vacunaTableClass::CANTIDAD,
                vacunaTableClass::STOCK_MINIMO
            );

            $orderBy = array(
                vacunaTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                vacunaTableClass::ID
            );
            $lines = config::getRowGrid();
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if
            $this->cntPages = vacunaTableClass::getAllCount($f, false, $lines);
            $this->objVacuna = vacunaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'vacuna', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
