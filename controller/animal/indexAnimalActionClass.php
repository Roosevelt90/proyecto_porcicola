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

                if (isset($filter['genero']) and $filter['genero'] !== null and $filter['genero'] !== '') {
                    $where [animalTableClass::GENERO_ID] = $filter['genero'];
                }
                if (isset($filter['raza']) and $filter['raza'] !== null and $filter['raza'] !== '') {
                    $where [animalTableClass::RAZA] = $filter['raza'];
                }
                if (isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== '') {
                    $where [animalTableClass::LOTE_ID] = $filter['lote'];
                }
                
                
                if (isset($filter['peso']) and $filter['peso'] !== null and $filter['peso'] !== '') {
                 
                    $where[animalTableClass::PESO] = $filter['peso'];
                } //close if


                if (isset($filter['edad']) and $filter['edad'] !== null and $filter['edad'] !== '') {
                    
                    $where[animalTableClass::EDAD] = $filter['edad'];
                } //close if
                
                if (isset($filter['fecha_inicial']) and isset($filter['fecha_fin']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '' and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '') {

                    $where[animalTableClass::FECHA_NACIMIENTO] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
                    );
                }
                session::getInstance()->setAttribute('animalFiltersAnimal', $where);
            } elseif (session::getInstance()->hasAttribute('animalFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('animalFiltersAnimal');
            }


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
                animalTableClass::PRECIO_ANIMAL,
                animalTableClass::FECHA_NACIMIENTO,
                animalTableClass::NUMERO,
                animalTableClass::PARTO
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
            }
            $f = array(
                animalTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();
            $this->cntPages = animalTableClass::getAllCount($f, true, $lines, $where);
           // $this->page = request::getInstance()->getGet('page');
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
