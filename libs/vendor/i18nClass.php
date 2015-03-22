<?php

namespace mvc\i18n {

  use mvc\interfaces\i18nInterface;
  use mvc\config\configClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of i18nClass
   *
   * @author julianlasso
   */
  class i18nClass implements i18nInterface {

    protected static $culture;

    /**
     * 
     * @param integer $message
     * @param string $culture [optional]
     * @param string $dictionary [optional]
     * @param array $vars [optional] $vars[':nombre'] = 'NOMBRE';
     * @return string
     */
    public static function __($message, $culture = null, $dictionary = 'default', $vars = array()) {
      if ($culture === null) {
        $culture = self::getCulture();
      }
      $__ymlCulture = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'i18n/' . $culture . '.yml', 'i18nYaml'. $culture);
      $rsp = '';
      if (count($vars) > 0) {
        $keys = array_keys($vars);
        $values = array_values($vars);
        $rsp = str_replace($keys, $values, $__ymlCulture['dictionary'][$dictionary][$message]);
      } else {
        $rsp = $__ymlCulture['dictionary'][$dictionary][$message];
      }
      return $rsp;
    }

    public static function getCulture() {
      return self::$culture;
    }

    public static function setCulture($culture) {
      self::$culture = $culture;
    }

  }

}
