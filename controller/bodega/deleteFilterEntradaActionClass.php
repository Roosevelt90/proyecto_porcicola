<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

class deleteFilterEntradaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('entradaFilter')) {
                session::getInstance()->deleteAttribute('entradaFilter');
            }//clse if

            routing::getInstance()->redirect('bodega', 'indexEntrada');
            log::register(i18n::__('eliminar filtros'), entradaBodegaTableClass::getNameTable());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
