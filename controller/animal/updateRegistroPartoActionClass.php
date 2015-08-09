<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::ID, true));
                $fecha = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::FECHA_NACIMIENTO, true));
                $hembras = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS, true));
                $machos = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::MACHOS_NACIDOS_VIVOS, true));
                $muertos = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::NACIDOS_MUERTOS, true));
                $raza = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::RAZA_ID, true));
                $animal_id = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::ANIMAL_ID, true));

                //  $fecha = request::getInstance()->getPost(registroPartoTableClass::getNameField(registroPartoTableClass::FECHA_NACIMIENTO, true));
//                $caracteres = validator::getInstance()->validatorCharactersSpecial($nombre);
//
//                if ($caracteres == true) {
//                    throw new PDOException(i18n::__(10005, null, 'errors', null, 10005));
//                }




                $ids = array(
                    registroPartoTableClass::ID => $id
                );

                $data = array(
                    registroPartoTableClass::FECHA_NACIMIENTO => $fecha,
                    registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS => $hembras,
                    registroPartoTableClass::MACHOS_NACIDOS_VIVOS => $machos,
                    registroPartoTableClass::NACIDOS_MUERTOS => $muertos,
                    registroPartoTableClass::RAZA_ID => $raza,
                    registroPartoTableClass::ANIMAL_ID => $animal_id,
                );

                registroPartoTableClass::update($ids, $data);
                session::getInstance()->setSuccess(i18n::__('succesUpdate', null, 'parto'));
                log::register(i18n::__('update'), registroPartoTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'indexRegistroParto');
            } else {
                log::register(i18n::__('update'), registroPartoTableClass::getNameTable(), i18n::__('errorUpdateBitacora'));
                session::getInstance()->setError(i18n::__('errorUpdate'));
                routing::getInstance()->redirect('animal', 'indexRegistroParto');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
