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
                tipoDocumentoUsuarioTableClass::ID,
                tipoDocumentoUsuarioTableClass::DESCRIPCION
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

            $this->objTipo_doc = tipoDocumentoUsuarioTableClass::getAll($fieldsTipo_doc, false);
            $this->defineView('insert', 'empleado', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
