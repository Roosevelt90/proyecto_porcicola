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
class createClienteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')){

                $nombre_completo = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true));
                $telefono = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TEL, true));
                $tipo_documento_id = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::CIUDAD, true));
//    $id=  request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID,true));
                $numero_documento = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NUMERO_DOC, true));
                
                
                
                clienteTableClass::validateCreate($nombre_completo, $direccion, $telefono, $numero_documento);
                
                
                
                
            $data = array(
                clienteTableClass::NUMERO_DOC=>$numero_documento,
                clienteTableClass::TIPO_DOC=>$tipo_documento_id,
                clienteTableClass::NOMBRE=>$nombre_completo,
                clienteTableClass::TEL=>$telefono,
                clienteTableClass::DIRECCION=>$direccion,
                clienteTableClass::CIUDAD=>$ciudad
            );


            clienteTableClass::insert($data);
            log::register(i18n::__('create'), clienteTableClass::getNameTable());
            routing::getInstance()->redirect('personal', 'indexCliente');
              } else {
                log::register(i18n::__('create'), clienteTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate'));
                routing::getInstance()->redirect('personal', 'indexCliente');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
