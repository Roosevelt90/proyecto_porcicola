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
class insertDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
          
            $fieldsVacuna = array(
            vacunaTableClass::ID,
            vacunaTableClass::NOMBRE_VACUNA
            );
            $fieldsVacunacion = array(
                vacunacionTableClass::ID
            );

   
            $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
            $this->objVacunacion = vacunacionTableClass::getAll($fieldsVacunacion, true);
            $this->defineView('insert', 'detalleVacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
