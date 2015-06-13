<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

class createRazaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true));

                $data = array(
                    razaTableClass::NOMBRE_RAZA => $nombre
                );
                
                razaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate'));
                log::register(i18n::__('create'), razaTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexRaza');
            } else {
                log::register(i18n::__('create'), razaTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('animal', 'indexRaza');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
