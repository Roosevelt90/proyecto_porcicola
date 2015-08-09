<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of usuarioBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class usuarioBaseTableClass extends tableBaseClass {

  protected $id;
  protected $user;
  protected $second_password;
  protected $actived;
  protected $last_login_at;
  protected $created_at;
  protected $updated_at;
  protected $deleted_at;
  protected static $package;
  protected $respuesta_secreta;
  protected $recuperar_id;

  const ID = 'id';
  const USER = 'user_name';
  const USER_LENGTH = 30;
  const PASSWORD = 'password';
  const SECOND_PASSWORD = 'repetir_password';
  const PASSWORD_LENGTH = 32;
  const ACTIVED = 'actived';
  const LAST_LOGIN_AT = 'last_login_at';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const RESPUESTA_SECRETA = 'respuesta_secreta';
  const RESTAURAR_ID = 'recuperar_id';
  const OBSERVACION = 'observacion';


  function getRespuesta_secreta() {
      return $this->respuesta_secreta;
  }

  function getRecuperar_id() {
      return $this->recuperar_id;
  }

  function setRespuesta_secreta($respuesta_secreta) {
      $this->respuesta_secreta = $respuesta_secreta;
  }

  function setRecuperar_id($recuperar_id) {
      $this->recuperar_id = $recuperar_id;
  }

    
  public function getLastLoginAt() {
    return $this->last_login_at;
  }

  public function setLastLoginAt($last_login_at) {
    $this->last_login_at = $last_login_at;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function getUser() {
    return $this->user;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getActived() {
    return $this->actived;
  }

  public function getCreatedAt() {
    return $this->created_at;
  }

  public function getUpdatedAt() {
    return $this->updated_at;
  }

  public function getDeletedAt() {
    return $this->deleted_at;
  }

  public static function getPackage() {
    return self::$package;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function setUser($user) {
    $this->user = $user;
    return $this;
  }

  public function setPassword($password) {
    $this->password = $password;
    return $this;
  }

  public function setActived($actived) {
    $this->actived = $actived;
    return $this;
  }

  public function setCreatedAt($created_at) {
    $this->created_at = $created_at;
    return $this;
  }

  public function setUpdatedAt($updated_at) {
    $this->updated_at = $updated_at;
    return $this;
  }

  public function setDeletedAt($deleted_at) {
    $this->deleted_at = $deleted_at;
    return $this;
  }

  public static function setPackage($package) {
    self::$package = $package;
    return self;
  }

  public function __construct($id = null, $usuario = null, $password = null, $estado = null, $last_login_at = null, $created_at = null, $updated_at = null, $deleted_at = null) {
    $this->id = $id;
    $this->user = $usuario;
    $this->password = $password;
    $this->actived = $estado;
    $this->last_login_at = $last_login_at;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->deleted_at = $deleted_at;
    self::$package = array(
        self::ID,
        self::USER,
        self::PASSWORD,
        self::LAST_LOGIN_AT,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT
    );
  }

  public function __toString() {
    return $this->user;
  }

  public function __sleep() {
    return self::$package;
  }

  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Obtiene el nombre de la tabla
   * @return string
   */
    public static function getNameTable() {
        return 'usuario';
    }

    public static function getNameTable2() {
        return 'ciudad';
    }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
   * borrado físico de un registro en una tabla de la base de datos
   * @return PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
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
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
  }
  
  
  
   /**
   * Método para contar todos los registros de una tabla
   *
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
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAllCount($fields, $deletedLogical = true, $lines = null, $table = null) {
    return parent::getAllCount(self::getNameTable(), $fields, $deletedLogical, $lines);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }
  

    /**
     * Método para leer todos los registros de una tabla
     *
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
     * variables publica los nombres de las columnas de la consulta o una
     * instancia de \PDOException en caso de fracaso.
     */
    public static function getAllJoin($fields, $fields2, $fields3 = null, $fields4 = null, $fJoin1 = null, $fJoin2 = null, $fJoin3 = null, $fJoin4 = null, $fJoin5 = null, $fJoin6 = null, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null, $table2 = null, $table3 = null) {
        return parent::getAllJoin(self::getNameTable(), self::getNameTable2(), self::getNameTable3(), self::getNameTable4(), $fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }

}
