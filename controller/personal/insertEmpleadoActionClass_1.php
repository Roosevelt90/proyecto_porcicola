<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fieldsTipo_doc = array(
                tipoDocumentoTableClass::ID,
                tipoDocumentoTableClass::DESCRIPCION
            );
            $fieldsCargo = array(
                cargoTableClass::ID,
                cargoTableClass::DESCRIPCION
            );
            $fieldsCiudad = array(
                ciudadTableClass::ID,
                ciudadTableClass::NOMBRE
            );
            $this->objCargo=  cargoTableClass::getAll($fieldsCargo, true);
            $this->objCiudad= ciudadTableClass::getAll($fieldsCiudad, true);

            $this->objTipo_doc = tipoDocumentoTableClass::getAll($fieldsTipo_doc, true);
            $this->defineView('insert', 'empleado', session::getInstance()->getFormatOutput());
      } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
