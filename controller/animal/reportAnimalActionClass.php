<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validate;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
//            if (session::getInstance()->hasAttribute('animalFiltersAnimal')) {
//                $where = session::getInstance()->getAttribute('animalFiltersAnimal');
//            }

            if (request::getInstance()->hasPost('report')) {
                $report = request::getInstance()->getPost('report');
//
                if (isset($report['edad_inicial']) and $report['edad_inicial'] !== null and $report['edad_inicial'] !== '' and isset($report['edad_fin']) and $report['edad_fin'] !== null and $report['edad_fin'] !== '') {
                    $edad_inicial = validate::getInstance()->validateCharactersNumber($report['edad_inicial']);
                    $edad_fin = validate::getInstance()->validateCharactersNumber($report['edad_fin']);
                    /*echo ($edad_inicial) ? 'verdadero' : 'falso';
                    exit();*/
                    if ($edad_inicial == true or $edad_fin == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[animalTableClass::EDAD] = array(
                        $report['edad_inicial'],
                        $report['edad_fin']
                    );
                }

                if (isset($report['peso_inicial']) and $report['peso_inicial'] !== null and $report['peso_inicial'] !== '' and isset($report['peso_fin']) and $report['peso_fin'] !== null and $report['peso_fin'] !== '') {
                    $peso_inicial = validate::getInstance()->validateCharactersNumber($report['peso_inicial']);
                    $peso_fin = validate::getInstance()->validateCharactersNumber($report['peso_fin']);
                    if ($edad_inicial == true or $edad_fin == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[animalTableClass::PESO] = array(
                        $report['peso_inicial'],
                        $report['peso_fin']
                    );
                }

                if (isset($report['fecha_inicial']) and $report['fecha_inicial'] !== null and $report['fecha_inicial'] !== '' and isset($report['fecha_fin']) and $report['fecha_fin'] !== null and $report['fecha_fin'] !== '') {
                    $fecha_inicial = validate::getInstance()->validateDate($filter['fecha_inicial']);
                    $fecha_fin = validate::getInstance()->validateDate($filter['fecha_fin']);
                    if ($fecha_inicial == false or $fecha_fin == false) {
                        throw new PDOException(i18n::__(10008, null, 'errors'));
                    }
                    $where[animalTableClass::FECHA_INGRESO] = array(
                        date(config::getFormatTimestamp(), strtotime($report['fecha_inicial'])),
                        date(config::getFormatTimestamp(), strtotime($report['fecha_fin']))
                    );
                }
                
                if (isset($report['genero']) and $report['genero'] !== null and $report['genero'] !== '' and $report['genero'] !== "default") {
                    $genero = validate::getInstance()->validateCharactersNumber($report['genero']);
                    if ($genero == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[animalTableClass::GENERO_ID] = $report['genero'];
                }
                
                
                if (isset($report['lote']) and $report['lote'] !== null and $report['lote'] !== '' and $report['lote'] !== "default") {
                    $lote = validate::getInstance()->validateCharactersNumber($report['lote']);
                    if ($lote == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[animalTableClass::LOTE_ID] = $report['lote'];
                }
                
                
                if (isset($report['raza']) and $report['raza'] !== null and $report['raza'] !== '' and $report['raza'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersNumber($report['raza']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[animalTableClass::RAZA] = $report['raza'];
                }
            }


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
