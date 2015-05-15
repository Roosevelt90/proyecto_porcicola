<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try { 
            if (request::getInstance()->hasRequest(empleadoTableClass::ID)) {
                $fields = array(
                    empleadoTableClass::ID,
                    empleadoTableClass::NUMERO_DOC,
                    empleadoTableClass::NOMBRE,
                    empleadoTableClass::TEL,
                    empleadoTableClass::CIUDAD,
                    empleadoTableClass::CARGO,
                    empleadoTableClass::TIPO_DOC
                );

                $where = array(
                    empleadoTableClass::ID => request::getInstance()->getRequest(empleadoTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fieldsCargo = array(
                    cargoTableClass::ID,
                    cargoTableClass::DESCRIPCION
                );
                $fieldsTipo_doc = array(
                    tipoDocumentoUsuarioTableClass::ID,
                    tipoDocumentoUsuarioTableClass::DESCRIPCION
                );
                $this->objCargo = cargoTableClass::getAll($fieldsCargo, true);
                $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad, true);

                $this->objTipo_doc = tipoDocumentoUsuarioTableClass::getAll($fieldsTipo_doc, false);

                $this->objEmpleado = empleadoTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'empleado', session::getInstance()->getFormatOutput());
            } else {
           
                routing::getInstance()->redirect('empleado', 'indexEmpleado');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
