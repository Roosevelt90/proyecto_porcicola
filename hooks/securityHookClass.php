<?php

namespace hook\security {

  use mvc\interfaces\hookInterface;
  use mvc\session\sessionClass as session;
  use mvc\cache\cacheManagerClass as cache;
  use mvc\config\configClass as config;
  use mvc\routing\routingClass as routing;
  use mvc\request\requestClass as request;
  use mvc\i18n\i18nClass as i18n;

  /**
   * Description of securityHookClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class securityHookClass implements hookInterface {

    public static function hook() {
      try {
        self::firstCall();
        $securityYml = cache::getInstance()->loadYaml(config::getPathAbsolute() . 'config/security.yml', 'securityYml');
        // preguntando si el módulo y la acción solicitada, tienen o no seguridad
        if (isset($securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]) === true and isset($securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]['security']) === true and $securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]['security'] === true) {
          // si hay seguridad, entonces preguntamos si el usuario está autenticado
          if (!session::getInstance()->isUserAuthenticated()) {
            self::saveUrlParams();
            routing::getInstance()->redirect(config::getDefaultModuleSecurity(), config::getDefaultActionSecurity());
          }

          // verifico permisos de acceso
          if (!self::verifyCredentials($securityYml, session::getInstance()->getModule(), session::getInstance()->getAction())) {
            routing::getInstance()->forward(config::getDefaultModulePermission(), config::getDefaultActionPermission());
          }
        } else {
          session::getInstance()->deleteAttribute('shfSecurityModuleGO');
          session::getInstance()->deleteAttribute('shfSecurityActionGO');
        }
      } catch (\PDOException $exc) {
        throw $exc;
      }
    }

    private static function verifyCredentials($securityYml, $module, $action) {
      if (isset($securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]) === true and isset($securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]['credentials']) === true) {
        $credentialsKid = $securityYml[session::getInstance()->getModule()][session::getInstance()->getAction()]['credentials'];
        $credentialsUser = session::getInstance()->getCredentials();

        foreach ($credentialsKid as $credential) {
          if (is_array($credential)) {
            foreach ($credentialsUser as $credentialUser) {
              if (in_array($credentialUser, $credential, true)) {
                $rsp = true;
                break;
              }
            }
          } elseif (in_array($credential, $credentialsUser, true)) {
            $rsp = true;
          } else {
            $rsp = false;
            break;
          }
        }

        if (isset($rsp) and $rsp === true) {
          return true;
        } else {
          return false;
        }
      }
      return true;
    }

    private static function firstCall() {
      // se verifica que sea primera ves que entra al sistema
      if (session::getInstance()->getFirstCall() === true) {
        // como es la priemra ves que entran al sistema, entonces cambio el modo a falso
        session::getInstance()->setFirstCall(false);
        // verifico si existe una cookie para recordar el inicio de sesión el usuario entrante
        self::verifyCookieRememberMe();
      }
    }

    private static function verifyCookieRememberMe() {
      // Si existe la cookie con el nombre para recordar el inicio de sesión (verifico)
      if (request::getInstance()->hasCookie(config::getCookieNameRememberMe())) {
        // borro las sesiones abiertas que estén registradas en base de datos con un tiempo mayor a 8 días
        \recordarMeTableClass::clearSessions();
        // entonces verifico que se encuentre en base de datos y guardo el resultado
        if (($objUsuario = \recordarMeTableClass::getUserAndPassword(request::getInstance()->getServer('REMOTE_ADDR'), request::getInstance()->getCookie(config::getCookieNameRememberMe()))) !== false) {
          // en caso de que esté en la base de datos, esto quiere decir que hay un inicio de sesión
          // recordado y hay que iniciar sesión en el servidor
          self::login($objUsuario);
          self::saveUrlParams();
          self::redirectUrl();
        }
      }
    }

    public static function login($objUsuario) {
      session::getInstance()->setUserAuthenticate(true);
      session::getInstance()->setUserName($objUsuario[0]->usuario);
      session::getInstance()->setUserId($objUsuario[0]->id_usuario);
      foreach ($objUsuario as $usuario) {
        session::getInstance()->setCredential($usuario->credencial);
      }
      \usuarioTableClass::setRegisterLastLoginAt($objUsuario[0]->id_usuario);
      return true;
    }

    public static function redirectUrl() {
      if (session::getInstance()->hasAttribute('shfSecurityModuleGO') and session::getInstance()->hasAttribute('shfSecurityActionGO')) {
        $variables = null;
        if (session::getInstance()->hasAttribute('shfSecurityQueryString')) {
          $variables = array();
          parse_str(session::getInstance()->getAttribute('shfSecurityQueryString'), $variables);
        }
        routing::getInstance()->redirect(session::getInstance()->getAttribute('shfSecurityModuleGO'), session::getInstance()->getAttribute('shfSecurityActionGO'), $variables);
      } else {
        routing::getInstance()->redirect(config::getDefaultModule(), config::getDefaultAction());
      }
    }

    public static function saveUrlParams() {
      session::getInstance()->setAttribute('shfSecurityModuleGO', session::getInstance()->getModule());
      session::getInstance()->setAttribute('shfSecurityActionGO', session::getInstance()->getAction());
      if (request::getInstance()->hasServer('QUERY_STRING') and ( request::getInstance()->getServer('QUERY_STRING') !== '' or request::getInstance()->getServer('QUERY_STRING') !== null)) {
        session::getInstance()->setAttribute('shfSecurityQueryString', request::getInstance()->getServer('QUERY_STRING'));
      }
    }

  }

}
