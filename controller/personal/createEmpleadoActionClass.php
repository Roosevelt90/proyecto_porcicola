<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validator;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
             if (request::getInstance()->isMethod('POST')){
                 
            $direccion = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true));
            $nombre_completo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
            $telefono = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TEL, true));
            $tipo_documento = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_DOC, true));
            $cargo_id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CARGO, true));
            $ciudad = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CIUDAD, true));
//    $id=  request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID,true));
            $numero_documento = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true));

            empleadoTableClass::validateCreate($nombre_completo, $direccion, $numero_documento,$telefono);



            $data = array(
           
                empleadoTableClass::NUMERO_DOC => $numero_documento,
                empleadoTableClass::CARGO => $cargo_id,
                empleadoTableClass::CIUDAD => $ciudad,
                empleadoTableClass::NOMBRE => $nombre_completo,
                empleadoTableClass::DIRECCION => $direccion,
                empleadoTableClass::TIPO_DOC => $tipo_documento,
                empleadoTableClass::TEL => $telefono
            );

            empleadoTableClass::insert($data);
           
            log::register(i18n::__('create'), empleadoTableClass::getNameTable());
            routing::getInstance()->redirect('personal', 'indexEmpleado');
              } 
    } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

