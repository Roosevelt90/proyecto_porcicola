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
class deleteSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));

                $ids = array(
                  salidaBodegaTableClass::ID => $id
                );
                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
               
                salidaBodegaTableClass::stateToToggle($ids);
                session::getInstance()->setSuccess(i18n::__('succesDelete'));
//                log::register(i18n::__('delete'), detalleVacunacionTableClass::getNameTable());
                $this->defineView('delete', 'salidaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'indexEntrada');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
