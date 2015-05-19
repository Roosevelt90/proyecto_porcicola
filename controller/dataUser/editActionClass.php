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
                $fields = array(
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
                $fields2 = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fields3 = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $whereUsuario = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(datosUsuarioTableClass::ID)
                );
                $fields4 = array(
                    tipoDocumentoUsuarioTableClass::ID,
                    tipoDocumentoUsuarioTableClass::DESCRIPCION
                );

                $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fields4, false);
                $this->objUsuario = usuarioTableClass::getAll($fields3, false, null, null, null, null, $whereUsuario);
                $this->objCiudad = ciudadTableClass::getAll($fields2);
                $this->objDatos = datosUsuarioTableClass::getAll($fields, false, null, null, null, null, $whereDatos);
                $this->defineView('edit', 'dataUser', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('dataUser', 'index');
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
