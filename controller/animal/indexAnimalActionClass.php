<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\validatorFields\validatorFieldsClass as validate;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');


                if (isset($filter['peso']) and $filter['peso'] !== null and $filter['peso'] !== '') {
                    $peso = validate::getInstance()->validateCharactersNumber($filter['peso']);
                    if ($peso == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors', null, 10005));
                    } //close if
                    $where[animalTableClass::PESO] = $filter['edad'];
                } //close if


                if (isset($filter['edad']) and $filter['edad'] !== null and $filter['edad'] !== '') {
                    $edad = validate::getInstance()->validateCharactersNumber($filter['edad']);
                    if ($edad == false) {
                        throw new PDOException(i18n::__(10007, null, 'errors', null, 10005));
                    } //close if
                    $where[animalTableClass::EDAD] = $filter['edad'];
                } //close if
                
                if (isset($filter['fecha_inicial']) and isset($filter['fecha_fin']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '' and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '') {

                    $date = validate::getInstance()->validateDate($filter['fecha_inicial']);
                    if ($date == false) {
                        throw new PDOException(i18n::__(10008, null, 'errors', null, 10005));
                    }//close if
                    $date = validate::getInstance()->validateDate($filter['fecha_fin']);
                    if ($date == false) {
                        throw new PDOException(i18n::__(10008, null, 'errors', null, 10005));
                    }//close if
                    $where[animalTableClass::FECHA_INGRESO] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }//close if
                session::getInstance()->setAttribute('animalFiltersAnimal', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('animalFiltersAnimal');
            }//close if


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

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if
            $f = array(
                animalTableClass::ID
            );
            $lines = config::getRowGrid();

            $this->cntPages = animalTableClass::getAllCount($f, true, $lines, $where);
            $this->page = request::getInstance()->getGet('page');
            $this->objLote = loteTableClass::getAll($fieldsLote, false);
            $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, false);
            $this->objAnimal = animalTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
