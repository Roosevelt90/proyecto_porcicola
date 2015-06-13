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
class deleteSelectCargoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        cargoTableClass::ID => $id
                    );
                    cargoTableClass::delete($ids, true);
                }//close foreach

                log::register(i18n::__('delete'), cargoTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'cargo'));
                routing::getInstance()->redirect('empleado', 'indexCargo');
            } else {
                log::register(i18n::__('errorDelete'), cargoTableClass::getNameTable());
                session::getInstance()->setError(i18n::__('errorDeleteMasivo', null, 'user'));
                routing::getInstance()->redirect('empleado', 'indexCargo');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}