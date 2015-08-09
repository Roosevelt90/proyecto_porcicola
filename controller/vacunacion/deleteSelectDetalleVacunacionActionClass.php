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
class deleteSelectDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        detalleVacunacionTableClass::ID => $id
                    );
                    detalleVacunacionTableClass::delete($ids, true);
                }//close foreach

                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
                session::getInstance()->setSuccess(i18n::__('succesInhabilMasive', null, 'detalleVacunacion'));
                log::register(i18n::__('borrar seleccion'), detalleVacunacionTableClass::getNameTable());
            } else {
                routing::getInstance()->redirect('vacunacion', 'indexDetalleVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
