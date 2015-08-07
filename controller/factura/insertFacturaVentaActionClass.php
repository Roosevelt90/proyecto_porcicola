<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
            );
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true);
            
            $fieldsCliente = array(
            clienteTableClass::ID,
            clienteTableClass::NOMBRE
            );
            $this->objCliente = clienteTableClass::getAll($fieldsCliente, false);
           
            $this->defineView('insert', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
