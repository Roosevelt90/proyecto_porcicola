<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where=null;
            
            $fields = array(
                dpVentaTableClass::ID,
                dpVentaTableClass::FECHA,
                dpVentaTableClass::USUARIO_ID,
                dpVentaTableClass::NUMERO_DOCUMENTO,
                dpVentaTableClass::PESO_ANIMAL,
                dpVentaTableClass::PRECIO_ANIMAL,
                dpVentaTableClass::ANIMAL_ID
            );
            $fields2 = array(
                usuarioTableClass::USER
           );

            $orderBy = array(
            dpVentaTableClass::ID
            );

            $this->objdpVenta = dpVentaTableClass::getAll($fields,  false, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de los facturas de venta en nuestro sistema';
            $this->defineView('index', 'dpVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
