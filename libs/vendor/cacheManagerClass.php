<?php

namespace mvc\cache {

  use mvc\session\sessionClass as session;
  use mvc\config\configClass as config;

  /**
   * Description of cacheManagerClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class cacheManagerClass {

    /**
     * Variable estatica para guardar la instancia de la clase cacheManagerClass
     * @var cacheManagerClass 
     */
    private static $instance;

    /**
     * Instanciación de la clase cacheManagerClass
     * @return cacheManagerClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * Carga un archivo yml y lo convierte en un array, el resultado es almacenado
     * en cache con el nombre indicado en $index
     * @param string $yaml Dirección del archivo yml a convertir en array
     * @param string $index Nombre a utilizar en Cache para almacenar el resultado
     * @return array Resultado de la conversión del archivo yml indicado a un array
     * @throws \PDOException
     */
    public function loadYaml($yaml, $index) {
      try {
        if (session::getInstance()->hasCache($index) and config::getScope() === 'prod') {
          $answer = session::getInstance()->getCache($index);
        } else {
          $answer = \sfYaml::load($yaml);
          session::getInstance()->setCache($index, $answer);
        }
        return $answer;
      } catch (\PDOException $exc) {
        throw $exc;
      }
    }

  }

}
