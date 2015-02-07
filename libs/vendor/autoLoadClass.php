<?php

namespace mvc\autoload {

  include_once __DIR__ . '/configClass.php';
  include_once __DIR__ . '/../../config/config.php';
  include_once __DIR__ . '/../yaml/sfYaml.php';
  include_once __DIR__ . '/cacheManagerClass.php';
  include_once __DIR__ . '/interfaces/sessionInterface.php';
  include_once __DIR__ . '/sessionClass.php';

  use mvc\config\configClass;
  use mvc\session\sessionClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of autoLoadClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class autoLoadClass {

    private static $instance;

    /**
     *
     * @return autoLoadClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function autoLoad() {
      // $includes = \sfYaml::load(configClass::getPathAbsolute() . 'libs/vendor/loader.yml');
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'libs/vendor/loader.yml', 'autoLoadYaml');
      foreach ($includes['mvcBasicPackage'] as $include) {
        include_once configClass::getPathAbsolute() . $include;
      }
    }

    public function loadIncludes() {
      if (($includes = sessionClass::getInstance()->getLoadFiles()) !== false) {
        foreach ($includes as $include) {
          include_once configClass::getPathAbsolute() . $include;
        }
      }
    }

  }

}