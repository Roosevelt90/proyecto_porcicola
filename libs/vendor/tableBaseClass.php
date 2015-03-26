<?php

namespace mvc\model\table {

  use mvc\interfaces\tableInterface;
  use mvc\model\modelClass as model;
  use mvc\config\configClass as config;
  use mvc\camelCase\camelCaseClass as camelCase;

  /**
   * Clase general para las tablas el cual define el CRUD
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class tableBaseClass implements tableInterface {

    protected static $fieldDeleteAt = 'deleted_at';

    /**
     * Método para borrar un registro de una tabla X en la base de datos
     *
     * @param string $table Nombre de la tabla
     * @param array $fieldsAndValues Array con los campos por posiciones
     * asociativas y los valores por valores a tener en cuenta para el borrado.
     * Ejemplo $fieldsAndValues['id'] = 1
     * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
     * borrado físico de un registro en una tabla de la base de datos
     * @return boolean
     * @throws \PDOException
     */
    public static function delete($fieldsAndValues, $deletedLogical = true, $table) {
      try {

        if ($deletedLogical === false) {
          $sql = "DELETE FROM $table ";
          $sqlID = "SELECT id FROM $table ";

          $flag = 0;
          foreach ($fieldsAndValues as $field => $value) {
            if ($flag === 0) {
              $sql = $sql . 'WHERE ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
              $sqlID = $sqlID . 'WHERE ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
              $flag++;
            } else {
              $sql = $sql . 'AND ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
              $sqlID = $sqlID . 'AND ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
            }
          }

          $row = model::getInstance()->query($sqlID);
          $answer = $row->fetch(\PDO::FETCH_OBJ);
          $answer = (integer) $answer->id;

          model::getInstance()->beginTransaction();
          model::getInstance()->exec($sql);
          model::getInstance()->commit();
        } else {
          $data[self::$fieldDeleteAt] = date(config::getFormatTimestamp());
          $answer = self::update($fieldsAndValues, $data, $table);
        }

        return $answer;
      } catch (\PDOException $exc) {
        // en caso de haber un error entonces se devuelve todo y se deja como estaba
        model::getInstance()->rollback();
        throw $exc;
      }
    }

    /**
     * Método para obtener el nombre del campo más la tabla ya sea en formato
     * DB (.) o en formato HTML (_)
     *
     * @param string $field Nombre del campo
     * @param string $table Nombre de la tabla
     * @param string $html [optional] Por defecto traerá el nombre del campo en
     * versión DB
     * @return string
     */
    public static function getNameField($field, $table, $html = false) {
      $separator = ($html === true) ? '_' : '.';
      return $table . $separator . $field;
    }

    /**
     * Nombre de la tabla en la base de datos
     * @return string
     */
    public static function getNameTable() {

    }

    /**
     * Método para insertar en una tabla determinada de la base de datos en uso
     *
     * @param string $table Nombre de la tabla
     * @param array $data Array asociativo donde las claves son los nombres de
     * los campos y su valor sería el valor a insertar. Ejemplo:
     * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
     * @return \PDOException|boolean
     */
    public static function insert($table, $data) {
      try {

        $sql = "INSERT INTO $table ";

        $line1 = '(';
        $line2 = 'VALUES (';
        foreach ($data as $field => $value) {
          if ($field !== '__sequence') {
            $line1 = ((config::getDbDriver() === 'mysql') ? $line1 . $field . ', ' : $line1 . '"' . $field . '", ' );
            $line2 = $line2 . ((is_numeric($value) === true) ? $value : "'" . $value . "'") . ', ';
          }
        }

        $newLeng = strlen($line1) - 2;
        $line1 = substr($line1, 0, $newLeng) . ') ';

        $newLeng = strlen($line2) - 2;
        $line2 = substr($line2, 0, $newLeng) . ')';

        $sql = $sql . $line1 . $line2;

        model::getInstance()->beginTransaction();
        model::getInstance()->exec($sql);
        model::getInstance()->commit();
        if (isset($data['__sequence'])) {
          $lastInsertId = model::getInstance()->lastInsertId($data['__sequence']);
        } else {
          $lastInsertId = model::getInstance()->lastInsertId();
        }
        return $lastInsertId;
      } catch (\PDOException $exc) {
        model::getInstance()->rollback();
        throw $exc;
      }
    }

