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

    public static function validate($nombre, $lote, $fecha_fabricacion, $fecha_vencimiento, $valor, $cantidad, $stock) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";

//        if (!is_numeric($valor)) {
//            session::getInstance()->setError(i18n::__(10033, null, 'errors', array('%campo%' => $valor)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
//        }

//        if (!is_numeric($cantidad)) {
//            session::getInstance()->setError(i18n::__(10071, null, 'errors', array('%campo%' => $cantidad)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
//        }

//        if (!is_numeric($stock)) {
//            session::getInstance()->setError(i18n::__(10072, null, 'errors', array('%campo%' => $stock)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
//        }

//        if (ereg($patternC, $cantidad) == false) {
//            session::getInstance()->setError(i18n::__(10077, null, 'errors', array('%campo%' => $cantidad)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
//        }

//        if (ereg($patternC, $stock) == false) {
//            session::getInstance()->setError(i18n::__(10078, null, 'errors', array('%campo%' => $stock)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
//        }

        if (ereg($patternC, $valor) == false) {
            session::getInstance()->setError(i18n::__(10036, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
        }

        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10073, null, 'errors', array('%campo%' => $cantidad)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
        }

        if (empty($stock) or ! isset($stock) or $stock == '') {

            session::getInstance()->setError(i18n::__(10074, null, 'errors', array('%campo%' => $stock)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10043, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
        }

        if (empty($lote) or ! isset($lote) or $lote == '') {

            session::getInstance()->setError(i18n::__(10039, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        } 
        if (strlen($lote) < 3) {
            session::getInstance()->setError(i18n::__(10040, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }

        if (empty($nombre) or ! isset($nombre) or $nombre == '') {

            session::getInstance()->setError(i18n::__(10037, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        } 
        
        if (strlen($nombre) > 50) {
            session::getInstance()->setError(i18n::__(10038, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        } 
        if (ereg($patternC, $nombre) == false) {
            session::getInstance()->setError(i18n::__(10034, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        }

//        if (ereg($patternC, $lote) == false) {
//            session::getInstance()->setError(i18n::__(10035, null, 'errors', array('%campo%' => $lote)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
//        }

        if (!is_numeric($lote)) {
            session::getInstance()->setError(i18n::__(10032, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }
        if (empty($fecha_fabricacion) or ! isset($fecha_fabricacion) or $fecha_fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors', array('%campo%' => $fecha_fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
        }

        if (empty($fecha_vencimiento) or ! isset($fecha_vencimiento) or $fecha_vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors', array('%campo%' => $fecha_vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if ($fecha_vencimiento < $dateNow) {
            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if ($fecha_fabricacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10021, null, 'errors'));
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

    public static function validateEdit($lote, $id, $valor, $nombre, $fecha_fabricacion, $fecha_vencimiento, $cantidad, $stock) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";
//
//        if (!is_numeric($valor)) {
//            session::getInstance()->setError(i18n::__(10033, null, 'errors', array('%campo%' => $valor)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
//        }
//        if (!is_numeric($cantidad)) {
//            session::getInstance()->setError(i18n::__(10071, null, 'errors', array('%campo%' => $cantidad)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
//        }

        if (!is_numeric($stock)) {
            session::getInstance()->setError(i18n::__(10072, null, 'errors', array('%campo%' => $stock)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
        }
//
//        if (ereg($patternC, $cantidad) == false) {
//            session::getInstance()->setError(i18n::__(10077, null, 'errors', array('%campo%' => $cantidad)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
//        }

//        if (ereg($patternC, $stock) == false) {
//            session::getInstance()->setError(i18n::__(10078, null, 'errors', array('%campo%' => $stock)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
//        }

        if (empty($fecha_fabricacion) or ! isset($fecha_fabricacion) or $fecha_fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors', array('%campo%' => $fecha_fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true), true);
        }

        if (empty($fecha_vencimiento) or ! isset($fecha_vencimiento) or $fecha_vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors', array('%campo%' => $fecha_vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }

        if (empty($valor) or ! isset($valor) or $valor == '') {

            session::getInstance()->setError(i18n::__(10043, null, 'errors', array('%campo%' => $valor)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
        }

        if (!is_numeric($lote)) {
            session::getInstance()->setError(i18n::__(10032, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }

        if (empty($cantidad) or ! isset($cantidad) or $cantidad == '') {

            session::getInstance()->setError(i18n::__(10073, null, 'errors', array('%campo%' => $cantidad)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::CANTIDAD, true), true);
        }

        if (empty($stock) or ! isset($stock) or $stock == '') {

            session::getInstance()->setError(i18n::__(10074, null, 'errors', array('%campo%' => $stock)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::STOCK_MINIMO, true), true);
        }

        if (ereg($patternC, $nombre) == false) {
            session::getInstance()->setError(i18n::__(10034, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        }
        if (ereg($patternC, $lote) == false) {
            session::getInstance()->setError(i18n::__(10035, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }

//        if (ereg($patternC, $valor) == false) {
//            session::getInstance()->setError(i18n::__(10036, null, 'errors', array('%campo%' => $valor)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::VALOR, true), true);
//        }

        if ($fecha_vencimiento < $dateNow) {
            session::getInstance()->setError(i18n::__(10020, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true), true);
        }
        if ($fecha_fabricacion > $dateNow) {
            session::getInstance()->setError(i18n::__(10021, null, 'errors'));
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


        if (empty($lote) or ! isset($lote) or $lote == '') {

            session::getInstance()->setError(i18n::__(10039, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        } 
        if (strlen($lote) < 3) {
            session::getInstance()->setError(i18n::__(10040, null, 'errors', array('%campo%' => $lote)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
        }
        
//            if (strlen($lote) < 0) {
//            session::getInstance()->setError(i18n::__(10079, null, 'errors', array('%campo%' => $lote)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true), true);
//        }

        if (empty($nombre) or ! isset($nombre) or $nombre == '') {

            session::getInstance()->setError(i18n::__(10037, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        } else if (strlen($nombre) > 50) {
            session::getInstance()->setError(i18n::__(10038, null, 'errors', array('%campo%' => $nombre)));
            $flag = true;
            session::getInstance()->setFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array('id' => $id));
            routing::getInstance()->forward('vacunacion', 'editVacuna');
        }
    }

}
