<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $whereCount = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
                if (isset($filter['edad'])) {
                    $where[animalTableClass::EDAD] = $filter['edad'];
                    $whereCount = array(
                    animalTableClass::EDAD => $filter['edad']
                    );
//                    
               }
//                $where[animalTableClass::FECHA_INGRESO] = array(
//                date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
//                date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
//                );
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
            }
            $f = array(
                animalTableClass::ID
            );
            $lines = config::getRowGrid();

            $this->cntPages = animalTableClass::getAllCount($f, false, $lines, $whereCount);
            $this->page = request::getInstance()->getGet('page');
            $this->objLote = loteTableClass::getAll($fieldsLote, true);
            $this->objGenero = generoTableClass::getAll($fieldsGenero, false);
            $this->objRaza = razaTableClass::getAll($fieldsRaza, true);
            $this->objAnimal = animalTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }
    

}
