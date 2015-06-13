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
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(usuarioTableClass::ID)) {
                $fields= array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER,
                    usuarioTableClass::PASSWORD
                );
                $whereUsuario = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );
                $fields2 = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fields3 = array(
                tipoDocumentoUsuarioTableClass::ID,
                tipoDocumentoUsuarioTableClass::DESCRIPCION
                );
                $fields4 = array(
                    datosUsuarioTableClass::APELLIDOS,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO,
                    datosUsuarioTableClass::CREATED_AT,
                    datosUsuarioTableClass::DIRECCION,
                    datosUsuarioTableClass::ID,
                    datosUsuarioTableClass::NOMBRE,
                    datosUsuarioTableClass::TELEFONO
                );
                $where = array(
                    datosUsuarioTableClass::USUARIO_ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );

                $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fields3, false);
                $this->objDatos = datosUsuarioTableClass::getAll($fields4, false, null, null, null, null, $where);
                $this->objCiudad = ciudadTableClass::getAll($fields2);
                $this->objUsuario = usuarioTableClass::getAll($fields, true);
                $this->defineView('edit', 'usuario', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('usuario', 'index');
            }//close if
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
