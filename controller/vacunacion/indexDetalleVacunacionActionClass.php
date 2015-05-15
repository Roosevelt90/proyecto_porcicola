<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
                detalleVacunacionTableClass::ID,
                detalleVacunacionTableClass::ID_REGISTRO,
                detalleVacunacionTableClass::VACUNA,
                detalleVacunacionTableClass::FECHA,
                detalleVacunacionTableClass::DOSIS,
                detalleVacunacionTableClass::ACCION
            );

            $orderBy = array(
                detalleVacunacionTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }

            $f = array(
                detalleVacunacionTableClass::ID
            );
            $lines = config::getRowGrid();

            $this->cntPages = detalleVacunacionTableClass::getAllCount($f, true, $lines);
            $this->page = request::getInstance()->getGet('page');

            $this->objDetalleVacunacion = detalleVacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page);
            log::register(i18n::__('view',null,'empleado'), detalleVacunacionTableClass::getNameTable());
            $this->defineView('index', 'detalleVacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
