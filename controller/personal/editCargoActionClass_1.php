<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;



class editCargoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        
      if (request::getInstance()->hasRequest(cargoTableClass::ID)) {
          
            
            
        $fields = array(
        cargoTableClass::ID,
        cargoTableClass::DESCRIPCION
                
                
        );
        $where = array(
            cargoTableClass::ID => request::getInstance()->getRequest(cargoTableClass::ID)
        );
        $this->objCargo = cargoTableClass::getAll($fields, false, null, null, null, null, $where);
        $this->defineView('edit', 'cargo', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('personal', 'indexCargo');
      }
         
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
  }

}

