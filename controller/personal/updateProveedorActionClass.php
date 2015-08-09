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
class updateProveedorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));

                $numero_documento = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NUMERO_DOC, true));
                $nombre_completo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true));
                $tipo_doc = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CIUDAD, true));
                $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TEL, true));

                
                $ids = array(
                    proveedorTableClass::ID => $id
                );

                $data = array(
                    proveedorTableClass::NUMERO_DOC => $numero_documento,
                    proveedorTableClass::NOMBRE => $nombre_completo,
                    proveedorTableClass::TIPO_DOC => $tipo_doc,
                    proveedorTableClass::DIRECCION => $direccion,
                    proveedorTableClass::TEL => $telefono,
                    proveedorTableClass::CIUDAD => $ciudad
                );
                proveedorTableClass::update($ids, $data);
                  log::register('update', proveedorTableClass::getNameTable());
           
            }

            routing::getInstance()->redirect('personal', 'indexProveedor');
   } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
