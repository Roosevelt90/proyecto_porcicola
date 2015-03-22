<?php

namespace mvc\dispatch {

  use mvc\config\configClass as config;
  use mvc\routing\routingClass as routing;
  use mvc\autoload\autoLoadClass as autoLoad;
  use mvc\session\sessionClass as session;
  use mvc\i18n\i18nClass as i18n;
  use mvc\hook\hookClass as hook;

  /**
   * Description of dispatchClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class dispatchClass {

    /**
     * Variable estatica para guardar la instancia de la clase dispatchClass
     * @var dispatchClass 
     */
    private static $instance;
    
    /**
     * Constructor del dispatch el cual mantiene controlado
     * la entrada de la primera ves al sistema
     */
    public function __construct() {
      if (!session::getInstance()->hasFirstCall()) {
        session::getInstance()->setFirstCall(true);
      }
    }

    /**
     * 
     * @return dispatchClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function main($module = null, $action = null) {
      try {
        i18n::setCulture(config::getDefaultCulture());
        routing::getInstance()->registerModuleAndAction($module, $action);
        autoLoad::getInstance()->loadIncludes();
        hook::hooksIni();
        $controller = $this->loadModuleAndAction();
        hook::hooksEnd();
        $controller->renderView();
      } catch (\Exception $exc) {
        echo $exc->getMessage();
        echo '<br>';
        echo '<pre>';
        print_r($exc->getTrace());
        echo '</pre>';
      }
    }

    private function checkFile($controllerFolder, $controllerFile) {
      return is_file(config::getPathAbsolute() . 'controller/' . $controllerFolder . '/' . $controllerFile . '.php');
    }

    private function includeFileAndInitialize($controllerFolder, $controllerFile) {
      include_once config::getPathAbsolute() . 'controller/' . $controllerFolder . '/' . $controllerFile . '.php';
      return new $controllerFile();
    }

    /**
     * 
     * @return \mvc\controller\controllerClass
     * @throws \Exception
     */
    private function loadModuleAndAction() {
      $controllerFolder = session::getInstance()->getModule();
      $controllerFile = $controllerFolder . 'Class';
      $action = session::getInstance()->getAction() . 'Action';
      $controllerFileAction = session::getInstance()->getAction() . 'ActionClass';
      $controller = false;
      if ($this->checkFile($controllerFolder, $controllerFile)) {
        $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFile);
        if (method_exists($controller, $action) === true) {
          $this->executeAction($controller, $action);
        } else if ($this->checkFile($controllerFolder, $controllerFileAction)) {
          $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFileAction);
          $this->executeAction($controller, 'execute');
        } else {
          throw new \Exception(i18n::__(00001, null, 'errors'), 00001);
        }
      } elseif ($this->checkFile($controllerFolder, $controllerFileAction)) {
        $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFileAction);
        $this->executeAction($controller, 'execute');
      } else {
        throw new \Exception(i18n::__(00001, null, 'errors'), 00001);
      }
      return $controller;
    }

    private function executeAction($controller, $action) {
      $controller->$action();
      $controller->setArgs((array) $controller);
    }

  }

}
