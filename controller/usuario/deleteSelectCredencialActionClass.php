<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteSelectCredencialActionClass extends controllerClass implements controllerActionInterface {

       public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        credencialTableClass::ID => $id
                    );
                    credencialTableClass::delete($ids, true);
                }
                log::register(i18n::__('delete'), credencialTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete'));
                routing::getInstance()->redirect('usuario', 'indexCredencial');
            } else {
                log::register(i18n::__('errorDelete'), credencialTableClass::getNameTable());
                session::getInstance()->setError(i18n::__('errorDeleteMasivo'));
                routing::getInstance()->redirect('usuario', 'indexCredencial');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}