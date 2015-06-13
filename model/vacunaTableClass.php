<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of vacunaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class vacunaTableClass extends vacunaBaseTableClass {

    public static function validate($nombre, $lote, $fecha_fabricacion, $fecha_vencimiento, $valor) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";

        if (!is_numeric($valor)) {
            session::getInstance()->setError(i18n::__(10023, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
        }



        if (empty($nombre) or !isset($nombre) or $nombre == '') {

            session::getInstance()->setError('re_pailas');
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        } else if (strlen($nombre) < 3) {
            session::getInstance()->setError('pailas');
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        } else if (ereg($patternC, $nombre) == false) {
            session::getInstance()->setError(i18n::__(10022, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        }

//        if (ereg($patternC, $nombre) == false) {
//            session::getInstance()->setError(i18n::__(10022, null, 'errors', array('%campo%' => $nombre)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
//        }
//        if (ereg($patternC, $lote) == false) {
//            session::getInstance()->setError(i18n::__(10022, null, 'errors', array('%campo%' => $lote)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
//        }

        if ($fecha_vencimiento < $dateNow) {
            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if ($fecha_fabricacion > $dateNow) {
            session::getInstance()->setError(i18n::__(100201, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
        }
        if (preg_match($pattern, $fecha_fabricacion) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
        }
        if (preg_match($pattern, $fecha_vencimiento) == false) {
            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'insertVacuna');
        }
    }

    public static function validateEdit($lote, $id) {
        $flag = false;

//        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
//        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";

//        if (!is_numeric($valor)) {
//            session::getInstance()->setError(i18n::__(10023, null, 'errors', array('%campo%' => $valor)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
//        }
//        if (ereg($patternC, $nombre) == false) {
//            session::getInstance()->setError(i18n::__(10022, null, 'errors', array('%campo%' => $nombre)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
//        }
        if (ereg($patternC, $lote) == false) {
            session::getInstance()->setError(i18n::__(10022, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }
//
//        if ($fecha_vencimiento < $dateNow) {
//            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
//        }
//        if ($fecha_fabricacion > $dateNow) {
//            session::getInstance()->setError(i18n::__(100201, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
//        }
//        if (preg_match($pattern, $fecha_fabricacion) == false) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_fabricacion)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
//        }
//        if (preg_match($pattern, $fecha_vencimiento) == false) {
//            session::getInstance()->setError(i18n::__(10009, null, 'errors', array('%fecha%' => $fecha_vencimiento)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
//        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array('id' => $id));
            routing::getInstance()->forward('vacunacion', 'editVacuna');
        }
    }

}
