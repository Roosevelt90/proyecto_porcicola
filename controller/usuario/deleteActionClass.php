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
class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
//$observacion = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::OBSERVACION, true));
                
                $ids = array(
                    usuarioTableClass::ID => $id
                );

                $idDato = array(
                    datosUsuarioTableClass::USUARIO_ID => $id
                );
                datosUsuarioTableClass::delete($idDato, true);
                usuarioTableClass::delete($ids, true);

                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('delete', 'usuario', session::getInstance()->getFormatOutput());
                log::register(i18n::__('delete'), usuarioTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'user'));
            } else {
                session::getInstance()->setError(i18n::__('errorDelete', null, 'user'));
                routing::getInstance()->redirect('usuario', 'index');
            }//close if
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
