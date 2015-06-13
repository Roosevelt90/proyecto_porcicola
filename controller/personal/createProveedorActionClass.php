<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
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
class createProveedorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')){

                $nombre_completo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true));
                $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TEL, true));
                $tipo_documento_id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CIUDAD, true));
//    $id=  request::getInstance()->getPost(empleadoTableClass::getNameField(proveedorTableClass::ID,true));
                $numero_documento = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NUMERO_DOC, true));
                
                proveedorTableClass::validateCreate($nombre_completo, $direccion, $telefono, $numero_documento);
                
            $data = array(
                proveedorTableClass::NUMERO_DOC=>$numero_documento,
                proveedorTableClass::TIPO_DOC=>$tipo_documento_id,
                proveedorTableClass::NOMBRE=>$nombre_completo,
                proveedorTableClass::TEL=>$telefono,
                proveedorTableClass::DIRECCION=>$direccion,
                proveedorTableClass::CIUDAD=>$ciudad
            );


            proveedorTableClass::insert($data);
            log::register(i18n::__('create'), proveedorTableClass::getNameTable());
            routing::getInstance()->redirect('personal', 'indexProveedor');
              } else {
                log::register(i18n::__('create'), proveedorTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('personal', 'indexProveedor');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
