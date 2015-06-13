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
class deleteSelectLoteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        loteTableClass::ID => $id
                    );
                    loteTableClass::delete($ids, true);
                }//close foreach
                log::register(i18n::__('delete'), loteTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete'));
                routing::getInstance()->redirect('animal', 'indexLote');
            } else {
                log::register(i18n::__('errorDelete'), loteTableClass::getNameTable());
                session::getInstance()->setError(i18n::__('errorDeleteMasivo'));
                routing::getInstance()->redirect('animal', 'indexLote');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
