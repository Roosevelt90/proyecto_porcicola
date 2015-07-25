<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateClienteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                
                $id = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::ID, true));
                $numero_documento = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NUMERO_DOC, true));
                $nombre_completo = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::NOMBRE, true));
                $tipo_doc = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TIPO_DOC, true));
                $direccion = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::DIRECCION, true));
                $ciudad = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::CIUDAD, true));
                $telefono = request::getInstance()->getPost(clienteTableClass::getNameField(clienteTableClass::TEL, true));

                clienteTableClass::validateEdit($nombre_completo, $direccion, $telefono, $numero_documento);

                $ids = array(
                    clienteTableClass::ID => $id
                );

                $data = array(
                    clienteTableClass::NUMERO_DOC => $numero_documento,
                    clienteTableClass::NOMBRE => $nombre_completo,
                    clienteTableClass::TIPO_DOC => $tipo_doc,
                    clienteTableClass::DIRECCION => $direccion,
                    clienteTableClass::TEL => $telefono,
                    clienteTableClass::CIUDAD => $ciudad
                );
                clienteTableClass::update($ids, $data);
                  log::register('update', clienteTableClass::getNameTable());
           
            }

            routing::getInstance()->redirect('personal', 'indexCliente');
   } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
