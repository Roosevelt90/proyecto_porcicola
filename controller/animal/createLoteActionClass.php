<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

class createLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NOMBRE, true));
//                $caracteres = validator::getInstance()->validatorCharactersSpecial($nombre);
//
//                if ($caracteres == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }

                loteTableClass::validatCreate($nombre);

                $data = array(
                    loteTableClass::NOMBRE => $nombre
                );

                loteTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'lote'));
                log::register(i18n::__('create'), loteTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexLote');
            } else {
                log::register(i18n::__('create'), loteTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('animal', 'indexLote');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
