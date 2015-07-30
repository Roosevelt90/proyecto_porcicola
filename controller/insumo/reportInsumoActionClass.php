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
class reportInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (session::getInstance()->hasAttribute('insumoFilters')) {
                $where = session::getInstance()->getAttribute('insumoFilters');
            }//close if

            $fields = array(
            insumoTableClass::ID,
            
            insumoTableClass::NOMBRE,
            insumoTableClass::FECHA_FABRICACION,
            insumoTableClass::FECHA_VENCIMIENTO,
            insumoTableClass::VALOR
            );

            $orderBy = array(
            insumoTableClass::ID
            );

            $this->objInsumo = insumoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de los insumos en nuestro sistema';
            $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
