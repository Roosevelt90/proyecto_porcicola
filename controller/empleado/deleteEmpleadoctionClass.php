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
class deleteEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//            isAjaxRequest es la peticion ajax.
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
//$observacion = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::OBSERVACION, true));

                $ids = array(
//                    array de los id que se van a eliminar
                    empleadoTableClass::ID => $id
                );
                // paso el delete y verifico si es borrado logico y fisico o solo fisico 
                empleadoTableClass::delete($ids, true);
//peticion ajax
                $this->arrayAjax = array(
                    'code' => 110,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('deleteEmpleado', 'empleado', session::getInstance()->getFormatOutput());
                log::register(i18n::__('delete'), usuarioTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'empleado'));
            } else {
                session::getInstance()->setError(i18n::__('errorDelete', null, 'empleado'));
                routing::getInstance()->redirect('empleado', 'indexEmpleado');
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
