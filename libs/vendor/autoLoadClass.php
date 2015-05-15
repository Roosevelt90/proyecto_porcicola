<?php

namespace mvc\autoload {

  include_once __DIR__ . '/interfaces/sessionInterface.php';
  include_once __DIR__ . '/sessionClass.php';
  include_once __DIR__ . '/configClass.php';
  include_once __DIR__ . '/../../config/myConfigClass.php';
  include_once __DIR__ . '/../../config/config.php';
  include_once __DIR__ . '/../yaml/sfYaml.php';
  include_once __DIR__ . '/cacheManagerClass.php';

  use mvc\config\configClass;
  use mvc\session\sessionClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of autoLoadClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class autoLoadClass {

    /**
     * Variable estatica para guardar la instancia de la clase autoLoadClass
     * @var autoLoadClass 
     */
    private static $instance;

    /**
     * Instanciación de la clase autoLoadClass
     * @return autoLoadClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * Carga los archivos básicos declarados en loader.yml
     * en el punto mvcBasicPackage
     * @return null
     */
    public function autoLoad() {
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'libs/vendor/loader.yml', 'autoLoadYaml');
      foreach ($includes['mvcBasicPackage'] as $include) {
        include_once configClass::getPathAbsolute() . $include;
      }
      return null;
    }

    /**
     * Carga los archivos declarados en el punto "load" del archivo routing.yml
     * de la ruta exigida al sistema
     * @return null
     */
    public function loadIncludes() {
      if (($includes = sessionClass::getInstance()->getLoadFiles()) !== false) {
        foreach ($includes as $include) {
          include_once configClass::getPathAbsolute() . $include;
        }
      }
      return null;
    }

  }

}
