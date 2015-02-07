<?php

namespace mvc\interfaces {

  /**
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  interface tableInterface {

    /**
     * Método estático para obtener el nombre de la tabla
     */
    static public function getNameTable();

    /**
     * Método para devolver el nombre del campo junto a su tabla
     * @param string $field Nombre del campo a devolver con nombre completo
     */
    static public function getNameField($field, $html = false, $table);

    static public function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $table);

    static public function insert($data, $table);

    static public function update($ids, $data, $table);

    static public function delete($fieldsAndValues, $deletedLogical = true, $table);
  }

}