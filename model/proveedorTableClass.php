<?php
use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class proveedorTableClass extends proveedorBaseTableClass {
    
public static function validateCreate($nombre_completo, $direccion, $numero_documento, $telefono) {
        $flag = false;
        $patron = "^[a-zA-Z0-9]{3,20}$";
    
        if (empty($numero_documento)) {
            session::getInstance()->setError('vacio el campo num');
            $flag = true;
            session::getInstance()->setFirstCall(proveedorTableClass::getNameField(proveedorTableClass::NUMERO_DOC, true), true);
        }
        if (empty($telefono)) {
            session::getInstance()->setError('vacio el campo tel');
            $flag = true;
            session::getInstance()->setFirstCall(proveedorTableClass::getNameField(proveedorTableClass::TEL, true), true);
        }
        if (empty($direccion)) {
            session::getInstance()->setError('vacio el campo direc');
            $flag = true;
            session::getInstance()->setFirstCall(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true), true);
        }
        if (empty($nombre_completo) or ! isset($nombre_completo) or $nombre_completo == '') {
            session::getInstance()->setError('No puede ser vacio');
            $flag = true;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true), true);
        } else if (strlen($nombre_completo) < 2) {
            session::getInstance()->setError('Minimo dos caracteres');
            $flag = true;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true), true);
        } else if (!ereg($patron, $nombre_completo)) {
            session::getInstance()->setError('No se permiten caracteres especiales');
            $flag = true;
            session::getInstance()->setFirstCall(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true), true);
        }
      
}
}