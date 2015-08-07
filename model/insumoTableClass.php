<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insumoTableClass extends insumoBaseTableClass {
      public static function validate($id_tipo_insumo, $tipo_insumo, $insumo, $fecha_fabricacion, $fecha_vencimiento, $precio) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";
     
            if (empty($tipo_insumo) or !isset($tipo_insumo) or $tipo_insumo == '') {

            session::getInstance()->setError(i18n::__(10044, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }else if (strlen($tipo_insumo) > 100) {
            session::getInstance()->setError(i18n::__(10046, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }
        
            if (ereg($patternC, $tipo_insumo) == false) {
            session::getInstance()->setError(i18n::__(10045, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }
        
        if (empty($insumo) or !isset($insumo) or $insumo == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }else if (strlen($insumo) > 50) {
            session::getInstance()->setError(i18n::__(10049, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        
            if (ereg($patternC, $insumo) == false) {
            session::getInstance()->setError(i18n::__(10048, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        
        if (empty($fecha_fabricacion) or !isset($fecha_fabricacion) or $fecha_fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors', array('%campo%' => $fecha_fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }       
        
        if (empty($fecha_vencimiento) or !isset($fecha_vencimiento) or $fecha_vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors', array('%campo%' => $fecha_vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
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
        
        if (empty($precio) or !isset($precio) or $precio == '') {

            session::getInstance()->setError(i18n::__(10050, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }  
        
        if (!is_numeric($precio)) {
            session::getInstance()->setError(i18n::__(10051, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoBaseTableClass::VALOR, true), true);
        }
        
        if (ereg($patternC, $precio) == false) {
            session::getInstance()->setError(i18n::__(10053, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }
        
    $fieldsTipoInsumo = array(
    tipoInsumoTableClass::ID
    );
        
 $objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo);
 
     foreach ($objTipoInsumo as $key => $value) {
      foreach ($value as $key) {
        if ($key != $id_tipo_insumo) {
          session::getInstance()->setError(i18n::__(10054, null, 'errors'));
          $flag = true;
        }
      }
    }
 
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('vacunacion', 'insertVacuna');
        }
        
      }
      
          public static function validateEdit($id_tipo_insumo, $tipo_insumo, $insumo, $fecha_fabricacion, $fecha_vencimiento, $precio) {
        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $dateNow = date("Y-m-d", strtotime("now"));
        $patternC = "^[a-zA-Z0-9]{3,20}$";
        
            if (empty($tipo_insumo) or !isset($tipo_insumo) or $tipo_insumo == '') {

            session::getInstance()->setError(i18n::__(10044, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }else if (strlen($tipo_insumo) > 100) {
            session::getInstance()->setError(i18n::__(10046, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }
        
            if (ereg($patternC, $tipo_insumo) == false) {
            session::getInstance()->setError(i18n::__(10045, null, 'errors', array('%campo%' => $tipo_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true), true);
        }
        
        if (empty($insumo) or !isset($insumo) or $insumo == '') {

            session::getInstance()->setError(i18n::__(10047, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }else if (strlen($insumo) > 50) {
            session::getInstance()->setError(i18n::__(10049, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        
            if (ereg($patternC, $insumo) == false) {
            session::getInstance()->setError(i18n::__(10048, null, 'errors', array('%campo%' => $insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true), true);
        }
        
        if (empty($fecha_fabricacion) or !isset($fecha_fabricacion) or $fecha_fabricacion == '') {

            session::getInstance()->setError(i18n::__(10041, null, 'errors', array('%campo%' => $fecha_fabricacion)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }       
        
        if (empty($fecha_vencimiento) or !isset($fecha_vencimiento) or $fecha_vencimiento == '') {

            session::getInstance()->setError(i18n::__(10042, null, 'errors', array('%campo%' => $fecha_vencimiento)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
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
        
        if (empty($precio) or !isset($precio) or $precio == '') {

            session::getInstance()->setError(i18n::__(10050, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }  
        
        if (!is_numeric($precio)) {
            session::getInstance()->setError(i18n::__(10051, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoBaseTableClass::VALOR, true), true);
        }
        
        if (ereg($patternC, $precio) == false) {
            session::getInstance()->setError(i18n::__(10053, null, 'errors', array('%campo%' => $precio)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, true), true);
        }       
        
     $fieldsTipoInsumo = array(
    tipoInsumoTableClass::ID
    );
        
 $objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo);
 
     foreach ($objTipoInsumo as $key => $value) {
      foreach ($value as $key) {
        if ($key != $id_tipo_insumo) {
          session::getInstance()->setError(i18n::__(10054, null, 'errors'));
          $flag = true;
        }
      }
    }      
            if ($flag == true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array('id' => $id));
            routing::getInstance()->forward('vacunacion', 'editVacuna');
        }
        }
        
          }