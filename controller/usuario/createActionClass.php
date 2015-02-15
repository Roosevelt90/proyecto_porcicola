<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $repetirPassword = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true));
                $pregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));
                $nombreUsuario = usuarioTableClass::USER;

                
                //validar si los campos estan vacios
                $datos = array(
                    $usuario,
                    $password,
                    $repetirPassword,
                    $respuesta
                );
                $validatorEmpty = validator::getInstance()->validateFieldsEmpty($datos);
                if ($validatorEmpty == false) {
                    throw new PDOException(i18n::__(10006, null, 'errors', null, 10006));
                }
                
                
                //Validar si el nombre existe 
                $fields = array(
                    usuarioTableClass::USER
                );
                $objUsuario = usuarioTableClass::getAll($fields, false);

                foreach ($objUsuario as $key) {
                    if ($usuario == $key->$nombreUsuario) {
                        throw new PDOException(i18n::__(00005, null, 'errors', null, 00005));
                    }
                }

                //Validar si tiene caracteres especiales
                $validacionUsuario = validator::getInstance()->validatorCharactersSpecial($usuario);
                if ($validacionUsuario == true) {
                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
                }

                $validacionPregunta = validator::getInstance()->validatorCharactersSpecial($respuesta);
                if ($validacionPregunta == true) {
                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
                }

                //validar la longitud del nombre d eusuario
                if (strlen($usuario) > usuarioTableClass::USER_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USER_LENGTH)), 00001);
                }

                //validar si las contraseñas coinciden
                if ($password !== $repetirPassword) {
                    throw new PDOException(i18n::__(00004, null, 'errors', array(':password' => usuarioTableClass::SECOND_PASSWORD)), 00004);
                }



                $data = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $pregunta,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta
                );
                usuarioTableClass::insert($data);

                routing::getInstance()->redirect('dataUser', 'insert', array('str' => $usuario));
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
