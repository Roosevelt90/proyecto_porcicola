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
class editClienteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try { 
            if (request::getInstance()->hasRequest(clienteTableClass::ID)) {
                $fields = array(
                    clienteTableClass::ID,
                    clienteTableClass::NUMERO_DOC,
                    clienteTableClass::NOMBRE,
                    clienteTableClass::TEL,
                    clienteTableClass::CIUDAD,
                    clienteTableClass::DIRECCION,
                    clienteTableClass::TIPO_DOC
                );

                $where = array(
                    clienteTableClass::ID => request::getInstance()->getRequest(clienteTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
               
                );
                $fieldsTipo_doc = array(
                    tipoDocumentoTableClass::ID,
                    tipoDocumentoTableClass::DESCRIPCION
                );
                
                $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad, true);

                $this->objTipo_documento = tipoDocumentoTableClass::getAll($fieldsTipo_doc, true);

                $this->objCliente = clienteTableClass::getAll($fields, false, null, null, null, null, $where);
            }
                $this->defineView('edit', 'cliente', session::getInstance()->getFormatOutput());
         
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
  }

}
