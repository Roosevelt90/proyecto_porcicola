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
                $fieldsUsuario = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER,
                    usuarioTableClass::PASSWORD
                );
                $whereUsuario = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fields = array(
                    datosUsuarioTableClass::APELLIDOS,
                    datosUsuarioTableClass::CEDULA,
                    datosUsuarioTableClass::CREATED_AT,
                    datosUsuarioTableClass::DIRECCION,
                    datosUsuarioTableClass::ID,
                    datosUsuarioTableClass::NOMBRE,
                    datosUsuarioTableClass::TELEFONO
                );
                $where = array(
                    datosUsuarioTableClass::USUARIO_ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );

                $this->objDatos = datosUsuarioTableClass::getAll3($fields, false, null, null, null, null, $where);
                $this->objCiudad = ciudadTableClass::getAll3($fieldsCiudad);
                $this->objUsuario = usuarioTableClass::getAll($fieldsUsuario, true, null, null, null, null, $whereUsuario);
                $this->defineView('edit', 'usuario', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('usuario', 'index');
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
