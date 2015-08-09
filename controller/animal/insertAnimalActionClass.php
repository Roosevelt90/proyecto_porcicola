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
class insertAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fieldsRaza = array(
                razaTableClass::ID,
                razaTableClass::NOMBRE_RAZA
            );
            $fieldsLote = array(
                loteTableClass::ID,
                loteTableClass::NOMBRE
            );
            $fieldsGenero = array(
                generoTableClass::ID,
                generoTableClass::NOMBRE
            );

            $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
            $this->objLote = loteTableClass::getAll($fieldsLote);
            $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
            $this->defineView('insert', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
