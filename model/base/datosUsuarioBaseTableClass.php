<?php

use mvc\model\table\tableBaseClass;

class datosUsuarioBaseTableClass  extends tableBaseClass {
    private $id,
            $created_at,
            $updated_at,
            $deleted_at,
            $apellidos,
            $telefono,
            $direccion,
            $nombre,
            $cedula,
            $usuario_id,
            $ciudad_id;
    
    const ID = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED__aT = 'updated_at';
    const DELETED_AT = 'deleted_at';
    const APELLIDOS = 'apellidos';
    const TELEFONO = 'telefono';
    const DIRECCION = 'direccion';
    const NOMBRE = 'nombre';
    const CEDULA = 'cedula';
    const USUARIO_ID = 'usuario_id';
    const CIUDAD_ID = 'ciudad_id';
    
    function getId() {
        return $this->id;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function getDeleted_at() {
        return $this->deleted_at;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getCiudad_id() {
        return $this->ciudad_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }

    function setDeleted_at($deleted_at) {
        $this->deleted_at = $deleted_at;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setCiudad_id($ciudad_id) {
        $this->ciudad_id = $ciudad_id;
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
        return 'datos_usuario';
    }

    public static function getNameTable2() {
        return 'ciudad';
    }
    public static function getNameTable3(){
        return 'usuario';
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
    public static function getAll($fields, $fields2, $fields3, $fJoin1 = null, $fJoin2 = null, $fJoin3 = null, $fJoin4 = null, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null, $table2 = null, $table3 = null) {
        return parent::getAllJoin(self::getNameTable(), self::getNameTable2(), self::getNameTable3(), $fields, $fields2, $fields3, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }
    
    public static function getAll2($fields2, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null){
        return parent::getAll(self::getNameTable2(), $fields2, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }
    
    public static function getAll3($fields, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null){
        return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
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

}

