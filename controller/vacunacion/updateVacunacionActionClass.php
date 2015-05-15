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
class updateVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID, true));
                $id_animal = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true));
                $id_veterinario = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true));
                $fecha_registro = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true));



                $ids = array(
                    vacunacionTableClass::ID => $id
                );

                vacunacionTableClass::validateUpdate($id_animal, $id_veterinario, $fecha_registro);

                $data = array(
                    vacunacionTableClass::ANIMAL => $id_animal,
                    vacunacionTableClass::VETERINARIO => $id_veterinario,
                    vacunacionTableClass::FECHA => $fecha_registro
                );
                vacunacionTableClass::update($ids, $data);

                session::getInstance()->setSuccess(i18n::__('succesUpdate'));
                log::register(i18n::__('update'), vacunacionTableClass::getNameTable());
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if

            routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
