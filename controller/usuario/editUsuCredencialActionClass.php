<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editUsuCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(usuarioCredencialTableClass::ID)) {
                $fields = array(
                    usuarioCredencialTableClass::USUARIO_ID,
                    usuarioCredencialTableClass::CREDENCIAL_ID
                );
                $fields2 = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER
                );
                $fields3 = array(
                    credencialTableClass::ID,
                    credencialTableClass::NOMBRE
                        );
                $where = array(
                    usuarioCredencialTableClass::ID => request::getInstance()->getRequest(usuarioCredencialTableClass::ID)
                );
                $this->objUsuario = usuarioTableClass::getAll($fields2, true);
                $this->objUsuarioCrede = usuarioCredencialTableClass::getAll($fields);
                $this->objCredencial = credencialTableClass::getAll($fields3, null, null, null, null);
                $this->defineView('edit', 'usuarioCredencial', session::getInstance()->getFormatOutput());
            
                
            } else {
                routing::getInstance()->redirect('usuario', 'indexUsuCredencial');
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
