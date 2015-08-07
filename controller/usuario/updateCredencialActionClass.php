<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;


class updateCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true));
                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));

                $ids = array(
                    credencialTableClass::ID => $id
                );
                credencialTableClass::validatUpdate($nombre);
                $data = array(
                    credencialTableClass::NOMBRE => $nombre
                );

                credencialTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'animal'));
                log::register(i18n::__('update'), usuarioTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'indexCredencial');
            } else {
                log::register(i18n::__('update'), usuarioTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'animal'));
                routing::getInstance()->redirect('usuario', 'indexCredencial');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}