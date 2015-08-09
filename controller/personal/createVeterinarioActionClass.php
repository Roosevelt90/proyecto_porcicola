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
class createVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
            if (request::getInstance()->isMethod('POST')) {

                $nombre_completo = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::NOMBRE, true));
                $telefono = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::TEL, true));
                $tipo_documento_id = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::CIUDAD, true));
                $numero_documento = request::getInstance()->getPost(veterinarioTableClass::getNameField(veterinarioTableClass::NUMERO_DOC, true));

                veterinarioTableClass::validateCreate($nombre_completo, $direccion, $telefono, $numero_documento);

                $data = array(
                    veterinarioTableClass::NUMERO_DOC => $numero_documento,
                    veterinarioTableClass::TIPO_DOC => $tipo_documento_id,
                    veterinarioTableClass::NOMBRE => $nombre_completo,
                    veterinarioTableClass::TEL => $telefono,
                    veterinarioTableClass::DIRECCION => $direccion,
                    veterinarioTableClass::CIUDAD => $ciudad
                );


                veterinarioTableClass::insert($data);
             
                log::register(i18n::__('create'), veterinarioTableClass::getNameTable());
                routing::getInstance()->redirect('personal', 'indexVeterinario');
            } 
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
