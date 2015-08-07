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
class updateUsuCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                
                $id = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true));
                $credencial = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true));
                $usuario_id = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true));
                
 
                $ids = array(
                usuarioCredencialTableClass::ID => $id
                );

                $data = array(
                    usuarioCredencialTableClass::USUARIO_ID => $usuario_id,
                    usuarioCredencialTableClass::CREDENCIAL_ID => $credencial
                        );
                usuarioCredencialTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'userCredencial'));
                log::register(i18n::__('update'), usuarioCredencialTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'indexUsuCredencial');
                } else {
                log::register(i18n::__('update'), usuarioCredencialTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate', null, 'userCredencial'));
                routing::getInstance()->redirect('usuario', 'indexUsuCredencial');
                }
                } catch (PDOException $exc) {
                session::getInstance()->setFlash('exc', $exc);
                routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}