<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(vacunaTableClass::getNameField(vacunaTableClass::ID, true));

                $ids = array(
                    vacunaTableClass::ID => $id
                );
                vacunaTableClass::delete($ids, true);
                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('delete', 'vacuna', session::getInstance()->getFormatOutput());
                log::register(i18n::__('delete'), vacunaTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete'));
            } else {
                log::register(i18n::__('delete'), vacunaTableClass::getNameTable(), i18n::__('errorDeleteBitacora'));
                session::getInstance()->setError(i18n::__('errorDelete'));
                routing::getInstance()->redirect('animal', 'indexRaza');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
