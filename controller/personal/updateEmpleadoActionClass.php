<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
           
            if (request::getInstance()->isMethod('POST')) {
                $id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $numero_documento = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true));
                $nombre_completo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
                $tipo_doc = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_DOC, true));
                $cargo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CARGO, true));
                $ciudad = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CIUDAD, true));
                $telefono = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TEL, true));
                $direccion = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true));


                $ids = array(
                    empleadoTableClass::ID => $id
                );

                $data = array(
                    empleadoTableClass::NUMERO_DOC => $numero_documento,
                    empleadoTableClass::NOMBRE => $nombre_completo,
                    empleadoTableClass::TIPO_DOC => $tipo_doc,
                    empleadoTableClass::CARGO => $cargo,
                    empleadoTableClass::TEL => $telefono,
                    empleadoTableClass::DIRECCION=>$direccion,
                    empleadoTableClass::CIUDAD => $ciudad
                );
                empleadoTableClass::update($ids, $data);
                log::register('update', empleadoTableClass::getNameTable());
            }//close if
            routing::getInstance()->redirect('personal', 'indexEmpleado');
  } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
