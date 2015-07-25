<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexPagoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
            $fields = array(
                pagoEmpleadosTableClass::ID,
                pagoEmpleadosTableClass::ID_EMPLEADO,
                pagoEmpleadosTableClass::NOMBRE,
                pagoEmpleadosTableClass::FECHA_INICIO,
                pagoEmpleadosTableClass::FECHA_FIN,
                pagoEmpleadosTableClass::FECHA_PAGO,
                pagoEmpleadosTableClass::TOTAL
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NUMERO_DOC,
                
            );

            $fields2 = array(
            empleadoTableClass::ID
                
            );


            $fJoin1 = pagoEmpleadosTableClass::ID_EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
           


            $orderBy = array(
                pagoEmpleadosTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                pagoEmpleadosTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = pagoEmpleadosTableClass::getAllCount($f, false, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }


            $this->objPago = pagoEmpleadosTableClass::getAllJoin($fields, $fields2,  null,null, $fJoin1, $fJoin2,  null,null, null, null,  false,$orderBy, 'ASC', config::getRowGrid(), $page);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            $this->defineView('index', 'pago', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
