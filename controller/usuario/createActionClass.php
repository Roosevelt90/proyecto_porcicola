<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                // usuario
                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $repetirPassword = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true));
                $pregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));
                $nombreUsuario = usuarioTableClass::USER;

                //datos del usuario
                $nombre = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true));
                $apellidos = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true));
                $tipoDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TIPO_DOC, true));
                $numeroDocumento = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NUMERO_DOCUMENTO, true));
                $direccion = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true));
                $idCiudad = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true));
                $telefono = request::getInstance()->getPost(datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true));
                $credencialDefault = usuarioCredencialTableClass::CREDENCIAL_DEFAULT;

                usuarioTableClass::validatCreate($usuario, $password, $respuesta);


                //Insertar la informacion del usuario
                $data = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $pregunta,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta
                );
                usuarioTableClass::insert($data);

                //obtener el ultimo registro que ha sido insertado
                $fieldsUsuario = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $orderBy = array(
                    usuarioTableClass::ID
                );
                $objUsuario = usuarioTableClass::getAll($fieldsUsuario, true, $orderBy, 'DESC', 1);
                $idUsuario = $objUsuario[0]->id;

                //insertar datos usuarior
                $dataUsuario = array(
                    datosUsuarioTableClass::USUARIO_ID => $idUsuario,
                    datosUsuarioTableClass::NOMBRE => $nombre,
                    datosUsuarioTableClass::APELLIDOS => $apellidos,
                    datosUsuarioTableClass::TIPO_DOC => $tipoDocumento,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO => $numeroDocumento,
                    datosUsuarioTableClass::DIRECCION => $direccion,
                    datosUsuarioTableClass::CIUDAD_ID => $idCiudad,
                    datosUsuarioTableClass::TELEFONO => $telefono
                );
                datosUsuarioTableClass::insert($dataUsuario);

                //asignacion del rol default (invitado)

                $dataUsuarioCredencial = array(
                    usuarioCredencialBaseTableClass::USUARIO_ID => $idUsuario,
                    usuarioCredencialTableClass::CREDENCIAL_ID => $credencialDefault
                );
                usuarioCredencialTableClass::insert($dataUsuarioCredencial);
                session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'user'));
                log::register(i18n::__('create'), usuarioTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'index');
            } else {
                session::getInstance()->setError(i18n::__('errorCreate', null, 'user'));
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
