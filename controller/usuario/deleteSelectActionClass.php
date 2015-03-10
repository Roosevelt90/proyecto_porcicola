<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {

                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        usuarioTableClass::ID => $id
                    );
                    $idsData = array(
                        datosUsuarioTableClass::USUARIO_ID => $id
                    );
                }
                datosUsuarioTableClass::delete($idsData, true);
                usuarioTableClass::delete($ids, true);

                session::getInstance()->setSuccess(i18n::__('succesDeleteMasivo', null, 'user'));
                routing::getInstance()->redirect('usuario', 'index');
            } else {
                session::getInstance()->setError(i18n::__('errorDeleteMasivo', null, 'user'));
                routing::getInstance()->redirect('usuario', 'index');
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
