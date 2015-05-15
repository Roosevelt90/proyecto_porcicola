<?php

namespace mvc\routing {

  use mvc\interfaces\routingInterface;
  use mvc\session\sessionClass;
  use mvc\request\requestClass;
  use mvc\dispatch\dispatchClass;
  use mvc\config\configClass;
  use mvc\i18n\i18nClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of routingClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class routingClass implements routingInterface {

    private static $instance;

    /**
     *
     * @return routingClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * $module = '@default_index';
     * o
     * $module = 'default'; $action = 'index';
     *
     * @param string $module
     * @param string $action [optional]
     * @return array
     */
    public function validateRouting($module, $action = null) {
      $yamlRouting = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/routing.yml', 'routingYaml');
      if (preg_match('/^@\w+/', $module) === 1 and $action === null) {
        if (!isset($yamlRouting[substr($module, 1)])) {
          throw new \Exception('La ruta "' . $module . '" no está definida');
        } else {
          $answer = $yamlRouting[substr($module, 1)];
        }
      } else {
        $flag = true;
        foreach ($yamlRouting as $routing) {
          if ($routing['param']['module'] === $module and $routing['param']['action'] === $action) {
            $flag = false;
            $answer = $routing;
            break;
          }
        }
        if ($flag === true) {
          throw new \Exception('El módulo "' . $module . '" y acción "' . $action . '"no está definido');
        }
      }
      return $answer;
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * @param string $module
     * @param string|array $action [optional]
     */
    public function forward($module, $action = null) {
      if (preg_match('/^@\w+/', $module) === 1) {
        $routing = $this->validateRouting($module);
        $module = $routing['param']['module'];
        $action = $routing['param']['action'];
      } else {
        $routing = $this->validateRouting($module, $action);
      }
      dispatchClass::getInstance()->main($module, $action);
      exit();
    }

    public function getUrlCss($css) {
      return configClass::getUrlBase() . 'css/' . $css;
    }

    public function getUrlImg($image) {
      return configClass::getUrlBase() . 'img/' . $image;
    }

    public function getUrlJs($javascript) {
      return configClass::getUrlBase() . 'js/' . $javascript;
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * $variabls = array('id' => 12);
     * @param string $module
     * @param string|array $action [optional]
     * @param array $variables [optional]
     */
    public function getUrlWeb($module, $action = null, $variables = null) {
      if (preg_match('/^@\w+/', $module) === 1) {
        $routing = $this->validateRouting($module);
        $module = $routing['param']['module'];
        $variables = $this->genVariables($action);
        $action = $routing['param']['action'];
      } else {
        $routing = $this->validateRouting($module, $action);
      }
      return configClass::getUrlBase() . configClass::getIndexFile() . $routing['url'] . $this->genVariables($variables);
    }

    /**
     * $module = '@default_index';
     * $action = array('id' => 12);
     * o
     * $module = 'default'; $action = 'index';
     *
     * $variabls = array('id' => 12);
     * @param string $module
     * @param string|array $action [optional]
     * @param array $variables [optional]
     */
    public function redirect($module, $action = null, $variables = null) {
      if (preg_match('/^@\w+/', $module) === 1 and $action === null) {
        $routing = $this->validateRouting($module);
        $module = $routing['param']['module'];
        $variables = $this->genVariables($action);
        $action = $routing['param']['action'];
        header('Location: ' . $this->getUrlWeb($module, $action, $variables));
      } else {
        header('Location: ' . $this->getUrlWeb($module, $action, $variables));
      }
    }

    public function registerModuleAndAction($module = null, $action = null) {
      if ($module !== null and $action !== null) {
        $yamlRouting = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/routing.yml', 'routingYaml');
        $flag = false;
        foreach ($yamlRouting as $routing) {
          if ($module === $routing['param']['module'] and $action === $routing['param']['action']) {
            sessionClass::getInstance()->setModule($routing['param']['module']);
            sessionClass::getInstance()->setAction($routing['param']['action']);
            sessionClass::getInstance()->setLoadFiles(((isset($routing['load'])) ? $routing['load'] : null));
            sessionClass::getInstance()->setFormatOutput($routing['param']['format']);
            $flag = true;
            break;
          }
        }
        if ($flag === false) {
          throw new \Exception(i18nClass::__(00002, null, 'errors'), 00002);
        }
        return true;
      } elseif (requestClass::getInstance()->hasServer('PATH_INFO')) {
        $data = explode('/', requestClass::getInstance()->getServer('PATH_INFO'));
        if (($data[0] === '' and ! isset($data[1])) or ( $data[0] === '' and $data[1] === '')) {
          $this->registerDefaultModuleAndAction();
        } else {
          $url = '/^(';
          foreach ($data as $key => $value) {
            $url .= (($value === '' and $key === 0)) ? '' : $value;
            $url .= (isset($data[($key + 1)])) ? '\/' : '';
          }
          $url .= ')/';
          $yamlRouting = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/routing.yml', 'routingYaml');
          $flag = false;
          foreach ($yamlRouting as $routing) {
            if (preg_match($url, $routing['url']) === 1) {
              sessionClass::getInstance()->setModule($routing['param']['module']);
              sessionClass::getInstance()->setAction($routing['param']['action']);
              sessionClass::getInstance()->setLoadFiles(((isset($routing['load'])) ? $routing['load'] : null));
              sessionClass::getInstance()->setFormatOutput($routing['param']['format']);
              $flag = true;
              break;
            }
          }
          if ($flag === false) {
            throw new \Exception(i18nClass::__(00002, null, 'errors'), 00002);
          }
          return true;
        }
      } else {
        $this->registerDefaultModuleAndAction();
      }
    }

    private function registerDefaultModuleAndAction() {
      $yamlRouting = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/routing.yml', 'routingYaml');
      sessionClass::getInstance()->setModule($yamlRouting['homepage']['param']['module']);
      sessionClass::getInstance()->setAction($yamlRouting['homepage']['param']['action']);
      sessionClass::getInstance()->setLoadFiles(((isset($yamlRouting['homepage']['load'])) ? $yamlRouting['homepage']['load'] : false));
      sessionClass::getInstance()->setFormatOutput($yamlRouting['homepage']['param']['format']);
    }

    /**
     *
     * @param array $variables
     * @return boolean|string
     */
    private function genVariables($variables) {
      $answer = false;
      if (is_array($variables)) {
        $answer = '?';
        foreach ($variables as $key => $value) {
          $answer .= $key . '=' . $value . '&';
        }
        $answer = substr($answer, 0, (strlen($answer) - 1));
      }
      return $answer;
    }

  }

}
