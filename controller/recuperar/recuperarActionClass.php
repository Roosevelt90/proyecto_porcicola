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
class recuperarActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $rePassword = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true));
                $idPregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));

                $ids = array(
                    usuarioTableClass::ID => $id
                );
                $data = array(
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $idPregunta,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta
                );
                usuarioTableClass::update($ids, $data);
            }//close if
            routing::getInstance()->redirect('shfSecurity', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
