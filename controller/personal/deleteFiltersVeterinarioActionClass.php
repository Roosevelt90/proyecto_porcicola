<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

class deleteFiltersVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('veterinarioFilters')) {
                session::getInstance()->deleteAttribute('veterinarioFilters');
            }

            routing::getInstance()->redirect('personal', 'indexVeterinario');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}