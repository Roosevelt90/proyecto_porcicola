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
class reportEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (session::getInstance()->hasAttribute('empleadoFilters')) {
                $where = session::getInstance()->getAttribute('empleadoFilters');
            }
$fields = array(
                empleadoTableClass::ID,
                empleadoTableClass::NUMERO_DOC,
                empleadoTableClass::CIUDAD,
                empleadoTableClass::NOMBRE,
                empleadoTableClass::TEL,
                empleadoTableClass::CARGO,
                empleadoTableClass::TIPO_DOC
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                cargoTableClass::DESCRIPCION
            );
            $fields4 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );

            $fJoin1 = empleadoTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = empleadoTableClass::CARGO;
            $fJoin4 = cargoTableClass::ID;
            $fJoin5 = empleadoTableClass::TIPO_DOC;
            $fJoin6 = tipoDocumentoTableClass::ID;
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                empleadoTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = empleadoTableClass::getAllCount($f, false, $lines);
            $this->page = request::getInstance()->getGet('page');


            $this->objEmpleado = empleadoTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, null, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('indexEmpleado', 'empleado', session::getInstance()->getFormatOutput());
          } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }



}
