<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteRazaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));

                $ids = array(
                    razaTableClass::ID => $id
                );
                razaTableClass::delete($ids, true);
                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('delete', 'raza', session::getInstance()->getFormatOutput());
                log::register(i18n::__('delete'), razaTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete'));
            } else {
                session::getInstance()->setError(i18n::__('errorDelete'));
                routing::getInstance()->redirect('animal', 'indexRaza');
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
