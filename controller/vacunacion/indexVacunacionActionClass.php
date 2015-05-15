<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');



                if (isset($filter['id']) and $filter['id'] !== null and $filter['id'] !== '') {
                    $where[vacunacionTableClass::getNameTable(). '.'.vacunacionTableClass::ID] = $filter['id'];
                }//close if

                if (isset($filter['fecha']) and $filter['fecha'] !== null and $filter['fecha'] !== '') {
                    $where[vacunacionTableClass::FECHA] = $filter['fecha'];
                }//close if
                
                 if (isset($filter['animal']) and $filter['animal'] !== null and $filter['animal'] !== '') {
                    $where[vacunacionTableClass::ANIMAL] = $filter['animal'];
                }//close if

                if (isset($filter['veterinario']) and $filter['veterinario'] !== null and $filter['veterinario'] !== '') {
                    $where[vacunacionTableClass::VETERINARIO] = $filter['veterinario'];
                }//close if
                session::getInstance()->setAttribute('vacunacionFiltersAnimal', $where);
            } elseif (session::getInstance()->hasAttribute('vacunacionFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('vacunacionFiltersAnimal');
            }//close if

            $fieldsVeterinario = array(
               veterinarioTableCLass::ID,
               veterinarioTableClass::NOMBRE
            );

            $fieldsAnimal = array(
            animalTableClass::ID,
            animalTableClass::NUMERO
            );
         


            $orderBy = array(
                vacunacionTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                vacunacionTableClass::ID
            );
            $lines = config::getRowGrid();

           
            $this->cntPages = vacunacionTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            }else{
                $this->page = $page;
            }//close if 
            
            $fieldsVavuna = array(
            vacunaTableClass::ID,
            vacunaTableClass::NOMBRE_VACUNA
            );
            
            $fieldsVacunacion = array(
            vacunacionTableClass::ID,
            vacunacionTableClass::FECHA 
            );
            
            $fieldsVete = array(
            veterinarioTableClass::NOMBRE
            );
            
            $fieldsAni = array(
            animalTableClass::NUMERO
            );
            
            $fJoin1 = vacunacionTableClass::VETERINARIO;
            $fJoin2 = veterinarioTableClass::ID;
            $fJoin3 = vacunacionTableClass::ANIMAL;
            $fJoin4 = animalTableClass::ID;
            
            $this->objVacuna = vacunaTableClass::getAll($fieldsVavuna, true);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
            $this->objVeterinario = veterinarioTableClass::getAll($fieldsVeterinario, true);
            $this->objVacunacion = vacunacionTableClass::getAllJoin($fieldsVacunacion, $fieldsVete, $fieldsAni, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
//            $this->objVacunacion = vacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('view', null, 'empleado'), vacunacionTableClass::getNameTable());
            $this->defineView('index', 'vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
