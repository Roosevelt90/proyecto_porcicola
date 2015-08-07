<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;


class insertUsuCredencialActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        $fields2 = array(
            usuarioTableClass::ID,
            usuarioTableClass::USER
            );
            $fields3 = array(
                credencialTableClass::ID,
                credencialTableClass::NOMBRE
            );
            $fields = array(
            usuarioCredencialTableClass::USUARIO_ID,
            usuarioCredencialTableClass::CREDENCIAL_ID                    
            );                 
           $this->objCredencial = credencialTableClass::getAll($fields3, false);
            $this->objUsuario = usuarioTableClass::getAll($fields2);
            $this->objUsuarioCrede = usuarioCredencialTableClass::getAll($fields, false);
            $this->defineView('insert', 'usuarioCredencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}