    /**
     * Método para leer todos los registros de una tabla
     *
     * @param string $table Nombre de la tabla
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param array $orderBy [optional] Array con el o los nombres de los campos
     * por los cuales se ordenará la consulta
     * @param string $order [optional] Forma de ordenar la consulta
     * (por defecto NULL), pude ser ASC o DESC
     * @param integer $limit [optional] Cantidad de resultados a mostrar
     * @param integer $offset [optional] Página solicitadad sobre la cantidad
     * de datos a mostrar
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica los nombres de las columnas de la consulta.
     * @throws \PDOException
     */
    public static function getAll($table, $fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null) {
      try {

        $sql = 'SELECT ';

        foreach ($fields as $field) {
          $sql = $sql . $table . '.' . $field . ', ';
        }

        $newLeng = strlen($sql) - 2;
        $sql = substr($sql, 0, $newLeng);

        $sql = $sql . ' FROM ' . $table;

        $flag = false;

        if ($deletedLogical === true) {
          $sql = $sql . ' WHERE ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
          $flag = true;
        }

        if ($deletedLogical === false and is_array($where) === true) {
          //$sql = $sql . ' WHERE ';
          $flag = false;
        }

        if (is_array($where) === true) {
          foreach ($where as $field => $value) {
            if (is_array($value)) {
              if ($flag === false) {
                $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                $flag = true;
              } else {
                $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
              }
            } else {
              if ($flag === false) {
                $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                $flag = true;
              } else {
                $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
              }
            }
          }
        }

        if ($orderBy !== null) {
          $sql = $sql . ' ORDER BY ';

          foreach ($orderBy as $value) {
            $sql = $sql . $table . '.' . $value . ', ';
          }

          $newLeng = strlen($sql) - 2;
          $sql = substr($sql, 0, $newLeng) . (($order !== null) ? " $order" : '');
        }

        if ($limit !== null and $offset === null) {
          $sql = $sql . ' LIMIT ' . $limit;
        }

        if ($limit !== null and $offset !== null) {
          $sql = $sql . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        return model::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
      } catch (\PDOException $exc) {
        throw $exc;
      }
    }

    /**
     * Método para actualizar un registro en una tabla de una base de datos
     *
     * @param array $ids Array asociativo con las posiciones por nombres de los
     * campos y los valores son quienes serían las llaves a buscar.
     * @param array $data Array asociativo con los datos a modificar,
     * las posiciones por nombres de las columnas con los valores por los nuevos
     * datos a escribir
     * @param string $table Nombre de la tabla a actualizar.
     * @return boolean
     * @throws \PDOException
     */
    public static function update($ids, $data, $table) {
      try {

        $sql = "UPDATE $table SET ";
        $sqlID = "SELECT id FROM $table";

        foreach ($data as $key => $value) {
          $sql = $sql . " " . $key . " = '" . $value . "', ";
        }

        $newLeng = strlen($sql) - 2;
        $sql = substr($sql, 0, $newLeng);

        $flag = 0;
        foreach ($ids as $field => $value) {
          if ($flag === 0) {
            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
            $sqlID = $sqlID . ' WHERE ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
          } else {
            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
            $sqlID = $sqlID . ' AND ' . $field . ' = ' . ((is_numeric($value) === true) ? $value : "'$value' " );
          }
          $flag++;
        }

        model::getInstance()->beginTransaction();
        model::getInstance()->exec($sql);
        model::getInstance()->commit();

        $row = model::getInstance()->query($sqlID);
        $answer = $row->fetch(\PDO::FETCH_OBJ);

        return (integer) $answer->id;
      } catch (\PDOException $exc) {
        model::getInstance()->rollback();
        throw $exc;
      }
    }

        /**
         * Método para leer todos los registros de una tabla para aplicar un join
         *
         * @param string $table Nombre de la primera tabla
         * @param string $table2 Nombre de la segunda tabla
         * @param array $fields Array con los nombres de los campos a solicitar
         * @param boolean $deletedLogical [optional] Indicación de borrado lógico
         * o borrado físico
         * @param array $orderBy [optional] Array con el o los nombres de los campos
         * por los cuales se ordenará la consulta
         * @param string $order [optional] Forma de ordenar la consulta
         * (por defecto NULL), pude ser ASC o DESC
         * @param integer $limit [optional] Cantidad de resultados a mostrar
         * @param integer $offset [optional] Página solicitadad sobre la cantidad
         * de datos a mostrar
         * @return mixed una instancia de una clase estandar, la cual tendrá como
         * variables publica los nombres de las columnas de la consulta.
         * @throws \PDOException
         */
        public static function getAllJoin($table, $table2, $table3, $table4, $fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null) {
            try {

                $sql = 'SELECT ';

                foreach ($fields as $field) {
                    $sql = $sql . $table . '.' . $field . ', ';
                }

                foreach ($fields2 as $field) {
                    $sql = $sql . $table2 . '.' . $field . ', ';
                }

                if ($fields3 != null) {
                    foreach ($fields3 as $field) {
                        $sql = $sql . $table3 . '.' . $field . ', ';
                    }
                    if ($fields4 != null) {
                        foreach ($fields4 as $field) {
                            $sql = $sql . $table4 . '.' . $field . ', ';
                        }
                    }
                };
                $newLeng = strlen($sql) - 2;
                $sql = substr($sql, 0, $newLeng);

                $sql = $sql . ' FROM ' . $table;
                if ($table2 != null) {
                    $sql = $sql . ',' . ' ' . $table2;
                };

                if ($table3 != null) {
                    $sql = $sql . ',' . ' ' . $table3;
                };

                if ($table4 != null) {
                    $sql = $sql . ',' . ' ' . $table4;
                };

                $flag = false;

                if ($table2 !== null AND $table3 !== null and $table4 !== null) {

                    $sql = $sql . ' WHERE ' . $table . '.' . $fJoin1 . ' = ' . $table2 . '.' . $fJoin2 . ' AND ' . $table . '.' . $fJoin3 . ' = ' . $table3 . '.' . $fJoin4 . ' AND ' . $table . '.' . $fJoin5 . ' = ' . $table4 . '.' . $fJoin6;
                    if ($deletedLogical === true) {
                        $sql = $sql . ' AND ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
                    }
                    $flag = true;
                } else if ($table2 !== null AND $table3 !== null) {

                    $sql = $sql . ' WHERE ' . $table . '.' . $fJoin1 . ' = ' . $table2 . '.' . $fJoin2 . ' AND ' . $table . '.' . $fJoin3 . ' = ' . $table3 . '.' . $fJoin4;

                    if ($deletedLogical === true) {
                        $sql = $sql . ' AND ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
                    }
                    $flag = true;
                } else {

                    $sql = $sql . ' WHERE ' . $table . '.' . $fJoin1 . ' = ' . $table2 . '.' . $fJoin2;

                    if ($deletedLogical === true) {
                        $sql = $sql . ' AND ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
                    }
                }

                if (is_array($where) === true) {
                    foreach ($where as $field => $value) {
                        if (is_array($value)) {
                            if ($flag === false) {
                                $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                                $flag = true;
                            } else {
                                $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                            }
                        } else {
                            if ($flag === false) {
                                $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                                $flag = true;
                            } else {
                                $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                            }
                        }
                    }
                }

                if ($orderBy !== null) {
                    $sql = $sql . ' ORDER BY ';

                    foreach ($orderBy as $value) {
                        $sql = $sql . $table . '.' . $value . ', ';
                    }

                    $newLeng = strlen($sql) - 2;
                    $sql = substr($sql, 0, $newLeng) . (($order !== null) ? " $order" : '');
                }

                if ($limit !== null and $offset === null) {
                    $sql = $sql . ' LIMIT ' . $limit;
                }

                if ($limit !== null and $offset !== null) {
                    $sql = $sql . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
                }
//                echo $sql;
                return model::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
            } catch (\PDOException $exc) {
                throw $exc;
            }
        }

        /**
         * Método para contar todos los registros de una tabla
         *
         * @param string $table Nombre de la primera tabla
         * @param boolean $deletedLogical [optional] Indicación de borrado lógico
         * o borrado físico
         * @param integer $lines variable con la cantidad de de campos que devuelve
         * el sistema
         * @return mixed una instancia de una clase estandar, la cual tendrá como
         * variables publica cantidad de paginas para visualizar en el paginador.
         * @throws \PDOException
         * @author Roosevelt Diaz <rdiaz02@misena.edu.co>
         */
        public static function getAllCount($table, $fields, $deletedLogical = true, $lines = null, $where = null) {
            try {
                $sql = 'SELECT ';
                $sql = $sql . 'COUNT' . '(' . $table . '.' . $fields[0] . ') as cantidad' . ' ' . ')';

                $newLeng = strlen($sql) - 2;
                $sql = substr($sql, 0, $newLeng);

                $sql = $sql . ' FROM ' . $table;

                $flag = false;

                if ($deletedLogical === true) {
                    $sql = $sql . ' WHERE ' . $table . '.' . self::$fieldDeleteAt . ' IS NULL';
                    $flag = true;
                }
                if ($deletedLogical === false and is_array($where) === true) {
                    $flag = false;
                }
                
                if($where !== null){
                    foreach ($where as $field => $value) {
                        if (is_array($value)) {
                            if ($flag === false) {
                                $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                                $flag = true;
                            } else {
                                $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                            }
                        } else {
                            if ($flag === false) {
                                $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                                $flag = true;
                            } else {
                                $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                            }
                        }
                    }
                }
                
                $count = model::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
                return ceil($count[0]->cantidad / $lines);
//                print_r($count);
//            echo $sql; 
            } catch (\PDOException $exc) {
                throw $exc;
            }
        }

    }

}
