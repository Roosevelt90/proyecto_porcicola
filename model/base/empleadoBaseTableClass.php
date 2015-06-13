<?php

use mvc\model\table\tableBaseClass;

class empleadoBaseTableClass extends tableBaseClass {

    private $numero_doc,
            $tipo_doc,
            $nombre_completo,
            $telefono,
            $cargo_id,
            $direccion,
            $ciudad,
            $id,
            $deleted_at;

    const ID = 'id';
    const NUMERO_DOC = 'numero_doc';
    const TIPO_DOC = 'tipo_doc';
    const NOMBRE = 'nombre_completo';
    const TEL = 'telefono';
    const CARGO = 'cargo_id';
    const CIUDAD = 'ciudad';
    const DIRECCION = 'direccion';
    const DELETED_AT = 'deleted_at';

    function getId() {
        return $this->id;
    }

    function getNumero_doc() {
        return $this->numero_doc;
    }

    function getTipo_doc() {
        return $this->tipo_doc;
    }

    function getNombre() {
        return $this->nombre_completo;
    }

    function getTel() {
        return $this->telefono;
    }

    function getCargo_id() {
        return $this->cargo_id;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getDeleted_at() {
        return $this->deleted_at;
    }

    function setNumero_doc($numero_doc) {
        $this->numero_documento = $numero_doc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo_doc($tipo_doc) {
        $this->tipo_doc = $tipo_doc;
    }

    function setNombre($nombre_completo) {
        $this->nombre_completo = $nombre_completo;
    }

    function setTEL($telefono) {
        $this->telefono = $telefono;
    }

    function setCargo_id($cargo_id) {
        $this->cargo = $cargo_id;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setDeleted_at($deleted_At) {
        $this->deleted_at = $deleted_At;
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
        return 'empleado';
    }

    public static function getNameTable2() {
        return 'ciudad';
    }

    public static function getNameTable3() {
        return 'cargo';
    }

    public static function getNameTable4() {
        return 'tipo_documento';
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

    public static function getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical = false, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null, $table2 = null, $table3 = null) {
        return parent::getAllJoin(self::getNameTable(), self::getNameTable2(), self::getNameTable3(), self::getNameTable4(), $fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
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

    public static function getAllCount($fields, $deletedLogical = true, $lines = null, $table = null) {
        return parent::getAllCount(self::getNameTable(), $fields, $deletedLogical, $lines);
    }

}
