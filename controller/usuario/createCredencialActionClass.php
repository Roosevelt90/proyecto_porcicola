<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            if (request::getInstance()->isMethod('POST')) {
                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
//                $fields = array(
//                    credencialTableClass::NOMBRE
//                );
//                $objCreden = credencialTableClass::getAll($fields);

                $data = array(
                    credencialTableClass::NOMBRE => $nombre
                );
 
                credencialTableClass::insert($data);
                
                
                credencialTableClass::validatCreate($nombre);
            
            session::getInstance()->setSuccess(i18n::__('succesCreate', null, 'default'));
                log::register(i18n::__('create'), credencialTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'indexCredencial');
                
            } else {
                log::register(i18n::__('create'), credencialTableClass::getNameTable(), i18n::__('errorCreateBitacora'));
                session::getInstance()->setError(i18n::__('errorCreate', null, 'default'));
                routing::getInstance()->redirect('usuario', 'indexCredencial');
            }
            
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
