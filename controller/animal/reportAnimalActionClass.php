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
class reportAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            
            
            $fields = array(
                animalTableClass::ID,
                animalTableClass::PESO,
                animalTableClass::PRECIO,
                animalTableClass::EDAD,
                animalTableClass::FECHA_INGRESO
            );
            $fields2 = array(
                generoTableClass::NOMBRE
            );
            $fields3 = array(
                loteTableClass::NOMBRE
            );
            $fields4 = array(
                razaTableClass::NOMBRE_RAZA
            );
            $fJoin1 = animalTableClass::GENERO_ID;
            $fJoin2 = generoTableClass::ID;
            $fJoin3 = animalTableClass::LOTE_ID;
            $fJoin4 = loteTableClass::ID;
            $fJoin5 = animalTableClass::RAZA;
            $fJoin6 = razaTableClass::ID;

            $orderBy = array(
                animalTableClass::ID
            );

            $this->objAnimal = animalTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de los cerdos en nuestro sistema';
            $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
