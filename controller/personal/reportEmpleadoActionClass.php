<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

function __construct() {
    
}

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('reportEmpleado')) {
                $report = request::getInstance()->getPost('reportEmpleado');
            }

            $fields = array(
                empleadoTableClass::ID,
                empleadoTableClass::NUMERO_DOC,
                empleadoTableClass::CIUDAD,
                empleadoTableClass::NOMBRE,
                empleadoTableClass::TEL,
                empleadoTableClass::CARGO,
                empleadoTableClass::TIPO_DOC,
                empleadoTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                cargoTableClass::DESCRIPCION
            );
            $fields4 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );

            $fJoin1 = empleadoTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = empleadoTableClass::CARGO;
            $fJoin4 = cargoTableClass::ID;
            $fJoin5 = empleadoTableClass::TIPO_DOC;
            $fJoin6 = tipoDocumentoTableClass::ID;

            $orderBy = array(
                empleadoTableClass::ID
            );
            $this->objEmpleado = empleadoTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', $where);
            $this->mensaje = 'Informe de Empledos en Nuestro Sistema';
            $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
