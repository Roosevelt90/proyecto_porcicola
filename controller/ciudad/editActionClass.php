<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(ciudadTableClass::ID)) {
                $fields = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::ID_DEPTO,
                    ciudadTableClass::NOMBRE
                );
                $where = array(
                    ciudadTableClass::ID => request::getInstance()->getRequest(ciudadTableClass::ID)
                );
                $fields2 = array(
                    departamentoBaseTableClass::ID,
                    departamentoBaseTableClass::NOMBRE
                );
                $this->objDepto = ciudadTableClass::getAll2($fields2, false);
                $this->objCiudad = ciudadTableClass::getAll3($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'ciudad', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('ciudad', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
