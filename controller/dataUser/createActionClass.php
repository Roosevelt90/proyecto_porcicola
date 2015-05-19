<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $idUsuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $nombre = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true));
                $apellidos = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true));
                $cedula = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CEDULA, true));
                $direccion = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true));
                $idCiudad = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true));
                $telefono = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true));
                $credencialDefault = '4';
                $data = array(
                    datosUsuarioTableClass::USUARIO_ID => $idUsuario,
                    datosUsuarioTableClass::NOMBRE => $nombre,
                    datosUsuarioTableClass::APELLIDOS => $apellidos,
                    datosUsuarioTableClass::CEDULA => $cedula,
                    datosUsuarioTableClass::DIRECCION => $direccion,
                    datosUsuarioTableClass::CIUDAD_ID => $idCiudad,
                    datosUsuarioTableClass::TELEFONO => $telefono
                );
                
                
                usuarioTableClass::validatCreate($nombre, $apellidos, $cedula, $direccion, $telefono);
                
                datosUsuarioTableClass::insert($data);

                $data2 = array(
                    usuarioCredencialBaseTableClass::USUARIO_ID => $idUsuario,
                    usuarioCredencialTableClass::CREDENCIAL_ID => $credencialDefault
                );
                usuarioCredencialTableClass::insert($data2);
            }
            routing::getInstance()->redirect('dataUser', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
