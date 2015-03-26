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
class editAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(animalTableClass::ID)) {

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
                $fieldsAnimal = array(
                    animalTableClass::EDAD,
                    animalTableClass::FECHA_INGRESO,
                    animalTableClass::GENERO_ID,
                    animalTableClass::ID,
                    animalTableClass::LOTE_ID,
                    animalTableClass::PESO,
                    animalTableClass::RAZA
                );
                $where = array(
                    animalTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID, true)
                );

                $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
                $this->objLote = loteTableClass::getAll($fieldsLote);
                $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
                $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, $where);             
                $this->defineView('edit', 'animal', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('animal', 'insertAnimal');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
