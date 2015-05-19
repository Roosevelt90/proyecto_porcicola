<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class indexActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try {
            
            $where= NULL;
        $fields2 = array(
            usuarioBaseTableClass::ID,
            usuarioBaseTableClass::USER
            );
            $fields3 = array(
                credencialBaseTableClass::ID,
                credencialBaseTableClass::NOMBRE
            );
            $fields = array(
            usuarioCredencialTableClass::USUARIO_ID,
            usuarioCredencialTableClass::CREDENCIAL_ID                    
            );        
            
            $fJoin1 = usuarioCredencialTableClass::USUARIO_ID;
            $fJoin2 = usuarioTableClass::ID;
            $fJoin3 = usuarioCredencialTableClass::CREDENCIAL_ID;
            $fJoin4 = credencialTableClass::ID;
//            
            
           $this->objCredencial = credencialBaseTableClass::getAll($fields3, true);
            $this->objUsuario = usuarioTableClass::getAll($fields2, true);
            $this->objUsuCrede = usuarioCredencialTableClass::getAll( $fields, true);
            
            $this->defineView('index', 'usuarioCredencial', session::getInstance()->getFormatOutput());
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}

    
//       public function execute() {
//        try {
//
//            $fields = array(
//            usuarioCredencialTableClass::ID,
//            usuarioCredencialTableClass::CREDENCIAL_ID,
//            usuarioCredencialTableClass::USUARIO_ID
//            );
//            $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll($fields, true);
//            $this->defineView('index', 'usuarioCredencial', session::getInstance()->getFormatOutput());
//        } catch (PDOException $exc) {
//            echo $exc->getMessage();
//            echo '<br>';
//            echo '<pre>';
//            print_r($exc->getTrace());
//            echo '</pre>';
//        }
//    }
//
//}
