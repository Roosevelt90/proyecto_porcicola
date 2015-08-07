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
class createVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id_animal = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ANIMAL, true));
                $id_veterinario = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::VETERINARIO, true));
                $fecha_registro = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::FECHA, true));
             
                vacunacionTableClass::validate($id_veterinario, $fecha_registro, $id_animal);

                $data = array(
                    vacunacionTableClass::ANIMAL => $id_animal,
                    vacunacionTableClass::VETERINARIO => $id_veterinario,
                    vacunacionTableClass::FECHA =>  $fecha_registro
                );

                vacunacionTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate'));
                log::register(i18n::__('create'), vacunacionTableClass::getNameTable());
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            } else {
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
