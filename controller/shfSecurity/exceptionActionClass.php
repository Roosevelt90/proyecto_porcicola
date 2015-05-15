<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of exceptionActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class exceptionActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasFlash('exc')) {
      $this->exc = session::getInstance()->getFlash('exc');
      $this->defineView('exception', 'shfSecurity', session::getInstance()->getFormatOutput());
    } else {
      routing::getInstance()->redirect(config::getDefaultModule(), config::getDefaultAction());
    }
  }

}
