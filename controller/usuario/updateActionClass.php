<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                //usuario
                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));

                $idUser = array(
                    usuarioTableClass::ID => $id
                );
                $dataUser = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => $password
                );


                //datos usuario
                $nombre = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true));
                $apellidos = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true));
                $tipoDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TIPO_DOC, true));
                $numeroDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NUMERO_DOCUMENTO, true));
                $direccion = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true));
                $idCiudad = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true));
                $telefono = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true));

                $datosUsuario = array(
                    datosUsuarioTableClass::NOMBRE => $nombre,
                    datosUsuarioTableClass::APELLIDOS => $apellidos,
                    datosUsuarioTableClass::TIPO_DOC => $tipoDocumento,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO => $numeroDocumento,
                    datosUsuarioTableClass::DIRECCION => $direccion,
                    datosUsuarioTableClass::CIUDAD_ID => $idCiudad,
                    datosUsuarioTableClass::TELEFONO => $telefono
                );
                $idData = array(
                    datosUsuarioTableClass::USUARIO_ID => $id
                );
                
               usuarioTableClass::validatUpdate($usuario, $password);


//                datosUsuarioTableClass::update($idData, $datosUsuario);
//                usuarioTableClass::update($idUser, $dataUser);
//                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'user'));
//                log::register(i18n::__('update'), usuarioTableClass::getNameTable());
//                routing::getInstance()->redirect('usuario', 'index');
//            } else {
//                session::getInstance()->setError(i18n::__('errorUpdate', null, 'user'));
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
