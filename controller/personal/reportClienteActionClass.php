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
class reportClienteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('reportCliente')) {
                $report = request::getInstance()->getPost('reportCliene');
            }


            $fields = array(
                clienteTableClass::ID,
                clienteTableClass::NUMERO_DOC,
                clienteTableClass::CIUDAD,
                clienteTableClass::NOMBRE,
                clienteTableClass::TEL,
                clienteTableClass::TIPO_DOC,
                clienteTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );


            $fJoin1 = clienteTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = clienteTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;


            $orderBy = array(
                clienteTableClass::ID
            );



            $this->objCliente = clienteTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', $where);
            $this->mensaje = 'Informe de clientes en nuestro sistema';
            $this->defineView('index', 'cliente', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
