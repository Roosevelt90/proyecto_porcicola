<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use hook\log\logHookClass as log;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of logoutActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class logoutActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      log::register('salida del sistema', 'NINGUNA', null, null, session::getInstance()->getUserId());
      session::getInstance()->setUserAuthenticate(false);
      session::getInstance()->setUserId(null);
      session::getInstance()->setUserName(null);
      session::getInstance()->deleteCredentials();
      if (request::getInstance()->hasCookie(config::getCookieNameRememberMe()) === true) {
        recordarMeTableClass::deleteSession(request::getInstance()->getCookie(config::getCookieNameRememberMe()), request::getInstance()->getServer('REMOTE_ADDR'));
        setcookie(config::getCookieNameRememberMe(), '', time() - config::getCookieTime(), config::getCookiePath());
      }
      routing::getInstance()->redirect(config::getDefaultModule(), config::getDefaultAction());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
