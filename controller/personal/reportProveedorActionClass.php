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
class reportProveedorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('reportProveedor')) {
                $report = request::getInstance()->getPost('reportProveedor');
            }
            $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NUMERO_DOC,
                proveedorTableClass::CIUDAD,
                proveedorTableClass::NOMBRE,
                proveedorTableClass::TEL,
                proveedorTableClass::TIPO_DOC,
                proveedorTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );


            $fJoin1 = proveedorTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = proveedorTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;


            $orderBy = array(
                proveedorTableClass::ID
            );

            $this->objProveedor = proveedorTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', $where);
            $this->mensaje = 'Informe de Proveedores en Nuestro Sistema';
            $this->defineView('index', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
