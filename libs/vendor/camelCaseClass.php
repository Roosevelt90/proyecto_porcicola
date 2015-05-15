<?php

namespace mvc\camelCase {

  /**
   * Description of camelCaseClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class camelCaseClass {

    /**
     * Variable estatica para guardar la instancia de la clase camelCaseClass
     * @var camelCaseClass 
     */
    private static $instance;

    /**
     * Instanciación de la clase camelCaseClass
     * @return camelCaseClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * 
     * @param string $str
     * @param array $exclude
     * @return string
     */
    public function camelCase($str, $exclude = array()) {
      // replace accents by equivalent non-accents
      $str = $this->replaceAccents($str);
      // non-alpha and non-numeric characters become spaces
      $str = preg_replace('/[^a-z0-9' . implode("", $exclude) . ']+/i', ' ', $str);
      // uppercase the first character of each word
      $str = ucwords(trim($str));
      return lcfirst(str_replace(" ", "", $str));
    }

    private function replaceAccents($str) {
      $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
      $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
      return str_replace($search, $replace, $str);
    }

  }

}
