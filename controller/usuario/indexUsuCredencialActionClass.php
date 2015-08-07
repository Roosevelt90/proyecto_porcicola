
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;



class indexUsuCredencialActionClass extends controllerClass implements controllerActionInterface {
    
    public function execute() {
        try {
            
            
             $fields = array(
            usuarioCredencialTableClass::USUARIO_ID,
            usuarioCredencialTableClass::CREDENCIAL_ID                    
            ); 
            $orderBy = array(
                usuarioCredencialTableClass::USUARIO_ID
            );
         
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                usuarioCredencialTableClass::ID
            );

            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $lines = config::getRowGrid();
//            $this->cntPages = usuarioCredencialTableClass::getAllCount($f, true, $lines);
                  
            
            
//           $this->objCredencial = credencialBaseTableClass::getAll($fields3, true);
//            $this->objUsuario = usuarioTableClass::getAll($fields2, true);
            $this->objUsuCrede = usuarioCredencialTableClass::getAll( $fields,true, $orderBy, 'ASC', config::getRowGrid(), $page);
            
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
