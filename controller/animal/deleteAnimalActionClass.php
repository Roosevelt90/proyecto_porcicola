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
class deleteAnimalActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID, true));
//$observacion = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::OBSERVACION, true));

                $ids = array(
                    animalTableClass::ID => $id
                );
                animalTableClass::delete($ids, false);

                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('delete', 'animal', session::getInstance()->getFormatOutput());
                log::register(i18n::__('delete'), usuarioTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'animal'));
            } else {
                session::getInstance()->setError(i18n::__('errorDelete', null, 'animal'));
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
