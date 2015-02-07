<?php

namespace mvc\hook {

  use mvc\config\configClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of hookClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class hookClass {

    private static $listHooks;

    public static function hooksIni() {
      if (!self::$listHooks) {
        self::$listHooks = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/hooks.yml', 'hooksYaml');
      }
      self::loadHooksAndExecute(self::$listHooks['ini'], ((isset(self::$listHooks['configLoader'])) ? self::$listHooks['configLoader'] : null));
    }

    public static function hooksEnd() {
      if (!self::$listHooks) {
        self::$listHooks = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/hooks.yml', 'hooksYaml');
      }
      self::loadHooksAndExecute(self::$listHooks['end'], ((isset(self::$listHooks['configLoader'])) ? self::$listHooks['configLoader'] : null));
    }

    private static function loadHooksAndExecute($listHooks, $filesToLoad = null) {
      if ($filesToLoad !== null and is_array($listHooks) and count($listHooks) > 0) {
        foreach ($listHooks as $hook) {
          if (isset($filesToLoad[$hook]) and is_array($filesToLoad[$hook])) {
            foreach ($filesToLoad[$hook] as $file) {
              include_once configClass::getPathAbsolute() . $file;
            }
          }
          $hookFileClass = $hook . 'HookClass';
          include_once configClass::getPathAbsolute() . 'hooks/' . $hookFileClass . '.php';
          $hookObj = '\\hook\\' . $hook . '\\' . $hookFileClass;
          $hookObj::hook();
        }
      }
    }
  }

}