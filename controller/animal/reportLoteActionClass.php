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
class reportLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (session::getInstance()->hasAttribute('loteFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('loteFiltersAnimal');
            }

$fields = array(
loteTableClass::ID,
loteTableClass::NOMBRE
);

$orderBy = array(
loteTableClass::ID
);
            
            $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de los lotes en nuestro sistema';
            $this->defineView('index', 'lote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}


