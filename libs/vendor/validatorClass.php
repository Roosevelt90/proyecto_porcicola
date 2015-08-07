<?php

namespace mvc\validator {

  use mvc\camelCase\camelCaseClass as camelCase;

  /**
   * Description of validatorClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class validatorClass {

    public static function notBlank($variable) {
      return empty(trim($variable));
    }

    public static function isUnique($id, $deletedLogical, $data, $table) {
      $tableObject = '\\' . camelCase::getInstance()->camelCase($table) . "TableClass";
      $fields = array($id);
      eval('$objData = ' . $tableObject . '::getAll($fields, $deletedLogical, NULL, NULL, NULL, NULL, $data);');
      return (count($objData) > 0) ? true : false;
    }

    public static function collection($value, $collection = null, $field = null, $table = null) {
      if ($collection !== null) {
        $answer = (array_search($value, $collection) === false) ? false : true ;
      } else {
        // falta crear el validador para cuando le seleccionen de una tabla en la base de datos
      }
      return $answer;
    }

  }

}