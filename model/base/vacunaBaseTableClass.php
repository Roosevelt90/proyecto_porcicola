<?php

use mvc\model\table\tableBaseClass;

class vacunaBaseTableClass extends tableBaseClass {

    private $id,
            $nombre_vacuna,
            $lote_vacuna,
            $fecha_fabricacion_vacuna,
            $fecha_vencimiento_vacuna,
            $cantidad,
            $stock;

    const ID = 'id';
    const NOMBRE_VACUNA = 'nombre_vacuna';
    const LOTE_VACUNA = 'lote_vacuna';
    const FECHA_FABRICACION = 'fecha_fabricacion_vacuna';
    const FECHA_VENCIMIENTO = 'fecha_vencimiento_vacuna';
    const VALOR = 'valor_vacuna';
    const CANTIDAD = 'cantidad';
    const STOCK_MINIMO = 'stock_minimo';

    function getId() {
        return $this->id;
    }

    function getNombre_vacuna() {
        return $this->nombre_vacuna;
    }

    function getLote_vacuna() {
        return $this->lote_vacuna;
    }

    function getFecha_fabricacion_vacuna() {
        return $this->fecha_fabricacion_vacuna;
    }

    function getFecha_vencimiento_vacuna() {
        return $this->fecha_vencimiento_vacuna;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre_vacuna($nombre_vacuna) {
        $this->nombre_vacuna = $nombre_vacuna;
    }

    function setLote_vacuna($lote_vacuna) {
        $this->lote_vacuna = $lote_vacuna;
    }

    function setFecha_fabricacion_vacuna($fecha_fabricacion_vacuna) {
        $this->fecha_fabricacion_vacuna = $fecha_fabricacion_vacuna;
    }

    function setFecha_vencimiento_vacuna($fecha_vencimiento_vacuna) {
        $this->fecha_vencimiento_vacuna = $fecha_vencimiento_vacuna;
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
        return 'vacuna';
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

    /* Método para contar todos los registros de una tabla
     *
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param integer $lines variable con la cantidad de de campos que devuelve
     * el sistema
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica cantidad de paginas para visualizar en el paginador.
     * instancia de \PDOException en caso de fracaso.
     */

    public static function getAllCount($fields, $deletedLogical = true, $lines = null, $table = null) {
        return parent::getAllCount(self::getNameTable(), $fields, $deletedLogical, $lines);
    }

}
