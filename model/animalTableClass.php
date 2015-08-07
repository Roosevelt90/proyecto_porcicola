<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;

/**
 * Description of animalTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class animalTableClass extends animalBaseTableClass {

    public static function validate($numero_identificacion, $peso, $fecha_nacimiento, $genero, $lote, $raza) {
        $flag = false;
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        $dateNow = date("Y-m-d", strtotime("now"));

        if (!is_numeric($numero_identificacion)) {
            session::getInstance()->setError(i18n::__(10007, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, true), true);
        }
        
        if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__(10007, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, true), true);
        }


//        if ($genero !== 1 or $genero !== 2) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%campo%' => 'Genero')));
//            $flag = true;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO_ID, true), true);
//        } 

//        if (preg_match($pattern, $fecha_nacimiento) == false) {
//            session::getInstance()->setError(i18n::__(10008, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_NACIMIENTO, true), true);
//        }
        
        if (!is_numeric($lote)) {
            session::getInstance()->setError(i18n::__(10007, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::LOTE_ID, true), true);
        }
        
        if (!is_numeric($raza)) {
            session::getInstance()->setError(i18n::__(10007, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::RAZA, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('animal', 'insertAnimal');
        }
    }

}
