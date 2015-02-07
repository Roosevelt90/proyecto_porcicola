<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;


class indexActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try {
            
            $fields = array (
            usuarioCredencialTableClass::ID
            );
            
            $fields2 = array(
            usuarioTableClass::USER
            );
            
            $fields3 = array(
            credencialTableClass::NOMBRE
            );
            $fJoin1 = usuarioCredencialTableClass::USUARIO_ID;
            $fJoin2 = usuarioTableClass::ID;
            $fJoin3 = usuarioCredencialTableClass::CREDENCIAL_ID;
            $fJoin4 = credencialTableClass::ID;
            $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll2($fields, $fields2, $fields3, $fJoin1, $fJoin2, $fJoin3, $fJoin4, false);
//            $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll($fields, false);
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