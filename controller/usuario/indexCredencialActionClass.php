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
class indexCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $fields = array(
                credencialTableClass::ID,
                credencialTableClass::NOMBRE
            );
            $orderBy = array(
            credencialTableClass::ID
            );
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                credencialTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }
            $lines = config::getRowGrid();
            $this->cntPages = credencialTableClass::getAllCount($f, true, $lines, $where);
            $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
