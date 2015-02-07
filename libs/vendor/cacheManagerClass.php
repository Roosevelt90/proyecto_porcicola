<?php

namespace mvc\cache {

  use mvc\session\sessionClass;

  /**
   * Description of cacheManagerClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class cacheManagerClass {

    private static $instance;

    /**
     *
     * @return cacheManagerClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * 
     * @param string $yaml
     * @param string $index
     * @return array
     * @throws \PDOException
     */
    public function loadYaml($yaml, $index) {
      try {
        if (sessionClass::getInstance()->hasCache($index)) {
          $answer = sessionClass::getInstance()->getCache($index);
        } else {
          $answer = \sfYaml::load($yaml);
          sessionClass::getInstance()->setCache($index, $answer);
        }
        return $answer;
      } catch (\PDOException $exc) {
        throw $exc;
      }
    }

  }

}