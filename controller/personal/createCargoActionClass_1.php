<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields as validate;

class createCargoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try{

        if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(cargoBaseTableClass::getNameField(cargoBaseTableClass::DESCRIPCION, true));

            cargoTableClass::validateCreate($descripcion);
            

            $data = array(
                cargoBaseTableClass::DESCRIPCION => $descripcion
            );
            cargoBaseTableClass::insert($data);
            session::getInstance()->setSuccess(i18n::__('succesCreate'));
            log::register(i18n::__('create'), cargoTableClass::getNameTable());
            routing::getInstance()->redirect('personal', 'indexCargo');
        } else {
            log::register(i18n::__('create'), cargoTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
            session::getInstance()->setError(i18n::__('errorCreate'));
            routing::getInstance()->redirect('personal', 'indexCargo');
        }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
