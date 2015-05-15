<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class procesoCompraTableClass extends procesoCompraBaseTableClass {

    public static function validateCreate($fecha) {

        $flag = false;

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/";

        $dateNow = date("Y-m-d H:m", strtotime("now"));

        if ($fecha > $dateNow) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
        }

        if (ereg($pattern, $fecha)) {
            session::getInstance()->setError(i18n::__(10010, null, 'errors', array('%fecha%' => $fecha)));
            $flag = true;
            session::getInstance()->setFlash(procesoCompraBaseTableClass::getNameField(procesoCompraBaseTableClass::FECHA_HORA_COMPRA, true), true);
        }
        if ($flag == true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('factura', 'insertFacturaCompra');
        }
    }

}
