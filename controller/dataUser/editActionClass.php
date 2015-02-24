<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(ciudadTableClass::ID)) {
                $fieldsDatos = array(
                    datosUsuarioTableClass::APELLIDOS,
                    datosUsuarioTableClass::TIPO_DOC,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO,
                    datosUsuarioTableClass::CREATED_AT,
                    datosUsuarioTableClass::DIRECCION,
                    datosUsuarioTableClass::ID,
                    datosUsuarioTableClass::NOMBRE,
                    datosUsuarioTableClass::TELEFONO
                );
                $whereDatos = array(
                    datosUsuarioTableClass::ID => request::getInstance()->getRequest(datosUsuarioTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fieldsUsuario = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $whereUsuario = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(datosUsuarioTableClass::ID)
                );
                $fieldsTipoDocumento = array(
                    tipoDocumentoUsuarioTableClass::ID,
                    tipoDocumentoUsuarioTableClass::DESCRIPCION
                );

                $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fieldsTipoDocumento, false);
                $this->objUsuario = usuarioTableClass::getAll($fieldsUsuario, false, null, null, null, null, $whereUsuario);
                $this->objCiudad = ciudadTableClass::getAll3($fieldsCiudad);
                $this->objDatos = datosUsuarioTableClass::getAll3($fieldsDatos, false, null, null, null, null, $whereDatos);
                $this->defineView('edit', 'dataUser', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('ciudad', 'index');
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
