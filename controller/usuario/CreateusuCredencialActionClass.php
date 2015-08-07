<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $usuario_id = request::getInstance()->getPost(usuarioCredencialBaseTableClass::getNameField(usuarioCredencialBaseTableClass::USUARIO_ID, true));
                $credencial_id = request::getInstance()->getPost(usuarioCredencialBaseTableClass::getNameField(usuarioCredencialBaseTableClass::CREDENCIAL_ID, true));
                $data = array(
                    usuarioCredencialBaseTableClass::USUARIO_ID => $usuario_id,
                    usuarioCredencialBaseTableClass::CREDENCIAL_ID => $credencial_id
                );
                usuarioCredencialBaseTableClass::insert($data);
            }
            routing::getInstance()->redirect('usuario', 'indexUsuCredencial');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
